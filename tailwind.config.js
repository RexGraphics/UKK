/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    important: true,
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
      ],
    theme: {
        extend: {
            backgroundColor: { 'custom-orange': '#f84525',
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

