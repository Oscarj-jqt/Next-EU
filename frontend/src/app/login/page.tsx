import React from "react";

export default function Login() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-[#b6f3ff]">
      <div className="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 className="text-2xl font-bold text-center text-gray-700 mb-6">Login</h1>
        
        <form className="flex flex-col">
          <label className="mb-1 text-gray-600 font-medium">Email</label>
          <input 
            type="email" 
            placeholder="example@test.com"
            className="mb-4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black "
          />

          <label className="mb-1 text-gray-600 font-medium">Password</label>
          <input 
            type="password" 
            placeholder="••••••••"
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
          <a href="/register" className="text-blue-500 hover:underline"> Register</a>
        </p>
      </div>
    </div>
  );
}
