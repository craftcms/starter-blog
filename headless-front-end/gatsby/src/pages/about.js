import React from "react"

import { graphql } from 'gatsby'
import Layout from "../components/layout"
import Seo from "../components/seo"
import Matrix from "../components/matrix"

export const query = graphql`
  query AboutPageQuery {
    about: craftAboutEntry {
      title
      bodyContent {
        ...RichTextFragment
        ...QuoteFragment
        ...ImageFragment
        ...ImageCarouselFragment
      }
    }
  }
`

const About = ({ data }) => {
  const entry = data.about

  return (
    <Layout>
      <Seo title="About" />

      <h1 className="text-4xl text-black font-display my-4">{entry.title}</h1>

      <Matrix blocks={entry.bodyContent} />
    </Layout>
  )
}

export default About
