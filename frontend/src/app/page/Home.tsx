"use client"; 

import React from "react";
import EuropeMap from "../components/EuropeMap";
import { useRouter } from "next/navigation";
import Header from "../components/header"; 
import Category from "../components/Category";


const Home: React.FC = () => {
  const router = useRouter();
  return (
    <div className="flex flex-col items-center justify-center w-full h-screen bg-black">
    
      <Header />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      
      <div className="w-[393px] h-[750px] overflow-hidden">
        <EuropeMap />
        <div className="absolute bottom-5 w-[393px] flex justify-center z-3">
          <Category />
        </div>
      </div>
      <button 
        onClick={() => router.push("../connecteMessage")}>
          <div className="text-3xl">
            <i className="fa-solid fa-comments"></i>
          </div>
      
      </button>
    </div>
  );
};

export default Home;