<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\User;
use craft\elements\Entry;
use craft\models\GqlToken;

/**
 * m210104_175929_sample_content migration.
 *
 * Adds some bogus content to the project so you don’t have to!
 */
class m210104_175929_sample_content extends Migration
{
    /**
     * @var string private token for testing with Gatsby
     */
    private $gqlToken = 'TEST-GRAPHQL-TOKEN';

    /**
     * Some fake blog post content we’ll insert into entries.
     * @var array[]
     */
    private $entriesContent = [
        [
            'title' => 'Do These Five Things in an Elevator',
            'slug' => 'five-things-elevator',
            'summary' => '<p>Must-follow tips for a ride nobody remembers.</p>',
            'bodyContent' => [
                'new1' => [
                    'type' => 'richText',
                    'fields' => [
                        'richText' => '<ol><li>Do not scream suddenly.</li><li>Hold anything you’re in the middle of eating until you’ve stepped off the elevator again.</li><li>If you brought any live animals with you, do your best to keep them on your person.</li><li>Avoid vigorous jumping or bouncing.</li><li>Face the same direction as everybody else.</li></ol>'
                    ]
                ]
            ],
        ],
        [
            'title' => 'Use This Trick to Save Money Dining Out',
            'slug' => 'trick-save-money-dining-out',
            'summary' => '<p>An awesome life hack for lowering your restaurant budget.</p>',
            'bodyContent' => [
                'new1' => [
                    'type' => 'richText',
                    'fields' => [
                        'richText' => '<p>Find a recipe for the thing you want and make it at home.</p>'
                    ]
                ]
            ],
        ],
        [
            'title' => 'Don’t Leave Home Without This Quote',
            'slug' => 'dont-leave-home-without-quote',
            'summary' => '<p>This meditation will prepare you for anything.</p>',
            'bodyContent' => [
                'new1' => [
                    'type' => 'richText',
                    'fields' => [
                        'richText' => '<p>Philosopher Jack Handy was known to unpack some of the great complexities of the universe.</p>'
                    ]
                ],
                'new2' => [
                    'type' => 'quote',
                    'fields' => [
                        'quote' => '<p>The face of a child can say it all, especially the mouth part of the face.</p>',
                        'attribution' => 'Jack Handy'
                    ]
                ]
            ],
        ]
    ];

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        return $this->addBlogPosts()
            && $this->addHomeContent()
            && $this->addAboutContent()
            && $this->addGqlToken();
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        // delete blog posts
        $entrySlugs = array_map(static function($item) {
            return $item['slug'];
        }, $this->entriesContent);

        foreach ($entrySlugs as $entrySlug) {
            if ($entry = Entry::find()->slug($entrySlug)->one()) {
                Craft::$app->getElements()->deleteElementById($entry->id);
            }
        }

        // remove Home content
        $homeEntry = Entry::find()->slug('home')->one();
        $homeEntry->setFieldValue('siteIntroduction', null);
        Craft::$app->getElements()->saveElement($homeEntry);

        // remove About content
        $aboutEntry = Entry::find()->slug('about')->one();

        foreach ($aboutEntry->bodyContent as $block) {
            Craft::$app->getElements()->deleteElement($block);
        }

        // remove GraphQL token
        $graphQlService = Craft::$app->getGql();
        $schemas = $graphQlService->getSchemas();
        $gatsbySchema = null;

        foreach ($schemas as $schema) {
            if ($schema->accessToken === $this->gqlToken) {
                $gatsbySchema = $schema;
                break;
            }
        }

        $graphQlService->deleteSchema($gatsbySchema);

        return false;
    }

    /**
     * Add a few fake blog posts.
     *
     * @return bool
     * @throws \Throwable
     * @throws \craft\errors\ElementNotFoundException
     * @throws \yii\base\Exception
     */
    private function addBlogPosts(): bool
    {
        if (!$section = Craft::$app->getSections()->getSectionByHandle('blog')) {
            echo 'Blog section does not exist.';
            return false;
        }

        $entryType = $section->getEntryTypes()[0];
        $adminUser = User::find()->admin(true)->one();

        foreach ($this->entriesContent as $entryContent) {
            $entry = new Entry();

            $entry->title = $entryContent['title'];
            $entry->slug = $entryContent['slug'];
            $entry->authorId = $adminUser->id;
            $entry->sectionId = $section->id;
            $entry->typeId = $entryType->id;

            $entry->setFieldValues([
                'summary' => $entryContent['summary'],
                'bodyContent' => $entryContent['bodyContent'],
            ]);

            Craft::$app->getElements()->saveElement($entry);
        }

        return true;
    }

    /**
     * Add a site intro to the homepage entry.
     *
     * @return bool
     * @throws \Throwable
     * @throws \craft\errors\ElementNotFoundException
     * @throws \yii\base\Exception
     */
    private function addHomeContent(): bool
    {
        if (!$homeEntry = Entry::find()->slug('home')->status(null)->one()) {
            echo 'Home is missing.';
            return false;
        }

        $homeEntry->setFieldValue('siteIntroduction', '<p>This simple Craft CMS project includes this homepage, a blog section, and an about page. You can use it to see Craft in action with the included Twig templates and headless Gatsby front end.</p>');

        if (!Craft::$app->getElements()->saveElement($homeEntry)) {
            echo 'Failed to save home page: ' . $homeEntry->getErrors()[0];
            return false;
        }

        return true;
    }

    /**
     * Add some text to the about page.
     *
     * @return bool
     * @throws \Throwable
     * @throws \craft\errors\ElementNotFoundException
     * @throws \yii\base\Exception
     */
    private function addAboutContent(): bool
    {
        if (!$aboutEntry = Entry::find()->slug('about')->status(null)->one()) {
            echo 'About page is missing';
            return false;
        }

        $aboutEntry->setFieldValue(
            'bodyContent',
            [
                'new1' => [
                    'type' => 'richText',
                    'fields' => [
                        'richText' => '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'
                    ]
                ],
            ]
        );

        if (!Craft::$app->getElements()->saveElement($aboutEntry)) {
            echo 'Failed to save about page: ' . $aboutEntry->getErrors()[0];
            return false;
        }

        return true;
    }

    /**
     * Add a custom GraphQL access token for testing.
     *
     * @return bool
     * @throws \yii\base\Exception
     */
    private function addGqlToken(): bool
    {
        // for GraphQL feature
        Craft::$app->setEdition(Craft::Pro);

        $graphQlService = Craft::$app->getGql();
        $schemas = $graphQlService->getSchemas();
        $gatsbySchema = null;

        foreach ($schemas as $schema) {
            if (!$schema->isPublic) {
                $gatsbySchema = $schema;
                break;
            }
        }

        // create token
        $token = new GqlToken();

        $token->name = 'Test Gatsby Token';
        $token->accessToken = $this->gqlToken;
        $token->enabled = true;
        $token->expiryDate = null;
        $token->schemaId = $gatsbySchema->id;

        $graphQlService->saveToken($token);

        return true;
    }
}
