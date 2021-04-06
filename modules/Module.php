<?php
namespace modules;

use Craft;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('my-module')`.
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['my-module']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 */
class Module extends \yii\base\Module
{
    /**
     * @var string[] List of commands that should be ignored.
     */
    public $ignoreCommands = [];

    /**
     * @var string[] List of actions that should be ignored.
     */
    public $ignoreActions = [
        'tests/test'
    ];

    /**
     * @var string[] List of options that should be ignored. (Defaults to common ones
     *               that don’t need to be constantly repeated.)
     */
    public $ignoreOptions = [];

    /**
     * @var string The path to the generated Markdown file.
     */
    public $outputFile;

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'help-doc/index';

    /**
     * @var string The Twig template to use for output.
     */
    public $template = 'command-docs.twig';

    /**
     * Initializes the module.
     */
    public function init()
    {
        // Set a @modules alias pointed to the modules/ directory
        Craft::setAlias('@modules', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\controllers';
        }

        parent::init();
    }
}
