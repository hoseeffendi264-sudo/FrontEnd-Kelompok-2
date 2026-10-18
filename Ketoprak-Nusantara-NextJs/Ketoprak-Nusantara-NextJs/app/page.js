import { getMenu } from '@/lib/db'
import Navbar from '@/components/Navbar'
import Carousel from '@/components/Carousel'
import MenuGrid from '@/components/MenuGrid'
import About from '@/components/About'
import Faq from '@/components/Faq'
import Footer from '@/components/Footer'

export const dynamic = 'force-dynamic'

export default async function Home() {
  let m = { foods: [], drinks: [] }
  try {
    m = await getMenu()
  } catch (e) {}

  return (
    <>
      <Navbar />
      <Carousel />
      <MenuGrid foods={m.foods} drinks={m.drinks} />
      <About nf={m.foods.length} nd={m.drinks.length} />
      <Faq />
      <Footer />
    </>
  )
}
