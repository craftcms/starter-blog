import React from "react"

const RichText = ({ block }) => (
  <div
    className="rich-text clearfix"
    dangerouslySetInnerHTML={{
      __html: block.richText,
    }}
  />
)

export default RichText
