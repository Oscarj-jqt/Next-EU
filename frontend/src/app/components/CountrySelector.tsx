import React from "react";
import countries from "../data/countries.json";

interface CountrySelectorProps {
  onSelectCountry: (country: string) => void;
}

const CountrySelector: React.FC<CountrySelectorProps> = ({
  onSelectCountry,
}) => {
  return (
    <div
      style={{
        display: "flex",
        flexWrap: "wrap",
        justifyContent: "center",
        padding: "20px",
      }}
    >
      {countries.map((country) => (
        <button
          key={country.name}
          onClick={() => onSelectCountry(country.name)}
          style={{
            margin: "10px",
            border: "none",
            background: "none",
            cursor: "pointer",
          }}
        >
          <img src={country.flag} alt={country.name} width={50} height={50} />
        </button>
      ))}
    </div>
  );
};

export default CountrySelector;
