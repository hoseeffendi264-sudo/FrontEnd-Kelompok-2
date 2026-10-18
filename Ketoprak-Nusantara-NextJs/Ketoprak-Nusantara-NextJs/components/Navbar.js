'use client'
import { useState } from 'react'

const links = [['Beranda', '#beranda'], ['Menu', '#menu'], ['Tentang', '#tentang'], ['FAQ', '#faq']]

export default function Navbar() {
  const [open, setOpen] = useState(false)

  return (
    <nav className="nav">
      <div className="wrap nav-in">
        <a href="#beranda" className="brand">Ketoprak Nusantara</a>
        <button className="burger" onClick={() => setOpen(!open)} aria-label="Menu">
          <span /><span /><span />
        </button>
        <ul className={open ? 'links show' : 'links'}>
          {links.map(([t, h]) => (
            <li key={h}><a href={h} onClick={() => setOpen(false)}>{t}</a></li>
          ))}
        </ul>
      </div>
    </nav>
  )
}
