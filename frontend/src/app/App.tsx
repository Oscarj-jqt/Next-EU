// src/app/_app.tsx

import React from 'react';
import Layout from './layout';  // Assurez-vous d'avoir le bon chemin vers ton layout

export default function App({ Component, pageProps }: { Component: React.ComponentType; pageProps: any }) {
  return (
    <Layout>
      <Component {...pageProps} />
    </Layout>
  );
}
