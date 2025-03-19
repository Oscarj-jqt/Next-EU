// src/App.tsx
import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from "./page/Home";
import Login from "./page/Login";
import Header from "./components/header"; // Assurez-vous que le Header est ici

const App = () => {
  return (
    <Router> {/* Le Router enveloppe tout ton app */}
      <Header /> {/* Le Header peut maintenant utiliser le Link */}
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/login" element={<Login />} />
      </Routes>
    </Router>
  );
};

export default App;
