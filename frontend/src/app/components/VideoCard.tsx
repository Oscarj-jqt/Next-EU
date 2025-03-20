"use client";

import React, { useRef, useEffect, useState } from "react";

interface VideoCardProps {
  video: { url: string; description: string };
  isActive: boolean;
  isLiked: boolean;
  likesCount: number;
  onLike: () => void;
}

const VideoCard: React.FC<VideoCardProps> = ({ video, isActive, isLiked, likesCount, onLike }) => {
  const videoRef = useRef<HTMLVideoElement>(null);
  const [showShareOptions, setShowShareOptions] = useState(false); // État pour afficher/masquer le menu de partage

  useEffect(() => {
    if (videoRef.current) {
      if (isActive) {
        videoRef.current.play().catch((error) => console.log("Playback failed", error));
      } else {
        videoRef.current.pause();
        videoRef.current.currentTime = 0;
      }
    }
  }, [isActive]);

  // 📌 Copier le lien dans le presse-papiers
  const copyToClipboard = () => {
    navigator.clipboard.writeText(video.url);
    alert("Lien copié !");
  };

  // 📌 Générer les liens de partage
  const shareLinks = {
    whatsapp: `https://api.whatsapp.com/send?text=Regarde cette vidéo ! ${video.url}`,
    twitter: `https://twitter.com/intent/tweet?url=${video.url}&text=Regarde cette vidéo !`,
    snapchat: `https://www.snapchat.com/scan?attachmentUrl=${video.url}`,
  };

  return (
    <div className="relative flex items-center justify-center h-screen w-[393px] snap-start bg-black">
      <video ref={videoRef} src={video.url}
        className="w-full h-full object-cover rounded-lg"
        loop
        muted
        playsInline
        autoPlay={isActive} // Lecture automatique seulement si active
      />

      {/* Conteneur des boutons Like et Partage */}
      <div
        style={{
          position: "absolute",
          right: "20px",
          bottom: "100px",
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
        }}
      >
        {/* Bouton Like ❤️ */}
        <button
          onClick={onLike}
          style={{
            backgroundColor: "rgba(255, 255, 255, 0.3)",
            color: isLiked ? "red" : "white",
            border: "none",
            borderRadius: "50%",
            width: "50px",
            height: "50px",
            fontSize: "20px",
            cursor: "pointer",
            marginBottom: "10px",
          }}
        >
          {isLiked ? "❤️" : "🤍"}
        </button>

        {/* Compteur de Likes 📊 */}
        <span
          style={{
            color: "white",
            fontSize: "16px",
            fontWeight: "bold",
            marginBottom: "10px",
          }}
        >
          {likesCount}
        </span>

        {/* Bouton Partage 📤 */}
        <button
          onClick={() => setShowShareOptions(!showShareOptions)}
          style={{
            backgroundColor: "rgba(255, 255, 255, 0.3)",
            color: "white",
            border: "none",
            borderRadius: "50%",
            width: "50px",
            height: "50px",
            fontSize: "18px",
            cursor: "pointer",
          }}
        >
          📤
        </button>

        {/* Menu de Partage 📤 */}
        {showShareOptions && (
          <div
            style={{
              position: "absolute",
              right: "60px",
              bottom: "0",
              backgroundColor: "rgba(0, 0, 0, 0.7)",
              padding: "10px",
              borderRadius: "10px",
              display: "flex",
              flexDirection: "column",
              alignItems: "center",
            }}
          >
            <button
              onClick={copyToClipboard}
              style={{
                backgroundColor: "transparent",
                color: "white",
                border: "none",
                fontSize: "14px",
                cursor: "pointer",
                marginBottom: "5px",
              }}
            >
              📋 Copier le lien
            </button>
            <a
              href={shareLinks.whatsapp}
              target="_blank"
              rel="noopener noreferrer"
              style={{
                color: "white",
                textDecoration: "none",
                fontSize: "14px",
                marginBottom: "5px",
              }}
            >
              📱 WhatsApp
            </a>
            <a
              href={shareLinks.twitter}
              target="_blank"
              rel="noopener noreferrer"
              style={{
                color: "white",
                textDecoration: "none",
                fontSize: "14px",
                marginBottom: "5px",
              }}
            >
              🐦 Twitter
            </a>
            <a
              href={shareLinks.snapchat}
              target="_blank"
              rel="noopener noreferrer"
              style={{
                color: "white",
                textDecoration: "none",
                fontSize: "14px",
              }}
            >
              👻 Snapchat
            </a>
          </div>
        )}
      </div>

      {/* Description de la vidéo */}
      <div
        style={{
          position: "absolute",
          bottom: "20px",
          left: "20px",
          color: "white",
          fontSize: "18px",
          fontWeight: "bold",
          backgroundColor: "rgba(0, 0, 0, 0.5)",
          padding: "8px",
          borderRadius: "5px",
        }}
      >
        {video.description}
      </div>
    </div>
  );
};

export default VideoCard;
