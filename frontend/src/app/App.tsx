// src/App.tsx
import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from "./home/page";
import Header from "./components/header"; // Assurez-vous que le Header est ici

const App = () => {
  return (
    <Router> {/* Le Router enveloppe tout ton app */}
      <Header /> {/* Le Header peut maintenant utiliser le Link */}
      <Routes>
        <Route path="/" element={<Home />} />
      </Routes>
    </Router>
  );
};

export default App;
