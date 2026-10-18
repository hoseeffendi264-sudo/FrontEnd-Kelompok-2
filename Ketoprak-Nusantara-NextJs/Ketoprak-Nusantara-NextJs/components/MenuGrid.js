'use client'
import { useEffect, useState } from 'react'

const rp = n => 'Rp ' + Number(n).toLocaleString('id-ID')

export default function MenuGrid({ foods, drinks }) {
  const [tab, setTab] = useState('f')
  const [sel, setSel] = useState(null)
  const list = tab === 'f' ? foods : drinks

  useEffect(() => {
    const k = e => e.key === 'Escape' && setSel(null)
    window.addEventListener('keydown', k)
    return () => window.removeEventListener('keydown', k)
  }, [])

  return (
    <section id="menu" className="sec cream">
      <div className="wrap">
        <div className="center"><h2 className="head">Menu Kami</h2></div>
        <div className="tabs">
          <button className={tab === 'f' ? 'on' : ''} onClick={() => setTab('f')}>Makanan</button>
          <button className={tab === 'd' ? 'on' : ''} onClick={() => setTab('d')}>Minuman</button>
        </div>
        {list.length === 0 && <p className="muted center">Menu belum tersedia.</p>}
        <div className="grid">
          {list.map(x => (
            <div key={x.id} className="card" onClick={() => setSel(x)}>
              <img src={x.img} alt={x.name} />
              <div className="cb">
                <h3>{x.name}</h3>
                <p className="price">{rp(x.price)}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
      {sel && (
        <div className="back" onClick={() => setSel(null)}>
          <div className="modal" onClick={e => e.stopPropagation()}>
            <button className="x" onClick={() => setSel(null)} aria-label="Tutup">&times;</button>
            <img src={sel.img} alt={sel.name} />
            <div className="cb">
              <h3>{sel.name}</h3>
              <p className="muted">{sel.dsc}</p>
              <p className="price">{rp(sel.price)}</p>
            </div>
          </div>
        </div>
      )}
    </section>
  )
}
