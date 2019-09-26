require("dotenv").config({
  path: `.env`,
})

module.exports = {
  siteMetadata: {
    title: `Craft Blog`,
    author: `@craftcms`,
    description: `Craft CMS blog starter`,
  },
  plugins: [
    `gatsby-plugin-react-helmet`,
    {
      resolve: `gatsby-source-filesystem`,
      options: {
        name: `images`,
        path: `${__dirname}/src/images`,
      },
    },
    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    {
      resolve: `gatsby-plugin-manifest`,
      options: {
        name: `gatsby-starter-default`,
        short_name: `starter`,
        start_url: `/`,
        background_color: `#663399`,
        theme_color: `#663399`,
        display: `minimal-ui`,
        icon: `src/images/gatsby-icon.png`, // This path is relative to the root of the site.
      },
    },
    {
      resolve: "gatsby-source-graphql",
      options: {
        // This type will contain remote schema Query type
        typeName: "Craft",
        // This is field under which it's accessible
        fieldName: "craft",
        // Url to query from
        url: process.env.CRAFT_API_URL,
        // HTTP headers
        headers: {
          // You should have created a .env file containing your GraphQL API URL and token
          // If you don't have a .env file, refer to the installation docs
          Authorization: `Bearer ${process.env.CRAFT_API_TOKEN}`,
        },
      },
    },
    // SASS Processing
    {
      resolve: `gatsby-plugin-sass`,
      options: {
        // Configure SASS to process Tailwind
        postCssPlugins: [require("tailwindcss")("./tailwind.config.js")],
      },
    },
    // this (optional) plugin enables Progressive Web App + Offline functionality
    // To learn more, visit: https://gatsby.dev/offline
    // `gatsby-plugin-offline`,
  ],
}
