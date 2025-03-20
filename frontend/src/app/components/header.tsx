"use client";

import { MagnifyingGlassIcon, UserIcon } from "@heroicons/react/24/outline";
import Link from "next/link";

const Header = () => {
  return (
    <nav className="w-[393px] bg-[#b6f3ff] p-4 flex justify-between items-center">
     
      <h1 className="text-lg text-white font-bold">EU-TALENT</h1> 

      <div className="flex items-center px-2 py-1">
        <MagnifyingGlassIcon className="h-5 w-5 text-gray-600" />
        <input
          className="ml-2 outline-none bg-transparent text-sm text-gray-700 placeholder-gray-500"
          type="text"
          placeholder="Countries..."
        />
      </div>
      <Link href="/login">
        <UserIcon className="h-6 w-6 text-gray-600" />
      </Link>
    </nav>
  );
};

export default Header;                                                                                                                                      