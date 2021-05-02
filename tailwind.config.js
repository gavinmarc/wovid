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
        DEFAULT: '0 0 0 3px rgb(164 202 254 / 45%)',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
