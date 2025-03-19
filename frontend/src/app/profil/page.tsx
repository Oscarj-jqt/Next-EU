import React from "react";

export default function Register() {
    return (
        <div>
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
            <link 
                href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" 
                rel="stylesheet" 
            />

            <section style={{ fontFamily: "Montserrat" }} className="bg-[#b6f3ff] flex font-medium items-center justify-center h-screen w-[393px]">
                <section className="w-64 mx-auto bg-[#ffffff] rounded-2xl px-8 py-6 shadow-lg">
                    <div className="flex items-center justify-between">
                        <span className="text-gray-400 text-sm">2d ago</span>
                        <span className="text-[#7faab2]">
                            <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </span>
                    </div>
                    <div className="mt-6 w-fit mx-auto">
                        <img src="https://picsum.photos/50/50" className="rounded-full w-28" alt="profile" />
                    </div>
                    <div className="mt-8">
                        <h2 className="text-black font-bold text-2xl tracking-wide">Jonathan <br /> Smith</h2>
                    </div>
                    <p className="text-[#7faab2] font-semibold mt-2.5">
                        Active
                    </p>
                    <div className="h-1 w-full bg-black mt-8 rounded-full">
                        <div className="h-1 rounded-full w-2/5 bg-yellow-500"></div>
                    </div>
                    <div className="mt-3 text-black text-sm">
                        <span className="text-gray-400 font-semibold">Storage:</span>
                        <span> 40%</span>
                    </div>
                </section>
            </section>
        </div>
    );
}