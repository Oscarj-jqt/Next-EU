import React, { useState } from "react";

export default function Register() {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [message, setMessage] = useState("");

  const handleRegister = async (e: Event) => {
    e.preventDefault();

    if (username.length < 3) {
      setMessage("Username must have at least 3 characters");
      return;
    }
    if (password.length < 6) {
      setMessage("Password must have at least 6 characters");
      return;
    }

    try {
      const response = await fetch("http://127.0.0.1:8000/api/create-user", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ username, password }),
      });

      const data = await response.json();
      if (response.ok) {
        setMessage("Register successfully !");
      } else {
        setMessage(data.error || "Error with registration");
      }
      // eslint-disable-next-line @typescript-eslint/no-unused-vars
    } catch (error) {
      setMessage("Error with server connection");
    }
  };

  return (
    <div className="min-h-screen flex items-center justify-center bg-[#b6f3ff] w-[393px]">
      <div className="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 className="text-2xl font-bold text-center text-gray-700 mb-6">
          Register
        </h1>

        {message && <p className="text-red-500 text-center">{message}</p>}

        <form className="flex flex-col" onSubmit={handleRegister}>
          <label className="mb-1 text-gray-600 font-medium">Username</label>
          <input
            type="text"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
            placeholder="Username"
            className="mb-4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black "
          />

          <label className="mb-1 text-gray-600 font-medium">Password</label>
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            placeholder="••••••••"
            className="mb-6 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black"
          />

          <button
            type="submit"
            className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md transition duration-300"
          >
            Register
          </button>
        </form>

        <p className="text-gray-600 text-sm text-center mt-4">
          Already have an account?
          <a href="/login" className="text-blue-500 hover:underline">
            {" "}
            Login
          </a>
        </p>
      </div>
    </div>
  );
}
