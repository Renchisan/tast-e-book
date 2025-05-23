import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                dmserif: ['"DM Serif Display"', 'serif'],
                parkinsans: ['"Parkinsans"', 'sans-serif'],
                playfair: ['"Playfair Display"', 'serif'],
            },    
            animation: {
            'slide-up': 'slideUp 0.8s ease-out forwards',
            },
            keyframes: {
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(100px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },



    plugins: [forms],
};
