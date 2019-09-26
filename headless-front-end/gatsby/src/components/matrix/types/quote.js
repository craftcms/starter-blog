import React from "react"

const Quote = ({ block }) => {
  const quoteClass =
    block.style === "blockquote"
      ? "text-lg border-l border-gray-700 pl-4 py-2 text-gray-700 flex flex-col"
      : "m-8 italic text-2xl text-center font-serif text-gray-800"

  return (
    <blockquote className={`text-bold rich-text ${quoteClass}`}>
      <div
        dangerouslySetInnerHTML={{
          __html: block.quote,
        }}
      ></div>

      {block.attribution && (
        <footer
          className={`text-gray-600 font-sans text-base ${
            block.style === "pullquote"
              ? "text-gray-600 font-sans text-base"
              : ""
          }`}
        >
          &mdash; {block.attribution}
        </footer>
      )}
    </blockquote>
  )
}

export default Quote
