import React from "react";
import EuropeMap from "../components/EuropeMap"; // Vérifie que le chemin est correct

const Home: React.FC = () => {
  return (
    <div
      style={{
        width: "393px", // Largeur fixée à 393px
        height: "452px", // Hauteur fixée à 852px
        margin: "0 auto", // Centrer horizontalement
        border: "1px solid #ccc", // Optionnel : bordure pour voir la taille
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
      }}
    >
      <EuropeMap />
    </div>
  );
};

export default Home;
