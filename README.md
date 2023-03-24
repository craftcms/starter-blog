# Craft CMS Blog Starter

This blog starter project is for developers who are new to Craft CMS and want to learn the basics quickly. It seeks to demonstrate a few Craft essentials, without being too prescriptive about other parts of your development toolkit. You’ll get a turn-key front-end built on the native Twig templating language.

### Topics, features, and implementations:

- Using a [Matrix field](https://craftcms.com/docs/4.x/matrix-fields.html) as a page-builder;
- [Templating fundamentals](https://craftcms.com/docs/4.x/dev/twig-primer.html#dry-templating), including: inheritance with layouts, dynamic includes, and macros;
- [Pagination](https://craftcms.com/docs/4.x/element-queries.html#pagination) of entries;
- Responsive images
- Local asset volumes
- [Error pages](https://craftcms.com/docs/4.x/routing.html#error-templates)
- Installation and configuration of [plugins](https://plugins.craftcms.com)
- Front-end development with Webpack and Tailwind CSS

### It’s free to use

When you install this starter, you’ll see that it’s running Craft Solo, which is free to use for any purpose. The installed plugins are also free. You can upgrade to Craft Pro or add paid plugins any time. See our [pricing page](https://craftcms.com/pricing) for details and feature comparisons.

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

This project is designed to work with [DDEV](https://ddev.readthedocs.io/en/stable/), our recommended local development environment.

### Clone this repo

Open up a terminal window in a directory where you’d like to install Craft and run the following:

```bash
git clone git@github.com:craftcms/starter-blog.git
```

Move into the newly created project folder:

```bash
cd starter-blog
```

Assuming you are starting your own project (rather than contributing to this repo), you don’t need to keep the existing git history:

```bash
rm -rf .git
# (Optional) Start a new repository:
git init .
```

### Set up your local environment

> **Note**  
> You are welcome to use any local development tool you like—but these instructions only cover [DDEV](https://ddev.readthedocs.io/en/stable/).
> 
> As long as the environment is capable of using the `web/` directory as the “web root,” you’ll be able to try it out!

### Create `.env`

Craft depends on environment variables set in a root `.env` file so you’ll need to copy the `.env.example` over.

```bash
cp .env.example .env
```

> **Warning**
> It’s important that you do this _before_ installation. This starter project requires a couple of special environment variables found in `.env.example` that will be missing if you let the installer (or DDEV) populate the file.

### Start DDEV

[DDEV](https://ddev.readthedocs.io/en/stable/) is a Docker-based development environment that makes spinning up Craft projects quick and reliable. The required configuration files were cloned with the repo, so all you need to do is run:

```bash
ddev start
```

### Install Composer packages

Running Composer with DDEV ensures that everything is done within the appropriate PHP environment:

```bash
ddev composer update
```

Why `update`? `composer install` will work just fine (using the existing `composer.lock` file)—but as you’re getting set up, we might as well make sure everything is up-to-date.

You might see some error output about cache clearing—not to worry! Craft isn’t installed yet, so that’s perfectly fine.

### Install Craft

Run the setup wizard with this command:

```bash
ddev craft setup
```

Craft will generate a random value for `SECURITY_KEY` in your `.env` file. It will also ask you for database credentials, update the `.env` file accordingly (if necessary), and test the database connection.

You’ll be asked if you’d like to install Craft right away. If you choose not to, you can come back later and run:

```bash
ddev craft install
```

The setup wizard will also prompt you for details about your first account, including a username, email, and password. You’ll use these in just a moment!

> **Note**  
> If you are not using DDEV, you will need to provide a “Site URL” setting during installation.

After the installer runs you should be able to see log into the Control Panel at `https://starter-blog.ddev.site/admin`. You can also run `ddev launch admin` to open a browser, directly.

## Learn Craft

### Create some content

This starter project ships without any content, so you get familiarize yourself with Craft’s intuitive [control panel](https://craftcms.com/docs/4.x/control-panel.html) while populating it. Start by adding some content and watch how the site comes together.

(If you would prefer to just have some bogus content to get started, you can run `ddev craft up` to execute the included seed/content migration.)

> **Note**  
> [Unsplash](https://unsplash.com/) is a great place to grab free images if you need some to play with.
> When you add an image with an image field, you’ll see a thumbnail of it. Double-click that thumbnail to reveal more editing options.

### Look at the settings

In the Control Panel, go to **Settings** → **Sections**.

#### Fields

Take a look at the fields to see how they are configured. Take note of the Matrix field named _Body Content_. Developers use the Matrix field as a page builder field quite often. Each Matrix block represents a content module that content authors may use to piece together pages creatively—and safely.

#### Sections

You’ll find three Sections: Two [Singles](https://craftcms.com/docs/4.x/entries.html#singles) and one [Channel](https://craftcms.com/docs/4.x/entries.html#channels). Singles are for standalone, evergreen pages and Channels are for listable content like news articles. Craft also has a hierarchical section type, [Structure](https://craftcms.com/docs/4.x/entries.html#structures), but it is not used in this project.

#### Assets

This starter includes one local asset volume for all of your uploads. You’ll find a related `/web/uploads` folder. Take a look at the Uploads volume settings to see how it’s configured. You’ll find that it has a Field Layout tab with a couple of fields applied to it. It is possible for uploaded Assets to have custom fields for metadata.

> **Note**  
> If you want to start with a large image library, you can copy images directly to the `/web/uploads/images` folder, then run the asset indexing tool from the control panel (**Utilities** → **Asset Indexes**), or via the CLI: `ddev craft index-assets/one uploads`.

### Look at the template files

Be sure and read up on Craft’s [front-end development docs](https://craftcms.com/docs/4.x/dev/) for Twig templating features. Twig is not unique to Craft! It’s a well-loved, PHP-driven templating language, with great [documentation](https://twig.symfony.com/doc/3.x/) of its own.

Take a look at the files in the `/templates` folder. There are comments throughout the templates to help you understand what’s going on—and why things are set up as they are. The `.twig` extension is not required (`.html` is also acceptable), but it provides a hint to IDEs (like the free [Visual Studio Code](https://code.visualstudio.com/)) that they should use special rules for syntax highlighting.

> **Note**  
> Curious about the folders with underscores? When Craft doesn’t find a matching element URL or [route](https://craftcms.com/docs/4.x/routing.html), it automatically looks for a file in your `templates/` with the request’s path. For example, if you create `templates/foo/bar.twig` then Craft will render that template when the URL `https://starter-project.ddev.site/foo/bar` is requested. If you’d like to keep template folders (or individual files) private, prepend the name with an underscore (`_`). In this starter project, there is a single folder, `_private`, to hold all templates that should not be publicly accessible.
>
> You can still use a “private” template in a section’s settings!

### Try something new

Try adding a feature of your own. For example, you might like to add [categories](https://craftcms.com/docs/4.x/categories.html) to your blog posts and have listing pages for them.

#### Create an empty template

Make a new, empty file here:  `templates/_private/category.twig`. It doesn’t need any code yet.

#### Create a new category group

1. Go to **Settings** → **Categories** and create a new category group named Topics
2. Set Max Levels to `1`
3. Set the URI format to `topic/{slug}`
4. Set the Template path to the template you created in the first step.
5. Save it.

#### Create a new category field

1. Go to **Settings** → **Fields** and create a **Categories** field for your new group.
2. Go to **Settings** → **Sections** → **Blog** and add your new field under the _Field Layout_ tab.

Back on a blog entry, you can now assign categories, or create new ones on-the-fly!

> **Note**  
> Double-click an attached category to edit it, in-place.

#### Modify your category template

Copy over code from the `templates/_private/home.twig` template.

Find the `<h1>` tag and modify the `<a>` tag like so:

```twig
<a href="{{ category.url }}">Topic: {{ category.title }}</a>
```

Find the [element query](https://craftcms.com/docs/4.x/element-queries.html) that looks like this…

```twig
{% set query = craft.entries()
  .section('blog')
  .limit(10) %}
```

…and add `.relatedTo(category)` to it, like this:

```twig
{% set query = craft.entries()
  .section('blog')
  .relatedTo(category)
  .limit(10) %}
```

Finally, find and delete this:

```twig
{% if pageInfo.currentPage == 1 %}
  {{ entry.siteIntroduction }}
{% endif %}
```

#### Add some categories

If you haven’t already added some categories, now’s the time!

1. Go to **Categories** in the left navigation in the control panel and create a few topics
2. Go to some blog entries and add categories to them

#### Test it

Visit `https://starter-blog.ddev.site/topic/{a-topic-slug}` to see a list of blog posts related to one of your topics! You can find the slug of a topic on its edit screen, at the top of the right-hand column.

#### Finish it

You’ll want to expose these categories somewhere, like the main navigation, in a sidebar, or as “tags” under a blog post title.

Here are a few tips to get you going…

To create a navigation menu for the _Topics_ category you created, you could do something like this:

```twig
{% set allCategories = craft.categories.group('topics').all() %}
```

> **Note**  
> This query will work anywhere—Craft doesn’t limit where your content can be accessed or output.

To get the first (or only) category from a blog entry (assuming your category field’s handle is `topic`) you’d do this:

```twig
{% set category = entry.topic.one() %}

{% if category %}{{ category.link }}{% endif %}

{# OR #}

{% if category %}
  <a href="{{ category.url }}" class="class names">{{ category.title }}</a>
{% endif %}
```

If you’d like to feature three other blog posts within the same category at the bottom of a blog post, you can grab them like so:

```twig
{% set category = entry.topic.one() %}

{% if category %}
  {% set otherBlogPosts = craft.entries()
    .relatedTo(category)
    .not(entry)
    .limit(3)
    .all() %}

  {% if otherBlogPosts | length %}
    <h3>You might also like:<h3>
    <ul>
      {% for otherBlogPost in otherBlogPosts %}
        <li>{{ otherBlogPost.link }}<li>
      {% endfor %}
    </ul>
  {% endif %}
{% endif %}
```

We’ll leave the rest to you!

## CSS and JS Development with Tailwind CSS, Webpack, and HMR

[Webpack](https://webpack.js.org/) and [Tailwind CSS](https://tailwindcss.com/) are popular front-end technologies. We chose Tailwind because it allows you to quickly add style to your markup with “utility classes.”

### Removal

We hope you’ll give it a go, but if you prefer not to, then delete these folders and files:

* `src/`
* `package.json`
* `package-lock.json`

In the `templates/layout/main.twig` find this:

```twig
{% set stylesheet = rev('main.css') %}
{% if stylesheet %}
  <link rel="stylesheet" href="{{ rev('main.css') }}">
{% endif %}
```

Replace it with a link to your own stylesheet.

You can also safely uninstall and remove the Asset Rev plugin from the Control Panel (and delete the `config/assetrev.php` file).

### Setup

DDEV comes installed with Node and [NPM](https://www.npmjs.com). From your project folder, run:

```bash
ddev npm install
```

### Tailwind Development Flow

All of the SCSS and JavaScript files are in the project root `src/` folder.

There are three npm scripts you can run:

#### Development Build

```bash
ddev npm run dev
```

The above command  builds the largest possible css file with _all_ of Tailwind’s classes available to you. The resulting file is generally considered too large for production use, but it allows you to explore all of the possibilities during development.

#### Production Build

```bash
ddev npm run production
```

The above command will minify all of the CSS and JavaScript. It will also remove any classes that aren’t actually used in the `/template` files resulting in a very small file.

#### Hot Module Reloading (HMR)

For this to work you must make sure you are in Dev Mode. Check the `/.env` file to make sure you see this:

```bash
ENVIRONMENT="dev"
```

Then run this script:

```bash
ddev npm run hot
```

Refresh the browser. Now you’ll see changes in the browser immediately (without a page refresh) as you edit `.scss` files in the `/src` folder. Hot module reloading does not apply to changes made in Twig templates.

When you’re done, cancel the npm process with CTRL+C.

You can build minified CSS and JS for production by running:

```bash
ddev npm run build
```

If you’d rather compile without minification, run:

```bash
ddev npm run production
```

## Go headless with GraphQL

Craft Pro includes a native GraphQL implementation which makes Craft perfect for front-end frameworks like [Gatsby](https://www.gatsbyjs.org/) and [Gridsome](https://gridsome.org/).

See Craft’s [GraphQL documentation](https://craftcms.com/docs/4.x/graphql.html) to learn more about it.

### Switch to Pro trial

Craft is installed with the free Solo edition. In your local environment, you can switch to Pro in trial mode with no time limits. That allows you to try Pro features as well as commercial plugins for as long as you like. Read more about that in our guide, [Try Craft Pro & Plugins Before Buying](https://craftcms.com/guides/try-craft-pro-plugins-before-buying).

To enable GraphQL support, find the “Solo” badge at the bottom of the left side navigation column and click it. On the next screen, under the Pro edition block, click the “Try for free” button. After trial mode is enabled, refresh the browser. You should now see a GraphQL menu item.

### Headless Mode

If you want to use Craft purely as a headless CMS, set the [`headlessMode` configuration](https://craftcms.com/docs/4.x/config/config-settings.html#headlessmode) in `/config/general.php`:

```php
return GeneralConfig::create()
  // ...
  ->headlessMode(true)
  // ...
;
```

Assuming your front-end is in another repository, you are free to remove these files and folders:

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

Edit `config/routes.php` to look like this:

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

