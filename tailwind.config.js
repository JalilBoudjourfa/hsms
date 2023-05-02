const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./app/Filament/**/*.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                // sans: ["Nunito", ...defaultTheme.fontFamily.sans],
                // dmsans: ["DM sans",'Harmattan', 'sans-serif'],
            },

            maxHeight: {
                "80%": "80%",
            },
            colors: {
                "gray-overlay": "rgba(220, 220, 220, 0.7)",
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,

            },
        },
    },
    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
