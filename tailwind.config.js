/** @type {import('tailwindcss').Config} */
import forms from '@tailwindcss/forms';
export default {
  content: [
    "./resources/**/*.blade.php", // C'est ici !
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      // Définir nos couleurs "Premium"
      colors: {
        'drtv-primary': { // Couleur de votre marque (ex: un bleu)
          DEFAULT: '#0055A4', // Exemple de bleu
          'light': '#3377B6',
          'dark': '#003E7A',
        },
        'drtv-dark': { // Notre thème sombre "cinéma"
          '900': '#111827', // Fond principal
          '800': '#1F2937', // Fond des cartes/contenants
          '700': '#374151', // Bordures
        },
        'drtv-light': { // Texte sur fond sombre
          'primary': '#E5E7EB',   // Texte principal
          'secondary': '#9CA3AF', // Texte secondaire (gris)
        }
      },
      // Définir notre typographie "Pro"
      fontFamily: {
        // 'Inter' est excellente pour le pro et le moderne
        'sans': ['Inter', 'sans-serif'],
      },
    },
  },
  plugins: [
    forms,
  ],
}

