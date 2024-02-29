const colors = require(`tailwindcss/colors`);
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/vue-tailwind-datepicker/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                "vtd-primary": colors.sky, // Light mode Datepicker color
                // "vtd-secondary": colors.gray, // Dark mode Datepicker color
            },
        }
    },
    plugins: [require("@tailwindcss/forms")],
}