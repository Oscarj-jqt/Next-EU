"use client"; 

import React from "react";
import EuropeMap from "../components/EuropeMap";
import { useRouter } from "next/navigation";
import Header from "../components/header"; 

const Home: React.FC = () => {
  const router = useRouter();
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-gray-100">
    
      <Header />

      
      <div className="w-[393px] h-[750px] overflow-hidden">
        <EuropeMap />
      </div>
    </div>
  );
};

export default Home;