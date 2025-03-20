"use client";

import React, { useState, useEffect } from "react";

const NotificationPopup: React.FC = () => {
  const [isVisible, setIsVisible] = useState<boolean>(false);

  useEffect(() => {
    // Lancer un timer pour afficher la notification après 10 secondes
    const showTimer = setTimeout(() => {
      setIsVisible(true); // Affiche la notification
    }, 3000); // Affiche après 10 secondes

      // Nettoyer les timers à la désactivation du composant
      return () => {
        clearTimeout(showTimer);
      };
    }, []);


  return (  
    <div
      className={` fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[300px] p-4 bg-white text-black rounded-lg shadow-lg transition-all duration-300 z-50 ${isVisible ? "opacity-100" : "opacity-0 pointer-events-non"}`}
    >
      <h4 className="font-bold">Notification</h4>
      <p>Its time to do the challenge !</p>
      <button
        onClick={() => setIsVisible(false)}
        className="mt-2 text-sm text-black"
      >
        Take a video
      </button>
    </div>
  );
};

export default NotificationPopup;
