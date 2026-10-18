'use client'
import { useEffect, useState } from 'react'

const sl = [
  { img: '/images/carousel1.jpg', t: 'Ketoprak Nusantara', s: 'Cita rasa bumbu kacang yang gurih dan legendaris' },
  { img: '/images/carousel2.jpg', t: 'Dibuat Segar Setiap Hari', s: 'Bahan pilihan, diracik dengan resep asli kami' },
  { img: '/images/carousel3.jpg', t: 'Pasangan Minuman Terbaik', s: 'Dari teh manis sampai kopi Nusantara' }
]

export default function Carousel() {
  const [i, setI] = useState(0)

  useEffect(() => {
    const t = setInterval(() => setI(x => (x + 1) % sl.length), 5000)
    return () => clearInterval(t)
  }, [])

  return (
    <header id="beranda" className="car">
      {sl.map((s, n) => (
        <div key={n} className={n === i ? 'slide on' : 'slide'}>
          <img src={s.img} alt={s.t} />
          <div className="ov">
            <h1>{s.t}</h1>
            <p>{s.s}</p>
            <a href="#menu" className="btn">Lihat Menu</a>
          </div>
        </div>
      ))}
      <div className="dots">
        {sl.map((_, n) => (
          <button key={n} className={n === i ? 'on' : ''} onClick={() => setI(n)} aria-label={'Slide ' + (n + 1)} />
        ))}
      </div>
    </header>
  )
}
