const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/js/**/*.vue",
    ],
    theme: {
        fontFamily: {
            // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            primary: "Playfair Display",
            body: "Work Sans",
        },
        container: {
            padding: {
                DEFAULT: "1rem",
                lg: "3rem",
            },
        },
        extend: {
            colors: {
                "light-primary": "#F5EFE7",
                "light-secondary": "#D8C4B6",
                "light-tail-100": "#4F709C",
                "light-tail-500": "#213555",
                "dark-primary": "#0E2954",
                "dark-secondary": "#1F6E8C",
                "dark-tail-100": "#2E8A99",
                "dark-tail-500": "#84A7A1",
                accent: {
                    DEFAULT: "#ac6b34",
                    hover: "#925a2b",
                },
                paragraph: "#878e99",
                blue: colors.blue,
                indigo: colors.indigo,
                green: colors.green,
                red: colors.red,
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
