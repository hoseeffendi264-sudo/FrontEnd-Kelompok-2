import { getMenu } from '@/lib/db'

export const dynamic = 'force-dynamic'

export async function GET() {
  try {
    return Response.json(await getMenu())
  } catch (e) {
    return Response.json({ error: 'db' }, { status: 500 })
  }
}
