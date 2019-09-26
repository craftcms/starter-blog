import React from "react"
import Carousel from "nuka-carousel"

const ImageCarousel = ({ block }) => {
  const heights = {
    "16:9": "56.25%",
    "4:3": "75%",
    "3:2": "66.666%",
  }
  const height = heights[block.aspectRatio]

  return (
    <Carousel>
      {block.images.map((image, i) => (
        <figure
          key={i}
          className="relative item"
          style={{
            paddingTop: height,
          }}
        >
          <img
            src={image.url}
            alt={image.imageAlt}
            className="absolute inset-0 w-full h-full object-cover"
          />

          {image.caption && (
            <figcaption className="carousel-caption">
              {image.caption}
            </figcaption>
          )}
        </figure>
      ))}
    </Carousel>
  )
}

export default ImageCarousel
