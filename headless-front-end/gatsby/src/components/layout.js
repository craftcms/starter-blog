/**
 * Layout component that queries for data
 * with Gatsby's useStaticQuery component
 *
 * See: https://www.gatsbyjs.org/docs/use-static-query/
 */

import React from "react"
import { useStaticQuery, graphql } from "gatsby"
import { Helmet } from "react-helmet"
import Nav from "../components/nav"

const Layout = ({ children }) => {
  const data = useStaticQuery(graphql`
    query SiteTitleQuery {
      site {
        siteMetadata {
          title
        }
      }
    }
  `)

  const currentYear = new Date().getFullYear()

  return (
    <>
      <Helmet>
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta charset="utf-8" />
        <title>{data.site.siteMetadata.title}</title>
        <meta
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover"
          name="viewport"
        />
        <meta content="origin-when-cross-origin" name="referrer" />

        <link
          rel="apple-touch-icon"
          sizes="180x180"
          href="/apple-touch-icon.png"
        />
        <link
          rel="icon"
          type="image/png"
          sizes="32x32"
          href="/favicon-32x32.png"
        />
        <link
          rel="icon"
          type="image/png"
          sizes="16x16"
          href="/favicon-16x16.png"
        />
        <link rel="manifest" href="/site.webmanifest" />
        <link
          href="//fonts.googleapis.com/css?family=Work+Sans:600|Quattrocento+Sans:400,400i,700"
          rel="stylesheet"
          type="text/css"
        />
      </Helmet>

      <Nav />

      <div className="container mx-auto px-4">
        {/* Layout templates define blocks that other templates may override. If a
        child template (one that extends this template) does not implement the
        `content` block, then you'll see the default message. */}
        {children}
      </div>

      <footer className="page-footer">
        &copy; {currentYear}, Built with{" "}
        <a className="text-blue-600" href="https://craftcms.com">
          Craft CMS
        </a>
      </footer>
    </>
  )
}

export default Layout
