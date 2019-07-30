const purgecss = require('@fullhuman/postcss-purgecss')({
  content: [
    './templates/**/*.html',
    './templates/**/*.twig'
  ],
  whitelistPatterns: [
      /embed-\w+/,
      /position-\w/,
      /iframe/
  ],

  defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
});

module.exports = {
  plugins: [
    require('tailwindcss'),
    require('autoprefixer'),
    ...process.env.NODE_ENV === 'production'
        ? [purgecss]
        : []
  ]
};
