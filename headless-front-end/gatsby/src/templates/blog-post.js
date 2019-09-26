import React from "react"

import Layout from "../components/layout"
import SEO from "../components/seo"
import Matrix from "../components/matrix"

import { getPrettyDate, getStandardDate } from "../utils/dates"

export const query = graphql`
  query BlogPostQuery($id: [Int]) {
    craft {
      entries(id: $id) {
        title
        postDate

        ... on Craft_blog_blog_Entry {
          id
          bodyContent {
            ...RichTextFragment
            ...QuoteFragment
            ...ImageFragment
            ...ImageCarouselFragment
            ...EmbedFragment
          }
        }
      }
    }
  }
`

const BlogPostPage = ({ data }) => {
  const entry = data.craft.entries[0]
  return (
    <Layout>
      <SEO title={entry.title} />
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
