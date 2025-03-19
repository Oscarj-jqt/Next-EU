"use client";

import React, { useState, useEffect } from "react";
import { MapContainer, GeoJSON } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import L from "leaflet";

// Définir les limites de l'Europe
const europeBounds: L.LatLngBoundsExpression = [
  [71.2, -25.0], // Nord-Ouest (Islande, Norvège)
  [34.5, 45.0], // Sud-Est (Grèce, Turquie)
];

// Fonction pour styliser les pays
const onEachCountry = (feature: any, layer: any) => {
  layer.setStyle({
    fillColor: "#004080",
    color: "#FFFFFF",
    weight: 1,
    opacity: 1,
    fillOpacity: 1,
  });

  if (feature.properties && feature.properties.name) {
    layer.bindTooltip(feature.properties.name, { permanent: false, direction: "center" });
  }

  layer.on("mouseover", function () {
    layer.setStyle({ fillOpacity: 0.8 });
  });

  layer.on("mouseout", function () {
    layer.setStyle({ fillOpacity: 1 });
  });
};

const EuropeMap = () => {
  const [geoData, setGeoData] = useState<any>(null);

  useEffect(() => {
    fetch("/data/europe.json") // Assurez-vous que le fichier est bien accessible ici
      .then((res) => res.json())
      .then((data) => setGeoData(data))
      .catch((err) => console.error("Error loading JSON:", err));
  }, []);

  return (
    <div style={{ width: "100%", height: "100%", backgroundColor: "#b6f3ff" }}>
      <MapContainer
        center={[50, 10]}
        zoom={4}
        scrollWheelZoom={true}
        style={{ width: "100%", height: "100%" }}
        maxBounds={europeBounds}
        maxBoundsViscosity={1.0}
      >
        {geoData && <GeoJSON data={geoData} onEachFeature={onEachCountry} />}
      </MapContainer>
    </div>
  );
};

export default EuropeMap;
