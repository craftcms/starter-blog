import React from "react"
import { Link } from "gatsby"

const nav = [{ title: "Home", path: "/" }, { title: "About", path: "/about" }]

const NavItem = ({ item }) => {
  return (
    <li className="mr-6">
      <Link
        to={item.path}
        className={`text-blue-600`}
        activeClassName={`border-b border-blue-400`}
      >
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
