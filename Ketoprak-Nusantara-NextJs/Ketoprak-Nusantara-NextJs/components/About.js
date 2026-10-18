export default function About({ nf, nd }) {
  return (
    <section id="tentang" className="sec">
      <div className="wrap two">
        <img src="/images/about.jpg" alt="Tentang Ketoprak Nusantara" className="ab" />
        <div>
          <h2 className="head left">Tentang Kami</h2>
          <p className="muted">
            Ketoprak Nusantara menyajikan ketoprak dengan lontong, bihun, tahu, dan tauge yang disiram bumbu kacang
            kental, dipadukan dengan minuman segar pilihan.
          </p>
          <div className="stats">
            <div className="stat"><b>{nf}</b><span>Menu Makanan</span></div>
            <div className="stat"><b>{nd}</b><span>Menu Minuman</span></div>
          </div>
        </div>
      </div>
    </section>
  )
}
