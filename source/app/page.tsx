import type { Metadata } from 'next';
import Link from 'next/link';
import { FocusAreas, ContactInvitation, EventList } from '@/components/bfk/content';
import { copy } from '@/content/en';
export const metadata: Metadata = { alternates: { canonical: '/' } };
export default function Home() {
  return <main id="main-content">
    <section className="hero" aria-labelledby="hero-title">
      <img className="hero-photograph" src="/images/westminster.webp" width="2000" height="902" alt="" aria-hidden="true" fetchPriority="high" />
      <div className="container hero-inner"><div className="hero-copy"><span className="brass-rule" aria-hidden="true" /><h1 id="hero-title">{copy.hero.title}</h1><p>{copy.hero.subtitle}</p><div className="actions"><Link className="button" href="/contact">Get in touch</Link><Link className="text-link light" href="/about">About BFK</Link></div></div><div className="hero-caption"><span>Based in London. Connected to Kurdistan.</span><span>Dialogue · Exchange · Friendship</span></div></div>
    </section>
    <section className="section introduction container" aria-labelledby="intro-title"><div><span className="brass-rule" aria-hidden="true" /><h2 id="intro-title">A lasting friendship.<br />A shared future.</h2><Link className="text-link" href="/about">Discover BFK</Link></div><div><p className="intro-text">{copy.introduction}</p><p className="independent-note">Independent and non-partisan. Working across all parties.</p></div></section>
    <section className="section focus-section" aria-labelledby="work-title"><div className="container"><div className="section-heading"><h2 id="work-title">Three areas. One relationship.</h2><Link href="/our-work" className="text-link">Explore our work</Link></div><FocusAreas /></div></section>
    <section className="vision" aria-labelledby="vision-title"><div className="container vision-inner"><span className="brass-rule" aria-hidden="true" /><h2 id="vision-title">Strengthening the bond between the people of Kurdistan and the British people.</h2><p>Our work rests on a relationship built over generations — founded on shared interests, mutual respect, and lasting friendship. We are here to give that relationship a true home and forward momentum.</p></div></section>
    <section className="section container" aria-labelledby="events-title"><div className="section-heading"><h2 id="events-title">Meetings &amp; events</h2><Link className="text-link" href="/events">Events at BFK</Link></div><EventList home /></section>
    <ContactInvitation />
  </main>;
}
