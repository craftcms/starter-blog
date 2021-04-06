import React from "react"

import { graphql } from 'gatsby'
import Layout from "../components/layout"
import Seo from "../components/seo"
import Matrix from "../components/matrix"

import { getPrettyDate, getStandardDate } from "../utils/dates"

export const query = graphql`
  query BlogPostQuery($slug: String!) {
    entry: craftBlogBlogEntry(slug: { eq: $slug }) {
      id
      remoteId
      title
      postDate
      bodyContent {
        ...RichTextFragment
        ...QuoteFragment
        ...ImageFragment
        ...ImageCarouselFragment
        ...EmbedFragment
      }
    }
  }
`

const BlogPostPage = ({ data: { entry } }) => {
  return (
    <Layout>
      <Seo title={entry.title} />
      <h1 className="text-4xl text-black font-display my-4">{entry.title}</h1>

      <time
        className="text-sm block pb-4"
        dateTime={getStandardDate(entry.postDate)}
      >
        {getPrettyDate(entry.postDate)}
      </time>

      <Matrix blocks={entry.bodyContent} />

      {/* {% include "_private/matrix" with {blocks: entry.bodyContent.all()} %} */}
    </Layout>
  )
}

export default BlogPostPage
