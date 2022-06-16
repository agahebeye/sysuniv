/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.js',
    './resources/**/*.ts',
    './resources/**/*.vue',
    './app/**/*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography")]

}
