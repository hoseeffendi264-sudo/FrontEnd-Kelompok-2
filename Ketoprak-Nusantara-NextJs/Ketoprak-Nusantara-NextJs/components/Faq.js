'use client'
import { useState } from 'react'

const q = [
  ['Apakah ketoprak bisa dibuat tidak pedas?', 'Bisa, sampaikan saja saat memesan dan sambal akan dipisah.'],
  ['Apa bedanya Ketoprak Original dan Komplit?', 'Komplit memiliki porsi lebih besar dengan tambahan tahu goreng, tauge, dan bawang goreng.'],
  ['Apakah tersedia pilihan minuman?', 'Tersedia air mineral, teh manis, lemonade, YUM-Soda, dan Kopi Nusantara.'],
  ['Bagaimana cara memesan?', 'Pilih menu favorit kamu, lalu sampaikan pesanan langsung di toko kami.']
]

export default function Faq() {
  const [o, setO] = useState(0)

  return (
    <section id="faq" className="sec cream">
      <div className="wrap narrow">
        <div className="center"><h2 className="head">Pertanyaan Umum</h2></div>
        {q.map(([a, b], n) => (
          <div key={n} className={o === n ? 'acc open' : 'acc'}>
            <button onClick={() => setO(o === n ? -1 : n)}>
              {a}<i>{o === n ? '−' : '+'}</i>
            </button>
            {o === n && <div className="ab-body">{b}</div>}
          </div>
        ))}
      </div>
    </section>
  )
}
