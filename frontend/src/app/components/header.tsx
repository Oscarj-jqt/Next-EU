"use client";

import Image from "next/image";
import { MagnifyingGlassIcon, UserIcon } from "@heroicons/react/24/outline";

const Header = () => {
  return (
    <nav className="w-[393px] bg-[#b6f3ff] p-4 flex justify-between items-center">
      {/* Logo */}
      <Image
        src="/logo-transparent-png-min.png" // Le fichier doit être dans /public
        alt="Logo Nexteu"
        width={50} // Ajuste la taille selon tes besoins
        height={50}
      />

      {/* Barre de recherche */}
      <div className="flex items-center px-2 py-1">
        <MagnifyingGlassIcon className="h-5 w-5 text-gray-600" />
        <input
          className="ml-2 outline-none bg-transparent text-sm text-gray-700 placeholder-gray-500"
          type="text"
          placeholder="Users..."
        />
      </div>

      {/* Icône utilisateur */}
      <UserIcon className="h-6 w-6 text-gray-600" />
    </nav>
  );
};

export default Header;
