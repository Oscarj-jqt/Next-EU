"use client"; 

import React from "react";
import EuropeMap from "../components/EuropeMap";
import { useRouter } from "next/navigation";
import Header from "../components/header"; 

const Home: React.FC = () => {
  const router = useRouter();
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-black">
    
      <Header />

      
      <div className="w-[393px] h-[750px] overflow-hidden">
        <EuropeMap />
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