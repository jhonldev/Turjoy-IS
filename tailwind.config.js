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
                '100': '#2ECC71',
                'validate': '#A8E6CF'
            },
            'grey-custom':{
                'light': '#F4F4F4',
                'dark': '#333333',
                'darkSmoke': 'rgba(51, 51, 51, 0.19)',
                'neutral': '#EAEAEA'
            },
            'red-custom':{
                '100': '#FF6B6B',
                'invalidate': '#FF8A80'
            },
            'yellow-custom':{
                'clone': '#E4E6A8'
            },

        }
    },
    plugins: [require('flowbite/plugin')],
  },
}

