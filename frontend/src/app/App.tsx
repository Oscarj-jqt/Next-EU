import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Login from "./page/Login";
import Home from "./page/Home"; 
import Layout from "./layout";

const App: React.FC = () => {
  return (
    <Router>
      <Routes>
         <Route path="/" element={<Layout />}>
         <Route index element={<Home />} />
        <Route path="/login" element={<Login />} />
        </Route>
      </Routes>
    </Router>
  );
};

export default App;
