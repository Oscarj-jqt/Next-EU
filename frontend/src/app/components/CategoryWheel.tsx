"use client";

import React, { useState } from "react";
import styles from "./CategoryWheel.module.css"; // Import du CSS

const categories = ["Food", "Sport", "Architecture", "Travel", "Tech", "Nature"];

const CategoryWheel: React.FC = () => {
  const [activeIndex, setActiveIndex] = useState(0); // Catégorie active

  // Rotation de la roue
  const rotateWheel = (direction: "left" | "right") => {
    setActiveIndex((prevIndex) => {
      if (direction === "left") return (prevIndex + 1) % categories.length;
      return (prevIndex - 1 + categories.length) % categories.length;
    });
  };

  return (
    <div className={styles.wheelContainer}>
      <div className={styles.wheel}>
        {categories.map((category, index) => {
          const isActive = index === activeIndex;
          return (
            <div
              key={index}
              className={`${styles.category} ${isActive ? styles.active : ""}`}
              style={{
                transform: `rotate(${(index - activeIndex) * 30}deg) translateY(-40px)`,
                opacity: isActive ? 1 : 0.5,
              }}
            >
              {category}
            </div>
          );
        })}
      </div>

      {/* Boutons pour tourner la roue */}
      <button className={styles.arrowLeft} onClick={() => rotateWheel("left")}>◀</button>
      <button className={styles.arrowRight} onClick={() => rotateWheel("right")}>▶</button>
    </div>
  );
};

export default CategoryWheel;
