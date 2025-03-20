import React from "react";

interface MessageProps {
  user: string;
  text: string;
}

const Message: React.FC<MessageProps> = ({ user, text }) => {
  return (
    <div style={{ marginBottom: "10px" }}>
      <strong>{user} :</strong> {text}
    </div>
  );
};

export default Message;
