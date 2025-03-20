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
  const [showShareOptions, setShowShareOptions] = useState(false);
  const [showComments, setShowComments] = useState(false); // État pour afficher/masquer les commentaires
  const [comments, setComments] = useState<string[]>([]);
  const [newComment, setNewComment] = useState("");

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
      setNewComment(""); // Reset input
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
    >
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

      {/* Conteneur des boutons Like, Partage et Commentaire */}
      <div
        style={{
          position: "absolute",
          right: "20px",
          bottom: "200px",
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
            marginBottom: "10px",
          }}
        >
          📤
        </button>

        {/* Bouton Commentaire 💬 */}
        <button
          onClick={() => setShowComments(!showComments)}
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
          💬
        </button>
      </div>

      {/* Fenêtre des Commentaires 💬 */}
      {showComments && (
        <div
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
        >
          {/* Titre */}
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

          {/* Liste des commentaires */}
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

          {/* Zone d'écriture des commentaires */}
          <div style={{ display: "flex", marginTop: "10px" }}>
        <input
            type="text"
            value={newComment}
            onChange={(e) => setNewComment(e.target.value)}
            placeholder="Ajouter un commentaire..."
            style={{
            flex: 1,
            padding: "10px",
            borderRadius: "8px",
            border: "1px solid white", // Bordure blanche
            outline: "none",
            fontSize: "14px",
            backgroundColor: "rgba(227, 227, 227, 0.9)", // Fond blanc pour contraste
            color: "black", // Texte noir pour bien voir ce qu'on écrit
            }}
        />
        <button
            onClick={handleAddComment}
            style={{
            marginLeft: "5px",
            backgroundColor: "rgba(227, 227, 227, 0.9)",
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

      {/* Description de la vidéo */}
      <div
        style={{
          position: "absolute",
          bottom: "130px",
          left: "20px",
          color: "white",
          fontSize: "18px",
          fontWeight: "bold",
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
