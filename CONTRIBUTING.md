# Contributing

## Intent

This starter project is intended to be a learning resource rather than a fully-baked website, and as such is purposefully lean on features. We hope it helps illuminate some novel front-end tooling, including Twig and Tailwind CSS.

## Issues and Pull Requests

Please report bugs as issues. Also, please report any documentation you found incomplete or difficult to follow.

## Pull Requests

Pull requests are always welcome! We do ask that additions focus on streamlining new developers’ onboarding experience rather than adding features. Contributions that solely add or replace tools (without an immediate, material benefit to new users) will be respectfully declined.

## Code style

### Twig

Keep within the spirit of the current templates.

* 2 space indentation
* Indent HTML inside of Twig tag pairs
* Keep line lengths short when possible
* Comments can be instructional

### PHP

Follow the [Craft CMS coding guidelines](https://craftcms.com/docs/4.x/extend/coding-guidelines.html).

## Webpack and Tailwind CSS

Use Tailwind utility classes in templates for everything. Whatever can’t be done with utility classes in templates can be added to the `scss` files in the `src` folder.

Before submitting a PR, run `npm run dev` and commit the compiled assets. That build includes all of Tailwind’s utility classes so a new developer can use them without much effort. When the developer is ready, they can run `npm run build` which uses Purgecss to remove classes that are not used in Twig templates.
