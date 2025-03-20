"use client";

import React, { useState, useEffect, useRef } from "react";
import { useSearchParams } from "next/navigation";
import VideoCard from "../components/VideoCard";

const videosByCountry: Record<string, { url: string; description: string }[]> =
  {
    France: [
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742467989/ttf7mbibjryoa4hgethl.mp4",
        description: "",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742468006/cqvthfzbblfpjqf63g3a.mp4",
        description: "",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742467981/ogdjza2pbyuvwu5t0ykn.mp4",
        description: "",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742468006/azbss9nfivswkkry1ols.mp4",
        description: "",
      },
    ],
    Germany: [
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742481441/ajkbdlfswded3brpzwtn.mp4",
        description: "Vidéo Allemagne 1",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742481441/ajkbdlfswded3brpzwtn.mp4",
        description: "Vidéo Allemagne 2",
      },
    ],
    Spain: [
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742480113/dfmsvpuds1rz07re0yue.mp4",
        description: "Vidéo Allemagne 1",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742480113/dfmsvpuds1rz07re0yue.mp4",
        description: "Vidéo Allemagne 2",
      },
    ],
    Sweden: [
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742480781/fmn5k3wdqxvbskccjrip.mp4",
        description: "Vidéo Allemagne 1",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742480781/fmn5k3wdqxvbskccjrip.mp4",
        description: "Vidéo Allemagne 2",
      },
    ],
    Cyprus: [
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460660/rraol09ebldmsmztygfa.mp4",
        description: "Vidéo Chypre 1",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742462133/a3oiebs0xt2ct7w8qdd7.mp4",
        description: "Vidéo Chypre 2",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742462133/xyimkjyqb6hbw2ajapxj.mp4",
        description: "Vidéo Chypre 3",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460846/qdlo6xpupg4qmhiascrb.mp4",
        description: "Vidéo Chypre 4",
      },
      {
        url: "https://res.cloudinary.com/dyhcikuhl/video/upload/v1742460842/lc5nxx7rhowtjoto1vst.mp4",
        description: "Vidéo Chypre 5",
      },
    ],
  };
const Scroll: React.FC = () => {
  const [activeIndex, setActiveIndex] = useState(0);
  const containerRef = useRef<HTMLDivElement>(null);
  const searchParams = useSearchParams();
  const rawCountry = searchParams.get("country") || "France";

  // 🔥 Normaliser le nom du pays (supprimer accents et espaces)
  const normalizeCountry = (name: string) => {
    return (
      name
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "") // Supprimer les accents
        .trim()
        .charAt(0)
        .toUpperCase() + name.slice(1).toLowerCase()
    );
  };

  const country = normalizeCountry(rawCountry);

  console.log("Pays sélectionné :", country);
  console.log("Pays disponibles :", Object.keys(videosByCountry));

  // Récupérer les vidéos du pays sélectionné
  const videos = videosByCountry[country] || [];

  const [likes, setLikes] = useState(Array(videos.length).fill(false));
  const [likesCount, setLikesCount] = useState(Array(videos.length).fill(0));

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

  const toggleLike = (index: number) => {
    setLikes((prevLikes) => {
      const newLikes = [...prevLikes];
      newLikes[index] = !newLikes[index];
      return newLikes;
    });

    setLikesCount((prevCounts) => {
      const newCounts = [...prevCounts];
      newCounts[index] = newCounts[index] === 0 ? 1 : 0;
      return newCounts;
    });
  };

  return (
    <div
      ref={containerRef}
      className="h-screen w-[393px] overflow-y-auto snap-y snap-mandatory mx-auto bg-black no-scrollbar"
    >
      {videos.length > 0 ? (
        videos.map((video, index) => (
          <VideoCard
            key={index}
            video={video}
            isActive={index === activeIndex}
            isLiked={likes[index]}
            likesCount={likesCount[index]}
            onLike={() => toggleLike(index)}
          />
        ))
      ) : (
        <div
          style={{
            color: "white",
            textAlign: "center",
            marginTop: "50px",
            fontSize: "20px",
          }}
        >
          Aucune vidéo disponible pour {country} 😢
        </div>
      )}
    </div>
  );
};

export default Scroll;
