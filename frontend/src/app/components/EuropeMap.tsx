"use client";

import React from "react";
import { MapContainer, TileLayer, GeoJSON } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import L from "leaflet";
import europeGeoJson from "../data/europe.json"; 

// Définir les limites de l'Europe
const europeBounds: L.LatLngBoundsExpression = [
  [71.2, -25.0], // Nord-Ouest (Islande, Norvège)
  [34.5, 45.0], // Sud-Est (Grèce, Turquie)
];

// Fonction pour styliser les pays
const onEachCountry = (country: any, layer: any) => {
  layer.setStyle({
    fillColor: "#007BFF", // Bleu pour les pays
    color: "#FFFFFF", // Bordure blanche
    weight: 1,
    opacity: 1,
    fillOpacity: 0.5,
  });

  // Ajouter un effet au survol
  layer.on("mouseover", function () {
    layer.setStyle({
      fillOpacity: 0.8, // Augmente l’opacité au survol
    });
  });

  layer.on("mouseout", function () {
    layer.setStyle({
      fillOpacity: 0.5, // Retour à la normale
    });
  });
};

const EuropeMap: React.FC = () => {
  return (
    <MapContainer
      center={[50, 10]} // Coordonnées centrées sur l'Europe
      zoom={4}
      scrollWheelZoom={true}
      style={{ width: "100%", height: "100%", borderRadius: "15px" }}
      maxBounds={europeBounds} // Limite la zone visible
      maxBoundsViscosity={1.0} // Empêche de sortir des limites
    >
      {/* Fond de carte stylisé */}
      <TileLayer
        url="https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png"
        attribution="© OpenStreetMap, © CARTO"
      />

      {/* Couleurs des pays via GeoJSON */}
      <GeoJSON data={europeGeoJson} onEachFeature={onEachCountry} />
    </MapContainer>
  );
};

export default EuropeMap;
