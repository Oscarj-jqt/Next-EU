"use client";

import React, { useRef, useEffect } from "react";

interface VideoCardProps {
  video: { url: string; description: string };
  isActive: boolean;
}

const VideoCard: React.FC<VideoCardProps> = ({ video, isActive }) => {
  const videoRef = useRef<HTMLVideoElement>(null);

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
        autoPlay={isActive} // Lecture automatique seulement si active
      />

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
