"use client"; 

import React from "react";
import EuropeMap from "../components/EuropeMap";
<<<<<<< HEAD
import { useRouter } from "next/navigation";
import Header from "../components/header"; 
=======
import Header from "../components/header"; // Vérifie la casse !
import Category from "../components/Category";
>>>>>>> a1cd68ae1922c42064bac3f2c98dd5565417f37f

const Home: React.FC = () => {
  const router = useRouter();
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-black">
    
      <Header />

      
      <div className="w-[393px] h-[750px] overflow-hidden">
        <EuropeMap />
        <div className="absolute bottom-5 w-[393px] flex justify-center z-3">
          <Category />
        </div>
      </div>
      <button
        onClick={() => router.push("../connecteMessage")}
        style={{
          width: "393px",
          padding: "12px",
          backgroundColor: "#007BFF",
          color: "white",
          fontSize: "16px",
          fontWeight: "bold",
          cursor: "pointer",
          marginBottom: "20px",
        }}
      >
        Accéder au Chat
      </button>
    </div>
  );
};

export default Home;