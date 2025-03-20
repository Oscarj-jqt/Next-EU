"use client";

import React, { useRef, useEffect, useState } from "react";
import { useRouter } from "next/navigation";
import { FaHeart, FaCommentDots, FaShare, FaBookmark, FaLink, FaWhatsapp, FaTwitter, FaSnapchatGhost, FaArrowLeft } from "react-icons/fa"; // Import des icônes

interface VideoCardProps {
  video: { url: string; description: string };
  isActive: boolean;
  isLiked: boolean;
  likesCount: number;
  onLike: () => void;
}

const VideoCard: React.FC<VideoCardProps> = ({ video, isActive, isLiked, likesCount, onLike }) => {
  const videoRef = useRef<HTMLVideoElement>(null);
  const [showShareOptions, setShowShareOptions] = useState(false);
  const [showComments, setShowComments] = useState(false);
  const [comments, setComments] = useState<string[]>([]);
  const [newComment, setNewComment] = useState("");
  const router = useRouter();

  const handleCopyLink = () => {
    navigator.clipboard.writeText(video.url);
    alert("Lien copié !");
  };

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

  // Ajouter un commentaire
  const handleAddComment = () => {
    if (newComment.trim() !== "") {
      setComments([...comments, newComment]);
      setNewComment("");
    }
  };

  const copyToClipboard = () => {
    navigator.clipboard.writeText(video.url);
    alert("✅ Lien copié !");
  };

  // 📌 Générer les liens de partage
  const shareLinks = {
    whatsapp: `https://api.whatsapp.com/send?text=Regarde cette vidéo ! ${video.url}`,
    twitter: `https://twitter.com/intent/tweet?url=${video.url}&text=Regarde cette vidéo !`,
    snapchat: `https://www.snapchat.com/scan?attachmentUrl=${video.url}`,
  };


  // Fermer les commentaires en cliquant à l'extérieur
  const handleOutsideClick = (e: React.MouseEvent) => {
    if (showComments) {
      const commentSection = document.getElementById("comment-section");
      if (commentSection && !commentSection.contains(e.target as Node)) {
        setShowComments(false);
      }
    }
  };

  return (
    <div
      style={{
        height: "100vh",
        width: "393px",
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        scrollSnapAlign: "start",
        position: "relative",
        backgroundColor: "black",
      }}
      onClick={handleOutsideClick} // Ferme les commentaires en cliquant ailleurs
    >
    <button
      onClick={() => router.push("/")} // Redirige vers la page d'accueil
      style={{
        position: "absolute",
    top: "20px",
    left: "20px",
    backgroundColor: "rgba(0,0,0,0.5)", // Fond semi-transparent
    color: "white",
    border: "none",
    borderRadius: "50%",
    width: "40px",
    height: "40px",
    display: "flex",
    justifyContent: "center",
    alignItems: "center",
    cursor: "pointer",
    boxShadow: "2px 2px 6px rgba(0, 0, 0, 0.6)",
    zIndex: 999,
      }}
    >
      <FaArrowLeft size={20} />
    </button>
      <video
        ref={videoRef}
        src={video.url}
        style={{
          width: "100%",
          height: "100%",
          objectFit: "cover",
          borderRadius: "10px",
        }}
        loop
        muted
        playsInline
        autoPlay={isActive}
      />

      {/* 📌 Section des boutons Like, Commentaire, Partage */}
      <div
        style={{
          position: "absolute",
          right: "20px",
          bottom: "150px",
          display: "flex",
          flexDirection: "column",
          alignItems: "center",
          gap: "20px",
        }}
      >
        {/* ❤️ Like */}
        <div style={{ textAlign: "center" }}>
          <button
            onClick={onLike}
            style={{
              border: "none",
              borderRadius: "50%",
              width: "55px",
              height: "55px",
              display: "flex",
              justifyContent: "center",
              alignItems: "center",
              filter: "drop-shadow(2px 2px 6px rgba(0, 0, 0, 0.6))",
              cursor: "pointer",
              backgroundColor: "transparent",
            }}
          >
            <FaHeart size={30} color={isLiked ? "red" : "white"} />
          </button>
          <span style={{ color: "white", fontSize: "14px", fontWeight: "bold" }}>{likesCount}</span>
        </div>

        {/* 💬 Commentaire */}
        <div style={{ textAlign: "center" }}>
          <button
            onClick={(e) => {
              e.stopPropagation(); // Empêche la fermeture immédiate en cliquant sur le bouton
              setShowComments(!showComments);
            }}
            style={{
              border: "none",
              borderRadius: "50%",
              width: "55px",
              height: "55px",
              display: "flex",
              justifyContent: "center",
              alignItems: "center",
              filter: "drop-shadow(2px 2px 6px rgba(0, 0, 0, 0.6))",
              cursor: "pointer",
              backgroundColor: "transparent",
            }}
          >
            <FaCommentDots size={30} color="white" />
          </button>
          <span style={{ color: "white", fontSize: "14px", fontWeight: "bold" }}>{comments.length}</span>
        </div>

        <div style={{ textAlign: "center" }}>
          <button
            onClick={() => setShowShareOptions(!showShareOptions)}
            style={{
              border: "none",
              borderRadius: "50%",
              width: "55px",
              height: "55px",
              display: "flex",
              justifyContent: "center",
              alignItems: "center",
              filter: "drop-shadow(2px 2px 6px rgba(0, 0, 0, 0.6))",
              cursor: "pointer",
              backgroundColor: "transparent",
            }}
          >
            <FaShare size={30} color="white" />
          </button>
        </div>
      </div>

      {/* 📤 Section de Partage */}
      {showShareOptions && (
        <div
        style={{
            position: "absolute",
            bottom: "0",
            left: "0",
            width: "100%",
            backgroundColor: "rgba(255, 255, 255, 0.9)",
            borderTopLeftRadius: "20px",
            borderTopRightRadius: "20px",
            padding: "15px",
            textAlign: "center",
          }}
        >
          <div style={{ color: "black", fontSize: "18px", fontWeight: "bold", marginBottom: "10px" }}>
            Partager la vidéo
          </div>

          <div style={{ display: "flex", justifyContent: "center", gap: "20px", marginBottom: "10px" }}>
          {/* 📋 Copier le lien */}
          <button onClick={handleCopyLink} style={buttonStyle}>
              <FaLink size={24} color="gray" />
              <span style={labelStyle}>Copier</span>
            </button>

          {/* 📱 WhatsApp */}
          <a href={`https://api.whatsapp.com/send?text=${video.url}`} target="_blank" rel="noopener noreferrer" style={buttonStyle}>
              <FaWhatsapp size={24} color="green" />
              <span style={labelStyle}>WhatsApp</span>
            </a>

          {/* 🐦 Twitter */}
          <a href={`https://twitter.com/intent/tweet?url=${video.url}`} target="_blank" rel="noopener noreferrer" style={buttonStyle}>
              <FaTwitter size={24} color="blue" />
              <span style={labelStyle}>Twitter</span>
            </a>

          {/* 👻 Snapchat */}
          <a href={`https://www.snapchat.com/scan?attachmentUrl=${video.url}`} target="_blank" rel="noopener noreferrer" style={buttonStyle}>
              <FaSnapchatGhost size={24} color="yellow" />
              <span style={labelStyle}>Snapchat</span>
            </a>
        </div>
        </div>
      )}

      {/* 💬 Section des Commentaires */}
      {showComments && (
        <div
          id="comment-section"
          style={{
            position: "absolute",
            bottom: "0",
            left: "0",
            width: "100%",
            height: "40%",
            backgroundColor: "rgba(255, 255, 255, 0.9)",
            borderTopLeftRadius: "10px",
            borderTopRightRadius: "10px",
            padding: "10px",
            display: "flex",
            flexDirection: "column",
          }}
          onClick={(e) => e.stopPropagation()} // Empêche la fermeture en cliquant à l'intérieur
        >
          {/* 📝 Titre */}
          <div
            style={{
              color: "black",
              fontSize: "16px",
              fontWeight: "bold",
              marginBottom: "10px",
              textAlign: "center",
            }}
          >
            Commentaires
          </div>

          {/* 📜 Liste des commentaires */}
          <div style={{ flex: 1, overflowY: "auto", color: "black", fontSize: "14px", padding: "5px" }}>
            {comments.length > 0 ? (
              comments.map((comment, index) => (
                <div
                  key={index}
                  style={{
                    marginBottom: "5px",
                    paddingBottom: "5px",
                    borderBottom: "1px solid #555",
                  }}
                >
                  {comment}
                </div>
              ))
            ) : (
              <div style={{ color: "#888", textAlign: "center" }}>Aucun commentaire</div>
            )}
          </div>

          {/* ✍️ Zone d'écriture */}
          <div style={{ display: "flex", marginTop: "10px" }}>
            <input
              type="text"
              value={newComment}
              onChange={(e) => setNewComment(e.target.value)}
              onKeyDown={(e) => {
                if (e.key === "Enter") {
                  handleAddComment(); // 🔥 Envoie le commentaire avec Entrée
                }
              }}
              placeholder="Ajouter un commentaire..."
              style={{
                flex: 1,
                padding: "10px",
                borderRadius: "8px",
                outline: "none",
                fontSize: "14px",
                backgroundColor: "rgba(215, 215, 215, 0.9)",
                color: "black",
              }}
            />
            <button
              onClick={handleAddComment}
              style={{
                marginLeft: "5px",
                backgroundColor: "rgba(215, 215, 215, 0.9)",
                color: "black",
                border: "none",
                borderRadius: "8px",
                padding: "10px 8px",
                cursor: "pointer",
              }}
            >
              Envoyer
            </button>
          </div>
        </div>
      )}
    </div>
  );
};
const buttonStyle = {
    display: "flex",
    flexDirection: "column",
    alignItems: "center",
    justifyContent: "center",
    width: "60px",
    height: "60px",
    backgroundColor: "rgba(214, 213, 213, 0.9)",
    borderRadius: "50%",
    textDecoration: "none",
  };
  
  const labelStyle = {
    color: "black",
    fontSize: "12px",
    marginTop: "5px",
  };

export default VideoCard;
