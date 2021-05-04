module.exports = {
  purge: [
     './resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      boxShadow: {
        DEFAULT: '0 0 0 3px rgb(75 85 99 / 45%)',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
