"use client";
import { useRef, useState, useEffect } from "react";
import Link from "next/link"; 

const CameraRecorder = () => {
  const videoRef = useRef<HTMLVideoElement>(null);
  const mediaRecorderRef = useRef<MediaRecorder | null>(null);
  const [recording, setRecording] = useState(false);
  const [videoBlob, setVideoBlob] = useState<Blob | null>(null);
  const recordTimeoutRef = useRef<NodeJS.Timeout | null>(null);
  const [stream, setStream] = useState<MediaStream | null>(null);

  useEffect(() => {
    if (!videoBlob) {
      startCamera();
    }
  }, [videoBlob]);

  const startCamera = async () => {
    try {
      const newStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
      setStream(newStream);
      if (videoRef.current) {
        videoRef.current.srcObject = newStream;
      }
    } catch (error) {
      console.error("Erreur lors de l'accès à la caméra :", error);
    }
  };

  const startRecording = () => {
    if (!stream) return;

    const mediaRecorder = new MediaRecorder(stream);
    const chunks: BlobPart[] = [];

    mediaRecorder.ondataavailable = (event) => {
      chunks.push(event.data);
    };

    mediaRecorder.onstop = () => {
      const blob = new Blob(chunks, { type: "video/mp4" });
      setVideoBlob(blob);
      stopCamera(); // Éteindre la caméra après l'enregistrement
    };

    mediaRecorder.start();
    mediaRecorderRef.current = mediaRecorder;
    setRecording(true);

    // ⏳ Arrêter l'enregistrement après 30 secondes
    recordTimeoutRef.current = setTimeout(() => {
      stopRecording();
    }, 30000);
  };

  const stopRecording = () => {
    mediaRecorderRef.current?.stop();
    setRecording(false);
    if (recordTimeoutRef.current) {
      clearTimeout(recordTimeoutRef.current);
      recordTimeoutRef.current = null;
    }
  };

  const stopCamera = () => {
    if (stream) {
      stream.getTracks().forEach((track) => track.stop());
      setStream(null);
    }
  };

  const uploadVideo = async () => {
    if (!videoBlob) return;

    const formData = new FormData();
    formData.append("video", videoBlob, "video.mp4");

    try {
      const response = await fetch("/api/upload", {
        method: "POST",
        body: formData,
      });

      if (response.ok) {
        console.log("Vidéo envoyée avec succès !");
      } else {
        console.error("Erreur lors de l'envoi de la vidéo");
      }
    } catch (error) {
      console.error("Erreur :", error);
    }
  };

  return (
    <div className="w-screen h-screen flex flex-col items-center justify-center bg-black relative max-w-[393px] mx-auto">
      {/* Bouton retour à l'accueil */}
      <Link href="/home">
        <button className="absolute top-5 right-5 px-4 py-2 z-50 font-extrabold text-3xl">
          X
        </button>
      </Link>

      {!videoBlob ? (
        <>
          <video
            ref={videoRef}
            autoPlay
            playsInline
            className="w-full h-full object-cover"
          />
          <div className="absolute bottom-10 flex gap-4">
            {recording ? (
              <button
                onClick={stopRecording}
                className="px-6 py-3 text-white rounded-full text-3xl"
              >
                ⏹️ 
              </button>
            ) : (
              <button
                onClick={startRecording}
                className="px-6 py-3 text-white rounded-full text-3xl font-extrabold"
              >
                O
              </button>
            )}
          </div>
        </>
      ) : (
        <div className="w-full h-full flex flex-col items-center justify-center bg-black">
          <video
            src={URL.createObjectURL(videoBlob)}
            controls
            className="w-full h-full object-cover"
          />
          <div className="absolute bottom-10 flex gap-4">
            <button
              onClick={() => setVideoBlob(null)}
              className="px-6 py-3 text-white text-3xl"
            >
              🔄
            </button>
            <button
              onClick={uploadVideo}
              className="px-6 py-3 text-white text-3xl"
            >
              ⬆️
            </button>
          </div>
        </div>
      )}
    </div>
  );
};

export default CameraRecorder;
