"use client";

import React from "react";
import { useRouter } from "next/navigation";
import { MapContainer, GeoJSON } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import europeGeoJson from "../data/europe.json";

const europeBounds = [
  [71.2, -25.0], // Nord-Ouest
  [34.5, 45.0], // Sud-Est
];

const EuropeMap: React.FC = () => {
  const router = useRouter();

  const onEachCountry = (feature: any, layer: any) => {
    layer.setStyle({
      fillColor: "#004080",
      color: "#FFFFFF",
      weight: 1,
      opacity: 1,
      fillOpacity: 1,
    });

    if (feature.properties && feature.properties.NAME) {
      layer.bindTooltip(feature.properties.NAME, {
        permanent: false,
        direction: "center",
      });
    }

    layer.on("mouseover", function () {
      layer.setStyle({ fillOpacity: 0.8 });
    });

    layer.on("mouseout", function () {
      layer.setStyle({ fillOpacity: 1 });
    });

    layer.on("click", function () {
      const countryName = feature.properties?.NAME; // Correction ici (majuscule)

      console.log("🌍 Pays cliqué :", countryName); // Vérifier si le pays est bien détecté

      if (!countryName) {
        console.error("⚠️ Erreur : Nom du pays introuvable !");
        return;
      }

      router.push(`/scroll?country=${encodeURIComponent(countryName)}`);
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
