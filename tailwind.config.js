/** @type {import('tailwindcss').Config} */
export default {
  content: [
  "./resources/**/*.blade.php",
  "./resources/**/*.js",
  "./resources/**/*.vue",
  "./node_modules/flowbite/**/*.js"],
  theme: {
    extend: {
        colors:{
            'blue-custom':{
                '100': '#0A74DA'
            },
            'green-custom':{
                '100': '#2ECC71'
            },
            'grey-custom':{
                'light': '#F4F4F4',
                'dark': '#333333',
                'neutral': '#EAEAEA'
            },
            'red-custom':{
                '100': '#FF6B6B',
            }

        }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

