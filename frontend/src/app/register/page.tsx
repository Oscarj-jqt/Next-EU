import React from "react";

export default function Register() {
  return (
    <div className="min-h-screen flex items-center justify-center bg-[#b6f3ff] w-[393px]">
      <div className="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        <h1 className="text-2xl font-bold text-center text-gray-700 mb-6">
          Register
        </h1>

        <form className="flex flex-col">
          <label className="mb-1 text-gray-600 font-medium">Username</label>
          <input
            type="text"
            placeholder="Username"
            className="mb-4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black "
          />

          {/* <input 
            type="text" 
            placeholder="Full name"
            className="mb-4 p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 text-black "
          />
          <label className="mb-1 text-gray-600 font-medium">Email</label> */}

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
            Register
          </button>
        </form>

        <p className="text-gray-600 text-sm text-center mt-4">
          Already have a account?
          <a href="/login" className="text-blue-500 hover:underline">
            {" "}
            login
          </a>
        </p>
      </div>
    </div>
  );
}
