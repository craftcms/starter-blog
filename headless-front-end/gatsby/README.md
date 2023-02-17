# Headless Craft CMS Blog + Gatsby Starter

This Gatsby starter is intended for use with Craft’s blog starter project as the back end. If you haven’t set it up yet, start with the root-level [README](../../README.md) to get Craft up and running. Be sure to follow the instructions in the headless section.

> **Note**  
> This guide assumes that your main project is running in a DDEV environment, and Gatsby is running on the host machine. Previews should work fine (this endpoint is requested from the browser), but you may encounter unusual behavior when using the “build” hooks, which require that Craft is able to reach the defined endpoint. `localhost` means something different from inside a container!

## Install the dependencies

We’ll assume you have [Node.js](https://nodejs.org) and [npm](https://www.npmjs.com/) (or [yarn](https://yarnpkg.com)) installed and have a basic understanding of Node development.

### Gatsby CLI

Gatsby development requires that you have Gatsby CLI installed.

```bash
npm install -g gatsby-cli
```

### Install the dependencies

Make sure you’re in this `/headless-front-end/gatsby` directory in your terminal, then run:

```bash
npm install
```

### Configure Craft as your data source

Craft should be running under the Pro edition to enable GraphQL support. Before proceeding, make sure you have completed the steps in the headless section of the root-level [README](../../README.md).

1. Log into Craft’s control panel and go to GraphQL → Schemas.
2. Create a new schema.
3. Name the schema, set permissions, enable **Allow discovery of sourcing data for Gatsby**, and copy the auto-generated token before you save it.

### Create `.env`

In this `gatsby` directory, make a copy of `.env.example` named `.env`.

```bash
cp .env.example .env
```

Update the `.env` file:

```bash
CRAFTGQL_TOKEN="[[ Insert the token you got from Craft’s control panel! ]]"
CRAFTGQL_URL=https://starter-blog.ddev.site/api
```

The `/api` [endpoint](https://craftcms.com/docs/4.x/graphql.html#create-your-api-endpoint) route is set up in Craft’s `config/routes.php` file.

If you’re using Craft’s [live preview feature with Gatsby](https://github.com/craftcms/gatsby-source-craft#live-preview), you’ll also need to add one more line to your `.env` file:

```bash
ENABLE_GATSBY_REFRESH_ENDPOINT=true
```

For more in-depth setup instructions, see our official [Gatsby Source plugin](https://github.com/craftcms/gatsby-source-craft).

### Start developing!

Now that everything is configured, you can get off to the races by running:

```bash
gatsby develop
```

When you’re ready to compile for production, run:

```bash
gatsby build
```

Refer to the `package.json` file for other scripts you can run.

## 🧐 What's inside?

A quick look at the top-level files and directories you'll see in a Gatsby project.

    .
    ├── node_modules
    ├── src
    ├── .gitignore
    ├── .prettierrc
    ├── gatsby-browser.js
    ├── gatsby-config.js
    ├── gatsby-node.js
    ├── gatsby-ssr.js
    ├── LICENSE
    ├── package-lock.json
    ├── package.json
    └── README.md

1.  **`/node_modules`**: This directory contains all of the modules of code that your project depends on (npm packages) are automatically installed.

2.  **`/src`**: This directory will contain all of the code related to what you will see on the front-end of your site (what you see in the browser) such as your site header or a page template. `src` is a convention for “source code”.

3.  **`.gitignore`**: This file tells git which files it should not track / not maintain a version history for.

4.  **`.prettierrc`**: This is a configuration file for [Prettier](https://prettier.io/). Prettier is a tool to help keep the formatting of your code consistent.

5.  **`gatsby-browser.js`**: This file is where Gatsby expects to find any usage of the [Gatsby browser APIs](https://www.gatsbyjs.org/docs/browser-apis/) (if any). These allow customization/extension of default Gatsby settings affecting the browser.

6.  **`gatsby-config.js`**: This is the main configuration file for a Gatsby site. This is where you can specify information about your site (metadata) like the site title and description, which Gatsby plugins you’d like to include, etc. (Check out the [config docs](https://www.gatsbyjs.org/docs/gatsby-config/) for more detail).

7.  **`gatsby-node.js`**: This file is where Gatsby expects to find any usage of the [Gatsby Node APIs](https://www.gatsbyjs.org/docs/node-apis/) (if any). These allow customization/extension of default Gatsby settings affecting pieces of the site build process.

8.  **`gatsby-ssr.js`**: This file is where Gatsby expects to find any usage of the [Gatsby server-side rendering APIs](https://www.gatsbyjs.org/docs/ssr-apis/) (if any). These allow customization of default Gatsby settings affecting server-side rendering.

9.  **`LICENSE`**: Gatsby is licensed under the MIT license.

10. **`package-lock.json`** (See `package.json` below, first). This is an automatically generated file based on the exact versions of your npm dependencies that were installed for your project. **(You won’t change this file directly).**

11. **`package.json`**: A manifest file for Node.js projects, which includes things like metadata (the project’s name, author, etc). This manifest is how npm knows which packages to install for your project.

12. **`README.md`**: A text file containing useful reference information about your project.

## 🎓 Learning Gatsby

Looking for more guidance? Full documentation for Gatsby lives [on the website](https://www.gatsbyjs.org/). Here are some places to start:

- **For most developers, we recommend starting with our [in-depth tutorial for creating a site with Gatsby](https://www.gatsbyjs.org/tutorial/).** It starts with zero assumptions about your level of ability and walks through every step of the process.

- **To dive straight into code samples, head [to our documentation](https://www.gatsbyjs.org/docs/).** In particular, check out the _Guides_, _API Reference_, and _Advanced Tutorials_ sections in the sidebar.
