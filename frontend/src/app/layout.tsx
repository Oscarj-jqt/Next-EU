import React from "react";
import { Outlet, Link } from "react-router-dom";

const Layout: React.FC = () => {
  return (
    <div className="min-h-screen flex flex-col">
      <header className="bg-blue-500 text-white p-4">
        <nav>
          <Link to="/" className="mr-4">Accueil</Link>
          <Link to="/login">Login</Link>
        </nav>
      </header>

      <main className="flex-grow p-6">
        <Outlet />  {/* C'est ici que les pages s'affichent */}
      </main>

      <footer className="bg-gray-800 text-white text-center p-4">
        © 2024 - Mon Application
      </footer>
    </div>
  );
};

export default Layout;
