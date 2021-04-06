<?php

namespace modules\console\controllers;

use craft\helpers\FileHelper;
use modules\models\ConsoleAction;
use modules\models\ConsoleActionOption;
use modules\models\ConsoleActionParam;
use modules\models\ConsoleCommand;
use Craft;
use modules\Module;
use yii\console\Controller;
use yii\console\controllers\HelpController;
use yii\helpers\Inflector;
use craft\helpers\Console;
use Yii;

/**
 * Class CommandController
 *
 * Extends Yii’s HelpController to generate one big chunk of Markdown rather than a few
 * separate console output views.
 *
 * Must use PHP 7.4 because PHP 8 results in a failure where
 * `yii\console\Controller::getActionsArgsHelp()` does not pick up params for `tests/setup`.
 *
 * @property Module $module
 * @package modules\console\controllers
 */
class CommandController extends HelpController
{
    /**
     * @var array
     */
    private $collectedCommands = [];

    /**
     * Write documentation for commands and subcommands.
     *
     * @param null $command not used
     * @return int|void
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex($command = null)
    {
        if ($command) {
            $this->stdout(
                sprintf('Generating documentation for `%s` commands', $command) . PHP_EOL,
                Console::FG_GREEN
            );
        } else {
            $this->stdout('Generating documentation for all commands' . PHP_EOL, Console::FG_GREEN);
        }

        $commands = $this->getCommandDescriptions();

        $this->stdout('Parsing commands' . PHP_EOL, Console::FG_GREEN);

        // loop over commands
        foreach ($commands as $cmd => $description) {
            $isIgnoredCommand = in_array($cmd, $this->module->ignoreCommands, true);

            if ($isIgnoredCommand) {
                $this->stdout(sprintf('- ignoring `%s`', $cmd) . PHP_EOL, Console::FG_GREY);
                continue;
            }

            $result = Yii::$app->createController($cmd);
            /** @var $controller Controller */
            [$controller] = $result;
            $controllerUid = $controller->getUniqueId();
            $isSpecifiedCommand = $command === $cmd || $command === $controllerUid;

            if ($command && ! $isSpecifiedCommand) {
                $this->stdout(sprintf('- ignoring `%s`', $cmd) . PHP_EOL, Console::FG_GREY);
                continue;
            }

            $actions = $this->getActions($controller);
            $collectedActions = [];

            // loop over + prep command actions
            foreach ($actions as $actionName) {
                $uniqueActionName = $controllerUid . '/' . $actionName;

                if (in_array($uniqueActionName, $this->module->ignoreActions)) {
                    continue;
                }

                $collectedActionArgs = [];
                $collectedActionOptions = [];

                if ($action = $controller->createAction($actionName)) {
                    $actionArgs = $controller->getActionArgsHelp($action);
                    $actionOptions = $controller->getActionOptionsHelp($action);
                    $actionDescription = $this->parseDocCommentDetailMarkdown($controller, $action);
                    $actionSummary = $controller->getActionHelpSummary($action);
                    $actionComment = $controller->getHelp();
                }

                // collect + format arguments
                if (isset($actionArgs) && ! empty($actionArgs)) {
                    foreach ($actionArgs as $name => $details) {
                        try {
                            $collectedActionArgs[] = new ConsoleActionParam([
                                'name' => $name,
                                'type' => $details['type'],
                                'default' => $details['default'],
                                'deprecated' => str_contains($details['comment'], 'DEPRECATED'),
                                'comment' => $this->indentExtraLines($details['comment']),
                                'required' => $details['required'],
                            ]);
                        } catch (\TypeError $e) {
                            $this->stdout(
                                sprintf(
                                    '! Error processing %s: %s',
                                    $uniqueActionName,
                                    $e->getMessage()
                                ) . PHP_EOL,
                                Console::FG_RED
                            );
                        }
                    }
                }

                // collect + format options
                if (isset($actionOptions) && ! empty($actionOptions)) {
                    foreach ($actionOptions as $name => $details) {
                        if (in_array($name, $this->module->ignoreOptions, true)) {
                            unset($actionOptions[$name]);
                            continue;
                        }

                        $collectedActionOptions[] = new ConsoleActionOption([
                            'name' => $name,
                            'type' => $details['type'],
                            'default' => $details['default'],
                            'deprecated' => str_contains($details['comment'], 'DEPRECATED'),
                            'comment' => trim($this->indentExtraLines($details['comment'])),
                            'aliases' => $this->getOptionAliases($controller, $name),
                            'required' => isset($details['required']) && $details['required'],
                        ]);
                    }
                }

                $collectedActions[] = new ConsoleAction([
                    'name' => $uniqueActionName,
                    'summary' => $actionSummary ?? null,
                    'description' => $actionDescription ?? null,
                    'comment' => $actionComment ?? null,
                    'isDefault' => $actionName === $controller->defaultAction,
                    'args' => $collectedActionArgs ?? [],
                    'options' => $collectedActionOptions ?? [],
                    'deprecated' => str_contains($actionDescription, 'DEPRECATED'),
                ]);
            }

            // collect commands along with their actions
            $this->collectedCommands[] = new ConsoleCommand([
                'name' => $cmd,
                'description' => $description,
                'deprecated' => str_contains($description, 'DEPRECATED'),
                'actions' => $collectedActions
            ]);
        }

        $documentedCommands = count($this->collectedCommands);

        $this->stdout(
            sprintf(
                'Processed %d command%s',
                $documentedCommands,
                $documentedCommands !== 1 ? 's' : ''
            ) . PHP_EOL,
            Console::FG_GREEN
        );

        $this->renderMarkdown($this->collectedCommands);
    }

    /**
     * Write out the Markdown chunk for the docs.
     *
     * @param $commands
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    private function renderMarkdown($commands): void
    {
        $this->stdout(
            sprintf('Writing markdown: %s', $this->module->outputFile) . PHP_EOL,
            Console::FG_GREEN
        );

        $view = Craft::$app->getView();
        $view->setTemplatesPath(dirname(__DIR__, 2) . '/templates');

        $doc = $view->renderTemplate(
            $this->module->template, [ 'commands' => $commands ]
        );

        FileHelper::writeToFile($this->module->outputFile, $doc);
    }

    /**
     * Similar to `parseDocCommentDetail()`, but just return the markdown.
     *
     * @param Controller $controller
     * @param string $action
     * @return string
     */
    private function parseDocCommentDetailMarkdown($controller, $action): string
    {
        $reflection = $controller->getActionMethodReflection($action);

        $comment = strtr(trim(preg_replace('/^\s*\**( |\t)?/m', '', trim($reflection->getDocComment(), '/'))), "\r", '');

        if (preg_match('/^\s*@\w+/m', $comment, $matches, PREG_OFFSET_CAPTURE)) {
            $comment = trim(substr($comment, 0, $matches[0][1]));
        }

        if ($comment !== '') {
            return rtrim($comment);
        }

        return '';
    }

    /**
     * Take a multi-line comment string and indent any new lists or paragraphs for output
     * in an options or parameters list.
     *
     * @param string $string Markdown string
     * @return string
     */
    private function indentExtraLines($string): string
    {
        $lines = explode("\n", $string);
        $indent = false;

        foreach ($lines as $i => $line) {
            if ($i > 0 && $indent === false && $line === "") {
                $indent = true;
            }

            if ($indent) {
                $lines[$i] = '    ' . $line;
            }
        }

        return implode("\n", $lines);
    }

    /**
     * Returns an array of aliases for the provided controller’s command option.
     *
     * @param Controller  $controller  Controller whose command provides the supplied option
     * @param string      $option      Full option name
     * @return array
     */
    private function getOptionAliases($controller, $option): array
    {
        $aliases = [];

        foreach ($controller->optionAliases() as $name => $value) {
            if (Inflector::camel2id($value, '-', true) === $option) {
                $aliases[] = $name;
            }
        }

        return $aliases;
    }

}
