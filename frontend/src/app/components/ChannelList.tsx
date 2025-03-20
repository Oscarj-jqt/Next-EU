import React from "react";
import channels from "../data/channels.json"; // Liste des channels

interface ChannelListProps {
  country: string;
  onSelectChannel: (channel: string) => void;
}

const ChannelList: React.FC<ChannelListProps> = ({
  country,
  onSelectChannel,
}) => {
  return (
    <div style={{ padding: "20px" }}>
      <h2>Channels pour {country}</h2>
      {channels.map((channel) => (
        <button
          key={channel}
          onClick={() => onSelectChannel(channel)}
          style={{
            display: "block",
            padding: "10px",
            margin: "10px 0",
            background: "#007BFF",
            color: "white",
            border: "none",
            cursor: "pointer",
            borderRadius: "5px",
          }}
        >
          #{channel}
        </button>
      ))}
    </div>
  );
};

export default ChannelList;
