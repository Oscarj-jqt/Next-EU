import React, { useState } from "react";
import Message from "./Message";

interface ChatProps {
  country: string;
  channel: string;
}

const Chat: React.FC<ChatProps> = ({ country, channel }) => {
  const [messages, setMessages] = useState<{ user: string; text: string }[]>([]);
  const [input, setInput] = useState("");

  const sendMessage = () => {
    if (input.trim() !== "") {
      setMessages([...messages, { user: "Moi", text: input }]);
      setInput("");
    }
  };

  return (
    <div style={{ padding: "20px", display: "flex", flexDirection: "column", height: "100vh" }}>
      <h2>#{channel} - {country}</h2>
      <div style={{ flex: 1, overflowY: "auto", border: "1px solid #ccc", padding: "10px" }}>
        {messages.map((msg, index) => (
          <Message key={index} user={msg.user} text={msg.text} />
        ))}
      </div>
      <div style={{ display: "flex", marginTop: "10px" }}>
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          placeholder="Écrire un message..."
          style={{ flex: 1, padding: "10px", border: "1px solid #ccc" }}
        />
        <button onClick={sendMessage} style={{ padding: "10px", background: "#007BFF", color: "white", border: "none" }}>
          Envoyer
        </button>
      </div>
    </div>
  );
};

export default Chat;
