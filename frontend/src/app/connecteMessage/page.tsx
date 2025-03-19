"use client";

import React, { useState } from "react";
import CountrySelector from "../components/CountrySelector"; // Vérifie le chemin
import ChannelList from "../components/ChannelList";
import Chat from "../components/Chat";

const ConnecteMessage: React.FC = () => {
  const [selectedCountry, setSelectedCountry] = useState<string | null>(null);
  const [selectedChannel, setSelectedChannel] = useState<string | null>(null);

  return (
    <div style={{ display: "flex", flexDirection: "column", height: "100vh" }}>
      {/* Étape 1 : Sélection du pays */}
      {!selectedCountry ? (
        <CountrySelector onSelectCountry={setSelectedCountry} />
      ) : !selectedChannel ? (
        /* Étape 2 : Sélection du channel */
        <ChannelList country={selectedCountry} onSelectChannel={setSelectedChannel} />
      ) : (
        /* Étape 3 : Chat */
        <Chat country={selectedCountry} channel={selectedChannel} />
      )}
    </div>
  );
};

export default ConnecteMessage;
