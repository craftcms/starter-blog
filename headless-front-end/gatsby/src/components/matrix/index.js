import React from "react"

import RichText from "./types/richText"
import { graphql } from 'gatsby'
import Image from "./types/image"
import ImageCarousel from "./types/imageCarousel"
import Quote from "./types/quote"
//import Embed from "./types/embed"

const components = {
  richText: RichText,
  image: Image,
  imageCarousel: ImageCarousel,
  quote: Quote,
  //embed: Embed
}

const Block = props => {
  const { block } = props
  const type = block.typeHandle
  const Component = components[type]

  if (Object.keys(components).includes(type)) {
    return <Component {...props} />
  } else {
    return null
  }
}

const Blocks = ({ blocks }) => {
  return (
    <div>
      {blocks.map((block, i) => (
        <Block key={i} block={block} />
      ))}
    </div>
  )
}

export default Blocks

export const query = graphql`
  fragment RichTextFragment on Craft_bodyContent_richText_BlockType {
    richText
    typeHandle
  }

  fragment QuoteFragment on Craft_bodyContent_quote_BlockType {
    style
    quote
    attribution
    typeHandle
  }

  fragment ImageFragment on Craft_bodyContent_image_BlockType {
    image {
      url
      ... on Craft_uploads_Asset {
        imageAlt
        caption
      }
    }
    position
    typeHandle
  }

  fragment ImageCarouselFragment on Craft_bodyContent_imageCarousel_BlockType {
    images {
      url
      ... on Craft_uploads_Asset {
        imageAlt
      }
    }
    aspectRatio
    typeHandle
  }
`
