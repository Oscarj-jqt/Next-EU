"use client";

import React, { useState, useEffect, useRef } from "react";
import VideoCard from "../components/VideoCard";

// 🔥 Vidéos hébergées en ligne
const videos = [
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460660/rraol09ebldmsmztygfa.mp4", description: "Vidéo 1 - Démo" },
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460842/lc5nxx7rhowtjoto1vst.mp4", description: "Vidéo 2 - Exemple" },
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460846/qdlo6xpupg4qmhiascrb.mp4", description: "Vidéo 3 - Test" },
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742462133/xyimkjyqb6hbw2ajapxj.mp4", description: "Vidéo 4 - Test" },
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742462133/a3oiebs0xt2ct7w8qdd7.mp4", description: "Vidéo 4 - Test" }

];

const Scroll: React.FC = () => {
  const [activeIndex, setActiveIndex] = useState(0);
  const containerRef = useRef<HTMLDivElement>(null);

  // État des likes
  const [likes, setLikes] = useState(Array(videos.length).fill(false)); // Garde en mémoire si une vidéo est likée
  const [likesCount, setLikesCount] = useState(Array(videos.length).fill(0)); // Stocke le nombre de likes

  useEffect(() => {
    const handleScroll = () => {
      if (containerRef.current) {
        const scrollPosition = containerRef.current.scrollTop;
        const newIndex = Math.round(scrollPosition / window.innerHeight);
        setActiveIndex(newIndex);
      }
    };

    const container = containerRef.current;
    container?.addEventListener("scroll", handleScroll);
    return () => container?.removeEventListener("scroll", handleScroll);
  }, []);

  // Fonction pour gérer les likes
  const toggleLike = (index: number) => {
    setLikes((prevLikes) => {
      const newLikes = [...prevLikes];
      newLikes[index] = !newLikes[index]; // Change l'état du like
      return newLikes;
    });

    setLikesCount((prevCounts) => {
      const newCounts = [...prevCounts];
      newCounts[index] = newCounts[index] === 0 ? 1 : 0; // Si 0 → 1, sinon 1 → 0
      return newCounts;
    });
  };

  return (
    <div
      ref={containerRef}
      style={{
        height: "100vh",
        width: "393px",
        overflowY: "scroll",
        scrollSnapType: "y mandatory",
        margin: "0 auto",
        backgroundColor: "black",
      }}
    >
      {videos.map((video, index) => (
        <VideoCard
          key={index}
          video={video}
          isActive={index === activeIndex}
          isLiked={likes[index]}
          likesCount={likesCount[index]}
          onLike={() => toggleLike(index)}
        />
      ))}
    </div>
  );
};

export default Scroll;
