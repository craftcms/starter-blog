const shortMonthNames = [
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec",
]

function getPrettyDate(dateString) {
  const date = new Date(dateString)

  const year = date.getFullYear()
  const monthIndex = date.getMonth()
  const month = shortMonthNames[monthIndex]
  const day = date.getDate()

  return `${day} ${month} ${year}`
}

function getStandardDate(dateString) {
  const date = new Date(dateString)
  const formatted = date.toISOString().slice(0, 10)

  return formatted
}

export { getPrettyDate, getStandardDate }
