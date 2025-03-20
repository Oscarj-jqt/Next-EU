"use client";

import { useState } from "react";
import Link from "next/link";

export default function Login() {
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [message, setMessage] = useState("");

    const handleLogin = async (e: React.FormEvent) => {
        e.preventDefault();

        if (!username || !password) {
            setMessage("Fields are required");
            return;
        }

        try {
            const response = await fetch("http://127.0.0.1:8000/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ username, password }),
            });

            const data = await response.json();

            if (response.ok) {
                setMessage("Connection successfully !");
                console.log("User logged", data.username);
                localStorage.setItem("username", data.username);
            } else {
                setMessage(data.message || "Error");
            }
        } catch (error) {
            setMessage("Error");
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-[#b6f3ff] w-[393px]">
            <div className="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
                <h1 className="text-2xl font-bold text-center text-gray-700 mb-6">Login</h1>

                {message && <p className="text-red-500 text-center mb-4">{message}</p>}

                <form className="flex flex-col" onSubmit={handleLogin}>
                    <label className="mb-1 text-gray-600 font-medium">Username</label>
                    <input
                        type="text"
                        placeholder="Username"
                        value={username}
                        onChange={(e) => setUsername(e.target.value)}
                        className="mb-4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black"
                    />

                    <label className="mb-1 text-gray-600 font-medium">Password</label>
                    <input
                        type="password"
                        placeholder="••••••••"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        className="mb-6 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black"
                    />

                    <button
                        type="submit"
                        className="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-md transition duration-300"
                    >
                        Login
                    </button>
                </form>

                <p className="text-gray-600 text-sm text-center mt-4">
                    Don't have an account?
                    <Link href="/register" className="text-blue-500 hover:underline">
                        Register
                    </Link>
                </p>
            </div>
        </div>
    );
}
