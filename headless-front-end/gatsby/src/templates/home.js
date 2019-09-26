import React from "react"
import { graphql, Link } from "gatsby"
import Layout from "../components/layout"
import { getPrettyDate, getStandardDate } from "../utils/dates"

export const query = graphql`
  query WhateverQuery($limit: Int, $skip: Int) {
    craft {
      blogPosts: entries(section: "blog", limit: $limit, offset: $skip) {
        title
        slug
        postDate

        ... on Craft_blog_blog_Entry {
          summary
        }
      }

      home: entries(section: "home") {
        ... on Craft_home_home_Entry {
          siteIntroduction
        }
      }
    }

    site {
      siteMetadata {
        title
      }
    }
  }
`

const IndexPage = ({ data, pageContext }) => {
  const { craft } = data
  const posts = data.craft.blogPosts

  return (
    <Layout>
      <h1 className="text-4xl text-black font-display my-4">
        <Link to="/">{data.site.siteMetadata.title}</Link>
      </h1>

      {pageContext.currentPage === 1 && (
        <div
          dangerouslySetInnerHTML={{
            __html: craft.home[0].siteIntroduction,
          }}
        ></div>
      )}

      {posts.map((blogEntry, i) => (
        <article className="mt-8" key={i}>
          <h2 className="text-2xl font-display">
            <Link className="text-blue-600" to={`/blog/${blogEntry.slug}`}>
              {blogEntry.title}
            </Link>
          </h2>
          <time
            className="text-sm block pb-4"
            dateTime={getStandardDate(blogEntry.postDate)}
          >
            {getPrettyDate(blogEntry.postDate)}
          </time>

          <div
            className="text-gray-800"
            dangerouslySetInnerHTML={{ __html: blogEntry.summary }}
          />

          <p className="pt-2">
            <Link className="text-blue-600" to={`/blog/${blogEntry.slug}`}>
              Read more &hellip;
            </Link>
          </p>
        </article>
      ))}

      <div className="pt-8">
        <nav className="" role="navigation" aria-label="Pagination Navigation">
          <ul className="flex justify-center">
            {pageContext.prevUrl && (
              <li className="mx-2">
                <Link to={pageContext.prevUrl} className="text-blue-600">
                  &larr; Prev
                </Link>
              </li>
            )}
            <li className="mx-2">
              {pageContext.currentPage} of {pageContext.totalPages}
            </li>
            {pageContext.nextUrl && (
              <li className="mx-2">
                <Link to={pageContext.nextUrl} className="text-blue-600">
                  Next &rarr;
                </Link>
              </li>
            )}
          </ul>
        </nav>
      </div>
    </Layout>
  )
}

export default IndexPage
