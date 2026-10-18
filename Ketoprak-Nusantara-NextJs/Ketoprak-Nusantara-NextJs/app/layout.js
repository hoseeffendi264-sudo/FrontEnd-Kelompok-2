import './globals.css'

export const metadata = {
  title: 'Ketoprak Nusantara',
  description: 'Ketoprak dan minuman segar khas Nusantara'
}

export default function RootLayout({ children }) {
  return (
    <html lang="id">
      <body>{children}</body>
    </html>
  )
}
