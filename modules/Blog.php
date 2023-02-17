<?php
namespace modules;

use Craft;

/**
 * Custom "Blog" module class.
 *
 * This class will be available throughout the system via:
 * 
 * ```php
 * Craft::$app->getModule('blog');
 * 
 * // ...or...
 * 
 * use modules\Blog;
 * Blog::getInstance();
 * ```
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, make sure this line
 * is in `config/app.php`:
 *
 *     'bootstrap' => ['blog']
 *
 * Learn more about Yii module development in the Craft or Yii documentation:
 * @see http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 * @see https://craftcms.com/docs/4.x/extend/module-guide.html
 */
class Blog extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
        // Set a @blog alias pointed to the modules/ directory
        Craft::setAlias('@blog', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'blog\\console\\controllers';
        } else {
            $this->controllerNamespace = 'blog\\controllers';
        }

        parent::init();

        // Custom initialization code goes here...
    }
}
