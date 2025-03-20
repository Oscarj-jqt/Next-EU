"use client";

import React from "react";
import EuropeMap from "../components/EuropeMap";
import Header from "../components/header";
import NotificationPopup from "../components/NotificationsPopup"; // Assure-toi que l'importation est correcte

const Home: React.FC = () => {
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-black z-0">
      <Header />

      <div className="w-[393px] h-[750px] overflow-hidden relative z-10">
        <EuropeMap />
      </div>

      {/* <button
        onClick={() => router.push("../connecteMessage")}
        className="w-[393px] p-3 bg-blue-600 text-white text-lg font-bold cursor-pointer mb-5"
      >
        Accéder au Chat
      </button> */}

      {/* Affiche la notification automatiquement */}
      <NotificationPopup />
    </div>
  );
};

export default Home;
