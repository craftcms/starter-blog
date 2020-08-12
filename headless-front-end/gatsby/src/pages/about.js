import React from "react"

import { graphql } from 'gatsby'
import Layout from "../components/layout"
import SEO from "../components/seo"
import Matrix from "../components/matrix"

export const query = graphql`
  query AboutPageQuery {
    craft {
      about: entry(slug: "about") {
        title

        ... on Craft_about_about_Entry {
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

const About = ({ data }) => {
  const entry = data.craft.about

  return (
    <Layout>
      <SEO title="About" />

      <h1 className="text-4xl text-black font-display my-4">{entry.title}</h1>

      <Matrix blocks={entry.bodyContent} />
    </Layout>
  )
}

export default About
