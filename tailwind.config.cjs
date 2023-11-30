/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./App/**/*.html",
    "./App/**/*.php",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ]
}
