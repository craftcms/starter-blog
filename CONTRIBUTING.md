# Contributing

## Intent

This starter project intends to be a learning resource rather than a fully baked website. It is purposefully lean on features. We hope it illuminates front-end workflow with Twig  template best practices, well-documented templates, and a simple front-end build system based on Tailwind CSS.

## Issues and Pull Requests

Please report bugs as issues. Also, please report any documentation you found incomplete or difficult to follow.

## Pull Requests

Pull requests are welcome. Any additions should aim to ease a new developer’s learning effort rather than make this starter project a full-featured blog site.

## Code style

### Twig

Keep within the spirit of the current templates.

* 2 space indentation
* Indent HTML inside of Twig tag pairs
* Keep line lengths short when possible
* Comments can be instructional

### PHP

Follow the [Craft CMS coding guidelines](https://docs.craftcms.com/v3/extend/coding-guidelines.html)

## Webpack and Tailwind CSS

Use Tailwind utility classes in templates for everything. Whatever can’t be done with utility classes in templates can be added to the `scss` files in the `src` folder.

Before submitting a PR, run `npm run dev` and commit the compiled assets. That build includes all of Tailwind’s utility classes so a new developer can use them without much effort. When the developer is ready, they can run `npm run build` which uses Purgecss to remove classes that are not used in Twig templates.
