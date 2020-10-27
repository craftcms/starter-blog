import React from "react"

const Embed = ({ block }) => (
  <div
    className="embed clearfix"
    dangerouslySetInnerHTML={{
      __html: block.embed.code,
    }}
  />
)

export default Embed
