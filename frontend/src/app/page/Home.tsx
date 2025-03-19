import React from "react";
import EuropeMap from "../components/EuropeMap";
import Header from "../components/header"; // Vérifie la casse !

const Home: React.FC = () => {
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-gray-100">
    
      <Header />

      
      <div className="w-[393px] h-[750px] mt-4 border border-gray-300 rounded-lg overflow-hidden">
        <EuropeMap />
      </div>
    </div>
  );
};

export default Home;