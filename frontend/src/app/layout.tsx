import "./globals.css"; // Import du CSS global
import Header from "./components/header";
import Footer from "./components/footer";

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="fr">
      <body className="min-h-screen flex flex-col">
        <Header />
        <main className="flex-grow p-6">{children}</main>
        <Footer />
      </body>
    </html>
  );
}
