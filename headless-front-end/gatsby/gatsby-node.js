/**
 * Implement Gatsby's Node APIs in this file.
 *
 * See: https://www.gatsbyjs.org/docs/node-apis/
 */

const path = require(`path`)

exports.createPages = ({ graphql, actions }) => {
  const { createPage } = actions
  const blogPostTemplate = path.resolve(`src/templates/blog-post.js`)

  return graphql(
    `
      query BlogPostsQuery {
        blogPosts: allCraftBlogBlogEntry {
          nodes {
            remoteId
            slug
          }
        }
      }
    `,
    { limit: 1000 }
  ).then(result => {
    if (result.errors) {
      throw result.errors
    }

    const posts = result.data.blogPosts.nodes

    // Create blog post pages.
    posts.forEach(post => {
      createPage({
        // Path for this page — required
        path: `/blog/${post.slug}`,
        component: blogPostTemplate,
        context: {
          slug: post.slug,
        },
      })
    })

    // Create blog post list pages (for pagination)
    const postsPerPage = 10
    const numPages = Math.ceil(posts.length / postsPerPage)

    Array.from({ length: numPages }).forEach((_, i) => {
      const currentPage = i + 1
      const nextUrl = numPages !== currentPage ? `/p${currentPage + 1}` : null
      const prevUrl =
        currentPage !== 1
          ? currentPage === 2
            ? "/"
            : `/p${currentPage - 1}`
          : null

      createPage({
        path: i === 0 ? `/` : `/p${currentPage}`,
        component: path.resolve("./src/templates/home.js"),
        context: {
          limit: postsPerPage,
          skip: i * postsPerPage,
          totalPages: numPages,
          currentPage: currentPage,
          nextUrl,
          prevUrl,
        },
      })
    })
  })
}
