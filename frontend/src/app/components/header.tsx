import Link from "next/link";

export default function Header() {
  return (
    <header className="bg-blue-500 text-white p-4">
      <nav>
        <Link href="/home" className="mr-4">Accueil</Link>
        <Link href="/login" className="mr-4">Login</Link>
        <Link href="/register">S'inscrire</Link>
      </nav>
    </header>
  );
}
