import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  env: {
    SERVER_PORT: "3000",
    SERVER_IP: "0.0.0.0",
  },
};

export default nextConfig;
