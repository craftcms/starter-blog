import React from "react"
import { Link } from "gatsby"

const nav = [{ title: "Home", path: "/" }, { title: "About", path: "/about" }]

const NavItem = ({ item }) => {
  // const firstSegment = window.location.pathname.split("/")[1]
  // const isActive = `/${firstSegment}` === item.path
  // const activeClasses = isActive ? "border-b border-blue-400" : ""
  const activeClasses = ""

  return (
    <li className="mr-6">
      <Link className={`text-blue-600 ${activeClasses}`} to={item.path}>
        {item.title}
      </Link>
    </li>
  )
}

const Nav = () => {
  return (
    <nav
      className="container mx-auto py-4 px-4"
      role="navigation"
      aria-label="Main"
    >
      <ul className="flex">
        {nav.map((navItem, i) => (
          <NavItem item={navItem} key={i} />
        ))}
      </ul>
    </nav>
  )
}

export default Nav
