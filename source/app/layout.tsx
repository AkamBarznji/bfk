import type { Metadata } from "next";
import "./globals.css";
import Header from '@/components/bfk/header';
import Footer from '@/components/bfk/footer';

export const metadata: Metadata = {
  metadataBase: new URL('https://new.kurdsforlabour.org.uk'),
  title: { default: 'British Friends of Kurdistan | Dialogue, exchange and engagement', template: '%s | British Friends of Kurdistan' },
  description: 'An independent London-based organisation advancing dialogue, cultural exchange and commercial engagement between the United Kingdom and Kurdistan.',
  robots: { index: true, follow: true },
  openGraph: { title: 'British Friends of Kurdistan', description: 'An independent platform for dialogue, cultural exchange and commercial engagement between the United Kingdom and Kurdistan.', type: 'website', locale: 'en_GB', siteName: 'British Friends of Kurdistan' },
  twitter: { card: 'summary_large_image', title: 'British Friends of Kurdistan', description: 'Dialogue, cultural exchange and commercial engagement between the United Kingdom and Kurdistan.' },
  icons: {
    icon: "/favicon.svg",
    shortcut: "/favicon.svg",
  },
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en-GB" dir="ltr">
      <head><link rel="preload" href="/fonts/inter-latin.woff2" as="font" type="font/woff2" crossOrigin="anonymous" /><link rel="preload" href="/fonts/spectral-regular.woff2" as="font" type="font/woff2" crossOrigin="anonymous" /></head>
      <body><a className="skip-link" href="#main-content">Skip to content</a><Header />{children}<Footer /><script type="application/ld+json" dangerouslySetInnerHTML={{__html:JSON.stringify({'@context':'https://schema.org','@type':'Organization',name:'British Friends of Kurdistan',alternateName:'BFK',description:'An independent London-based organisation advancing dialogue, cultural exchange and commercial engagement between the United Kingdom and Kurdistan.',address:{'@type':'PostalAddress',addressLocality:'London',addressCountry:'GB'}})}} /></body>
    </html>
  );
}
