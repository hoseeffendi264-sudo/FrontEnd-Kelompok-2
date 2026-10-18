import mysql from 'mysql2/promise'

const g = globalThis
const pool = g.pool || (g.pool = mysql.createPool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB_NAME,
  connectionLimit: 5
}))

const fix = r => ({ ...r, img: '/' + r.img.replace(/\\/g, '/') })

export async function getMenu() {
  const [f] = await pool.query('SELECT foodID id, foodName name, foodIMG img, foodDesc dsc, price FROM foodlist')
  const [d] = await pool.query('SELECT drinkID id, drinkName name, drinkIMG img, drinkDesc dsc, price FROM drinklist')
  return { foods: f.map(fix), drinks: d.map(fix) }
}
