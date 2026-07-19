import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50: '#eef2ff',
                    100: '#e0e7ff',
                    200: '#c7d2fe',
                    300: '#a5b4fc',
                    400: '#818cf8',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                    800: '#3730a3',
                    900: '#312e81',
                },
            },
            boxShadow: {
                soft: '0 1px 2px 0 rgba(15, 23, 42, 0.04), 0 1px 3px 0 rgba(15, 23, 42, 0.06)',
                premium: '0 4px 6px -2px rgba(15, 23, 42, 0.05), 0 12px 24px -8px rgba(15, 23, 42, 0.12)',
                'premium-lg': '0 8px 16px -4px rgba(15, 23, 42, 0.08), 0 24px 48px -12px rgba(15, 23, 42, 0.18)',
                'brand-glow': '0 0 0 1px rgba(79,70,229,0.12), 0 8px 24px -6px rgba(79,70,229,0.35)',
            },
            borderRadius: {
                xl2: '1rem',
            },
            transitionDuration: {
                250: '250ms',
            },
            keyframes: {
                'fade-in': {
                    '0%': { opacity: '0', transform: 'translateY(4px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'scale-in': {
                    '0%': { opacity: '0', transform: 'scale(0.96)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                'slide-in-right': {
                    '0%': { opacity: '0', transform: 'translateX(12px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                shimmer: {
                    '100%': { transform: 'translateX(100%)' },
                },
            },
            animation: {
                'fade-in': 'fade-in 220ms ease-out',
                'scale-in': 'scale-in 180ms ease-out',
                'slide-in-right': 'slide-in-right 260ms ease-out',
            },
        },
    },

    plugins: [forms],
};