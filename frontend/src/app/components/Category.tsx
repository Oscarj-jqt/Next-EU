"use client";

import { motion } from "framer-motion";

const categories = [
  "Food",
  "Memes",
  "Musées",
  "Art",
  "Sport",
  "Voyage",
  "Tech",
  "Nature",
  "Films",
  "Livres",
  "Histoire",
  "Musique",
];

const Category = () => {
  const radius = 150; // Le rayon du cercle

  return (
    <div className="w-[393px] h-0 relative">
      {/* { Conteneur de fond } */}
      <div className="absolute inset-0 bg-transparent-200 z-1">
        {/* { Remplace la couleur de fond par une carte si nécessaire } */}
      </div>

      {/* {/ Catégories avec positionnement circulaire /} */}
      <motion.div
        className="flex justify-center items-center relative z-0"
        drag="x"
        dragConstraints={{ left: -400, right: 0 }} // Ajuste la plage de déplacement
      >
        {categories.map((category, index) => {
          // Calcul des angles pour chaque catégorie
          const angle = (index / categories.length) * 2 * Math.PI;
          const x = radius * Math.cos(angle);
          const y = radius * Math.sin(angle);

          return (
            <div
              key={index}
              className="absolute"
              style={{
                left: `50%`,
                top: `50%`,
                transform: `translate(-50%, -50%) translate(${x}px, ${y}px)`,
              }}
            >
              <div className="bg-[#00008B] px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                {category}
              </div>
            </div>
          );
        })}
      </motion.div>
    </div>
  );
};

export default Category;
