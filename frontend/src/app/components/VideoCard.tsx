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
    <div className="relative flex items-center justify-center h-screen w-[393px] snap-start bg-black">
      <video ref={videoRef} src={video.url}
        className="w-full h-full object-cover rounded-lg"
        loop
        muted
        playsInline
        autoPlay={isActive} // Lecture automatique seulement si actif
      />

      {/* Texte Description */}
      <div className="absolute bottom-5 left-5 bg-black/50 text-white text-lg font-bold p-2 rounded-md">
        {video.description}
      </div>
    </div>
  );
};

export default VideoCard;
