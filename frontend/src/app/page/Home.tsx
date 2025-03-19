import React from "react";
import EuropeMap from "../components/EuropeMap";
import Header from "../components/header"; // Vérifie la casse !

const Home: React.FC = () => {
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-black">
    
      <Header />

      
      <div className="w-[393px] h-[750px] overflow-hidden">
        <EuropeMap />
      </div>
    </div>
  );
};

export default Home;