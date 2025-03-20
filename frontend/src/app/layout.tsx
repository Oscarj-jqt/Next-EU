import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import NotificationPopup from "./components/NotificationsPopup"; // Import du composant de notification

export const dynamic = "force-dynamic";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Carte Interactive Europe",
  description: "Application Next.js avec une carte interactive",
};

export default function Layout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="fr">
      <body
        className={`${geistSans.variable} ${geistMono.variable} antialiased`}
      >
        {/* Affichage de la notification */}
        <NotificationPopup />

        {/* Le contenu principal */}
        <main style={{ display: "flex", justifyContent: "center" }}>
          {children}
        </main>
      </body>
    </html>
  );
}
