"use client";

import React, { useState, useEffect } from "react";
import Link from "next/link";

const NotificationPopup: React.FC = () => {
  const [isVisible, setIsVisible] = useState<boolean>(false);

  useEffect(() => {
    // Lancer un timer pour afficher la notification après 10 secondes
    const showTimer = setTimeout(() => {
      setIsVisible(true); // Affiche la notification
    }, 3000); // Affiche après 3 secondes

    // Nettoyer le timer à la désactivation du composant
    return () => {
      clearTimeout(showTimer);
    };
  }, []);

  return (
    <div
      className={`fixed inset-0 flex items-center justify-center transition-all duration-300 ${
        isVisible ? "opacity-100 pointer-events-auto backdrop-blur-md" : "opacity-0 pointer-events-none hidden"
      }`}
      style={{ zIndex: 50 }} // S'assurer qu'il est en premier plan
    >
      <div className="relative w-[300px] p-4 bg-white text-black rounded-lg shadow-lg">
        {/* Bouton de fermeture */}
        <button
          onClick={() => {
            setIsVisible(false);
            console.log("Notification fermée :", isVisible); // Affichera l'ancienne valeur (false après le rendu)
          }}
          className="absolute top-2 right-2 text-xl text-gray-500 hover:text-black cursor-pointer"
        >
          ❌
        </button>

        <h4 className="font-bold">Notification</h4>
        <p>It's time to do the challenge!</p>

        {/* Bouton pour naviguer et fermer */}
        <Link href="/publish">
          <button
            onClick={() => setIsVisible(false)}
            className="mt-2 text-sm text-black"
          >
            Take a video
          </button>
        </Link>
      </div>
    </div>
  );
};

export default NotificationPopup;
