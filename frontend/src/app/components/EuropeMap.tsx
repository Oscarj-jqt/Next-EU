"use client";

import React from "react";
import { useRouter } from "next/navigation";
import { MapContainer, GeoJSON } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import europeGeoJson from "../data/europe.json";

// Définir les limites de l'Europe
const europeBounds = [
  [71.2, -25.0], // Nord-Ouest (Islande, Norvège)
  [34.5, 45.0], // Sud-Est (Grèce, Turquie)
];

const EuropeMap: React.FC = () => {
  const router = useRouter(); // Utiliser le router Next.js pour la navigation

  // Fonction qui stylise les pays et gère les clics
  const onEachCountry = (feature: any, layer: any) => {
    layer.setStyle({
      fillColor: "#004080",
      color: "#FFFFFF",
      weight: 1,
      opacity: 1,
      fillOpacity: 1,
    });

    // Ajouter un tooltip avec le nom du pays
    if (feature.properties && feature.properties.name) {
      layer.bindTooltip(feature.properties.name, {
        permanent: false,
        direction: "center",
      });
    }

    // Effet au survol
    layer.on("mouseover", function () {
      layer.setStyle({ fillOpacity: 0.8 });
    });

    layer.on("mouseout", function () {
      layer.setStyle({ fillOpacity: 1 });
    });

    // **Rediriger vers /scroll quand un pays est cliqué**
    layer.on("click", function () {
      router.push("/scroll"); // Navigue vers la page `/scroll`
    });
  };

  return (
    <div style={{ width: "100%", height: "100%", backgroundColor: "#b6f3ff" }}>
      <MapContainer
        center={[50, 10]}
        zoom={4}
        minZoom={3}
        maxZoom={10}
        scrollWheelZoom={true}
        style={{
          width: "100%",
          height: "100%",
          backgroundColor: "#b6f3ff",
        }}
        maxBounds={europeBounds}
        maxBoundsViscosity={1.0}
        attributionControl={false}
      >
        <GeoJSON data={europeGeoJson} onEachFeature={onEachCountry} />
      </MapContainer>
    </div>
  );
};

export default EuropeMap;
