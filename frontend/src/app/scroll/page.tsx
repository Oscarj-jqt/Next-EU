"use client";

import React, { useState, useEffect, useRef } from "react";
import VideoCard from "../components/VideoCard";

// 🔥 Vidéos hébergées en ligne (aucun problème de lecture)
const videos = [
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460660/rraol09ebldmsmztygfa.mp4", description: "Vidéo 1 - Démo" },
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460842/lc5nxx7rhowtjoto1vst.mp4", description: "Vidéo 2 - Exemple" },
  { url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460846/qdlo6xpupg4qmhiascrb.mp4", description: "Vidéo 3 - Test" }
];

const Scroll: React.FC = () => {
  const [activeIndex, setActiveIndex] = useState(0);
  const containerRef = useRef<HTMLDivElement>(null);

  const scrollSpeed = 2;

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
  

  return (
    <div 
      ref={containerRef} 
      className="h-screen w-[393px] overflow-y-auto snap-y snap-mandatory mx-auto bg-black no-scrollbar"
    >
      {videos.map((video, index) => (
        <VideoCard key={index} video={video} isActive={index === activeIndex} />
      ))}
    </div>
  );
};

export default Scroll;
