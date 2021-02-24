# Craft CMS Blog Starter

This blog starter project is for developers who are new to Craft CMS and want to learn the basics quickly. It tries not to be too prescriptive while demonstrating a few essentials of Craft development with the Twig templating language.

### Topics, features, and implementations:

- Matrix as a page-builder field
- Template inheritance with layouts
- Dynamic template inclusion
- Twig macros
- Paginated entry list
- Responsive images
- Local asset volumes
- Error pages
- Plugins
- Front-end development with Webpack and Tailwind CSS

### It’s free to use

When you install this starter, you’ll see that it’s running Craft Solo which is free to use for any purpose. The installed plugins are also free. You can upgrade to Craft Pro or add paid plugins any time. See our [pricing page](https://craftcms.com/pricing) for details and feature comparisons.

## Navigation

* [Learning Resources](#learning-resources)
* [Installation](#installation)
  * [Clone this repo](#clone-this-repo)
  * [Set up your local environment](#set-up-your-local-environment)
  * [Create `.env`](#create-env)
  * [Install Composer packages](#install-composer-packages)
  * [Install Craft](#install-craft)
* [Learn Craft](#learn-craft)
  * [Create some content](#create-some-content)
  * [Look at the settings](#look-at-the-settings)
  * [Look at the template files](#look-at-the-template-files)
  * [Try something new](#try-something-new)
* [CSS and JS Development with Tailwind CSS, Webpack, and HMR](#css-and-js-development-with-tailwind-css-webpack-and-hmr)
  * [Removal](#removal)
  * [Setup](#setup)
  * [Tailwind Development Flow](#tailwind-development-flow)
* [Go headless with GraphQL](#go-headless-with-graph-ql)
  * [Switch to Pro trial](#switch-to-pro-trial)
  * [Headless Mode](#headless-mode)
  * [Set up a GraphQL API endpoint](#set-up-a-graph-ql-api-endpoint)
  * [Create GraphQL schemas and private tokens](#create-graph-ql-schemas-and-private-tokens)
  * [Try our Gatsby starter](#try-our-gatsby-starter)
* [Appendix](#appendix)
  * [Apache or Nginx?](#apache-or-nginx)
  * [MySQL or Postgres?](#my-sql-or-postgres)
  * [URL Rewrites](#url-rewrites)

## Learning Resources

Before you get started, we want you to know about a few helpful learning resources.

Our official training partner, [CraftQuest](https://craftquest.io), provides many free training videos just for creating a free account. You’ll find excellent paid tutorials on advanced topics as well.

The [nystudio107 blog](https://nystudio107.com/blog) has some great articles on advanced topics such as optimization, module development, etc.

You’re always welcome in the [Craft Discord chat](https://craftcms.com/community). You’ll find a lot of super friendly, knowledgeable, Craft developers. Stop in and say hi!

## Installation

Install [Composer](https://getcomposer.org/download/) if it is not installed already.

### Clone this repo

Open up a terminal window in a directory where you’d like to install Craft and run the following.

```bash
git clone git@github.com:craftcms/starter-blog.git
```

Move into the newly created project folder.

```bash
cd starter-blog
```

You’re starting your own project so you don’t need the Git project.

```bash
rm -rf .git
```

### Set up your local environment

This part is up to you. Some folks use [MAMP](https://www.mamp.info/) or [WAMP](http://www.wampserver.com/en/). Others use [Laravel Valet](https://laravel.com/docs/valet).

Point your server to the `/web` directory where the `index.php` file lives.

See the [Appendix](#appendix) section for information on Apache vs. Nginx and MySQL vs. Postgres. Basically, it’s simpler to use Apache if you're getting started. MySQL is perfectly fine but might result in unexpected search results without some configuration.

⚠️ Check Craft’s [server requirements](https://docs.craftcms.com/v3/requirements.html) before getting started. The default PHP configuration doesn’t allocate enough resources to Craft. Read about `php.ini` settings in our guide, [How to Make Changes to php.ini](https://craftcms.com/guides/php-ini).


### Create `.env`

Craft depends on environment variables set in a root `.env` file so you’ll need to copy the `.env.example` over.

```bash
cp .env.example .env
```

⚠️ It is important to do that _before_ installation. This starter project requires a couple of special environment variables found in `.env.example` that will not exist if you run the installer first.

### Install Composer packages

```bash
composer install
```

👀 You might see some error output about cache clearing. Not to worry! Craft isn’t installed yet, so that’s perfectly fine.

### Install Craft

Start by running this:

```bash
php craft setup
```

That command will generate a random value for `SECURITY_KEY` in the `.env` file. It will also ask you for database credentials, update the `.env` file accordingly, and test the database connection.

You’ll be asked if you’d like to install Craft right away. If you choose not to, you can come back later and run:

```bash
php craft install
```

You’ll be asked for things like a username, email, password, and more. These values will be written to the `.env` file and the installer will run.

⚠️ Watch for this line:

```bash
Site URL: [$DEFAULT_SITE_URL]
```

Be sure to enter the site URL as set up with your local server. If you miss it, you can edit it later by hand in the `.env` file which should have a variable named `DEFAULT_SITE_URL`. This is important because the AssetRev plugin configuration relies on it.

You can edit values in `.env` by hand if you don’t want to run those commands again.

After the installer runs you should be able to see log into the Control Panel at `http://local-site-name.test/admin`.

## Learn Craft

### Create some content

This starter project ships without any content so you get to start from scratch. The Control Panel should feel pretty intuitive. Start by adding some content and watch how the site comes together. [Unsplash](https://unsplash.com/) is a great place to grab free images if you need some to play with.

When you add an image with an image field, you’ll see a thumbnail of it. Double-click that thumbnail to reveal editing options.

### Look at the settings

In the Control Panel, go to Settings → Sections.

#### Fields

Take a look at the fields to see how they are configured. Take note of the Matrix field named Body Content. Developers to use the Matrix field as a page builder field quite often. Each Matrix block represents a content module that content creators may use to piece together pages creatively and safely.

#### Sections

You’ll find three Sections: Two Singles and one Channel. Singles are for standalone evergreen pages and Channels are for listable content like news articles. There is also a Structure section type, but that’s not implemented in this starter.

#### Assets

This starter includes one local asset volume for all of your uploads. You’ll find a related `/web/uploads` folder. Take a look at the Uploads volume settings to see how it’s configured. You’ll find that it has a Field Layout tab with a couple of fields applied to it. It is possible for uploaded Assets to have custom fields for metadata.

You can add images directly to the `/web/uploads/images` folder rather than via the Control Panel. They won’t show up in the Control Panel until they’re indexed. Go to Utilities → Asset Indexes, and click the “Update asset indexes” button.

### Look at the template files

Be sure to read up on Craft’s [front-end development docs](https://docs.craftcms.com/v3/dev/) for Twig templating features. Twig is not unique to Craft. It’s a well-loved PHP templating language. You’ll want to read up on [Twig’s documentation](https://twig.symfony.com/doc/2.x/) too.

Take a look at the files in the `/templates` folder. There are comments throughout the templates to help you understand what’s going on and why.

The files are named with the `.html` extension but `.twig` also works. Some developers prefer `.twig` so their IDE (like the free [Visual Studio Code](https://code.visualstudio.com/)) automatically knows to use Twig syntax highlighting.

You might wonder why a folder name starts with an underscore. If so, read up on [routing](https://docs.craftcms.com/v3/routing.html#dynamic-routes). Craft will automatically route template paths as URL paths. For example if you create a file `/templates/foo/bar.html` then you will see that template render at `http://mysite.test/foo/bar`. If you’d like to keep template folders or  files private, prepend the name with an underscore so Craft will ignore it. In this starter project, there is a single folder, `_private` to hold all templates that should not be publicly accessible.

### Try something new

Try adding a feature of your own. For example, you might like to add categories to your blog posts and have listing pages for them.

#### Create an empty template

Make a new, empty file here:  `/templates/_private/category.html`. It doesn’t need any code yet.

#### Create a new category group

1. Go to Settings → Categories and create a new category group named Topics
2. Set Max Levels to `1`
3. Set the URI format to `topic/{slug}`
4. Set the Template path to the template you created in the first step.
5. Save it

#### Create a new category field

1. Go to Settings → Fields and create a Categories field for your new category
2. Go to Settings → Sections → Blog and add your new field under the Field Layout tab

Now you can add categories to your blog entries.

#### Modify your category template

Copy over code from the `/templates/_private/home.html` template.

Find the `<h1>` tag and modify the `<a>` tag like so:

```twig
<a href="{{ category.url }}">Topic: {{ category.title }}</a>
```

Find the element query that looks like this:

```twig
{% set query = craft.entries()
  .section('blog')
  .limit(10) %}
```

Change it to this:

```twig
{% set query = craft.entries()
  .relatedTo(category)
  .limit(10) %}
```

Find and delete this:

```twig
{% if pageInfo.currentPage == 1 %}
  {{ entry.siteIntroduction }}
{% endif %}
```

#### Add some categories

1. Go to Categories in the left navigation in the Control Panel and create a few topics
2. Go to some blog entries and add categories to them

#### Test it

Go to `mysite.test/topic/a-topic-slug` to see a list of blog posts related to that topic.

#### Finish it

You’ll want to expose these categories somewhere like the main navigation, or in a sidebar, or as tags under a blog post title. We’ll leave that excercise to you because we’re sure you have your own preferences.

Here are a few tips:

To create a navigation menu for the Topics category you created, you could do something like this:

```twig
{% set allCategories = craft.categories.group('topics').all() %}
```

To get the first (or only) category from a blog entry, assuming your category field handle is `topic`, you’d do this:

```twig
{% set category = entry.topic.first() %}

{% if category %}{{ category.link }}{% endif %}

{# OR #}

{% if category %}
  <a href="{{ category.url }}" class="class names">{{ category.title }}</a>
{% endif %}
```

If you’d like to feature three other blog posts within the same category at the bottom of a blog post, you can grab them like so:

```twig
{% set category = entry.topic.first() %}

{% if category %}
	{% set otherBlogPosts = craft.entries()
	  .relatedTo(category)
	  .not(entry)
    .limit(3)
    .all() %}
  
  {% if otherBlogPosts | length %}
  	<h3>You might also like:<h3>
  	<ul>
	  	{% for otherBlogPost in otherBlogPosts%}
	  	  <li>{{ otherBlogPost.link }}<li>
	  	{% endfor %}
	  </ul>
  {% endif %}
{% endif %}
```

We’ll leave the rest to you!

## CSS and JS Development with Tailwind CSS, Webpack, and HMR

[Webpack](https://webpack.js.org/) and [Tailwind CSS](https://tailwindcss.com/) are popular front-end technologies. We chose Tailwind because it allows you to quickly style things by adding utility classes to HTML elements.

### Removal

We hope you’ll give it a go, but if you prefer not to, then delete these folders and files:

* `src/`
* `package.json`
* `package-lock.json`

In the `/templates/layout/main.html` find this:

```twig
{% set stylesheet = rev('main.css') %}
{% if stylesheet %}
  <link rel="stylesheet" href="{{ rev('main.css') }}">
{% endif %}
```

Replace it with a link to your own stylesheet.

You can also safely uninstall and remove the Asset Rev plugin from the Control Panel and the `/config/assetrev.php` file from the project.

### Setup

If you don’t have Node.js and `npm` installed, you’ll find an installer on the
[NPM website](https://www.npmjs.com/get-npm). Do that first.

Open up a terminal window in the root of this project and run:

```bash
npm install
```

### Tailwind Development Flow

All of the SCSS and JavaScript files are in the project root `/src` folder.

There are three npm scripts you can run:

#### Development Build

```bash
npm run dev
```

The above command  builds the largest possible css file with all of Tailwind’s classes available to you. The resulting file is a bit large for production, but it allows you to explore all of the possibilities.

#### Production Build

```bash
npm run production
```

The above command will minify all of the CSS and JavaScript. It will also remove any classes that aren’t actually used in the `/template` files resulting in a very small file.

#### Hot Module Reloading (HMR)

For this to work you must make sure you are in Dev Mode. Check the `/.env` file to make sure you see this:

```bash
ENVIRONMENT="dev"
```

Then run this script:

```bash
npm run hot
```

Refresh the browser. Now you’ll see changes in the browser immediately (without a page refresh) as you edit `.scss` files in the `/src` folder. Hot module reloading does not apply to changes made in Twig templates.

When you’re done, cancel the npm process with CTRL+C.

You can build minified CSS and JS for production by running:

```bash
npm run build
```

If you’d rather compile without minification, run:

```bash
npm run production
```

## Go headless with GraphQL

Craft Pro includes a native GraphQL implementation which makes Craft perfect for front-end frameworks like [Gatsby](https://www.gatsbyjs.org/) and [Gridsome](https://gridsome.org/).

See Craft’s [GraphQL documentation](https://docs.craftcms.com/v3/graphql.html#getting-started) to learn more about it.

### Switch to Pro trial

Craft is installed with the free Solo edition. In your local environment, you can switch to Pro in trial mode with no time limits. That allows you to try Pro features as well as commercial plugins for as long as you like. Read more about that in our guide, [Try Craft Pro & Plugins Before Buying](https://craftcms.com/guides/try-craft-pro-plugins-before-buying).

To enable GraphQL support, find the “Solo” badge at the bottom of the left side navigation column and click it. On the next screen, under the Pro edition block, click the “Try for free” button. After trial mode is enabled, refresh the browser. You should now see a GraphQL menu item.

### Headless Mode

If you want to use Craft purely as a headless CMS and clean things up then set the [`headlessMode` configuration](https://docs.craftcms.com/v3/config/config-settings.html#headlessmode) in `/config/general.php`.

```php
return [
    // Global settings
    '*' => [
        // ... other settings
        'headlessMode' => true,
    ],
    // ... other environment settings
];
```

You can also remove these files and folders:

* All files in the `templates` folder
* All front-end development files and folders
  * `/node_modules` (if you previously ran `npm install`)
  * `/src`
  * `package-lock.json`
  * `package.json`
  * `postcss.config.js`
  * `tailwind.config.js`
  * `webpack.config.js`

### Set up a GraphQL API endpoint

Edit the `/config/routes.php` file to look like this:

```php
return [
    'api' => 'graphql/api'
];
```

The `'api'` key can be any route you prefer as long as it maps to `graphql/api`.

### Create GraphQL schemas and private tokens

Go to GraphQL → Schemas. You’ll see one public schema for which you can add access to various elements. You can also create private schemas with tokens, each with their own permissions.

### Try our Gatsby starter

You’ll find a Craft + Gatsby blog starter in the `/headless-front-end/gatsby` directory. Check out that [README](/headless-front-end/gatsby/README.md) to get started with it.

## Appendix

### Apache or Nginx?

If you’re just getting started with Craft, roll with Apache. See the [URL rewrites appendix](#url-rewrites) above to learn why. Otherwise, it’s up to you!

### MySQL or Postgres?

Craft likes both. MySQL is the most popular but you should be aware of a caveat that produces [unexpected search results](https://github.com/craftcms/cms/issues/3240) and how to solve it by [enabling fuzzy search](https://craftcms.com/guides/enabling-fuzzy-search-by-default). 

Spoiler: Add this to your `config/general.php` file under the `'*'` array key:

```php
'defaultSearchTermOptions' => [
    'subLeft' => true,
    'subRight' => true,
],
```

### URL Rewrites

If you’re coming to Craft from WordPress then this topic is in line with [enabling pretty URLs](https://wordpress.org/support/article/using-permalinks/#mod_rewrite-pretty-permalinks), and should feel familiar. See our guide, [Removing “index.php” from URLs](https://craftcms.com/guides/removing-index-php-from-urls).

Craft’s default setup assumes you want to see urls like this:

```
http://mysite.test/path/to/entry
```

Not URLs like:

```
http://mysite.test/index.php?p=path/to/entry
```

Craft ships with the following configuration setting:

```php
# file /config/general.php
...
'omitScriptNameInUrls' => true,
...
```

That tells Craft to leave `index.php?p=` out of any URLs it generates. If server URL rewrites are not set up correctly, then Craft-generated links will be broken.

Craft also ships with an `.htaccess` file in the `/web` directory that will rewrite URLs correctly for Apache as long as `mod_rewrite`  and `AllowOverride` are enabled.  Most local environment options are configured this way already.

If your links are still broken, don’t let it slow you down. Set the configuration setting like so:

```php
# file /config/general.php
...
'omitScriptNameInUrls' => false,
...
```

URLs might not be pretty, but you can get to work!

