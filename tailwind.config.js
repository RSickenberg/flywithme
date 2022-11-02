const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

const flywithmeColors = {
  primary: '#0ed3d0',
  secondary: '#ba79fa',
  primaryDark: '#096766',
  secondaryDark: '#3c0d69',
  danger: colors.rose,
  success: colors.green,
  warning: colors.yellow,
};

/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'media',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/components/**/*.vue',
    './resources/js/components/**/*.js',
    './app/**/*.php',
    './config/*.php',
    './vendor/filament/**/*.blade.php',
  ],

  theme: {
    container: {
      center: true,
    },
    extend: {
      fontFamily: {
        sans: ['Robot', 'Nunito', ...defaultTheme.fontFamily.sans],
      },
      spacing: {
        128: '28rem',
        132: '32rem',
        144: '37rem',
      },
      colors: {
        ...colors,
        ...flywithmeColors,
      },
      backgroundColor: {
        DEFAULT: colors.white,
        active: '#ffffff',
        primary: flywithmeColors.primary,
        secondary: flywithmeColors.secondary,
        primaryDark: flywithmeColors.primaryDark,
        secondaryDark: flywithmeColors.secondaryDark,
      },
    },
  },

  plugins: [
    require('@tailwindcss/typography'),
    require('daisyui'),
  ],

  daisyui: {
    styled: true,
    themes: [{
      flywithme: {
        primary: flywithmeColors.primary,
        secondary: flywithmeColors.secondary,
        accent: "#37cdbe",
        neutral: "#3d4451",
        "base-100": "#ffffff",
      }
    }],
    base: true,
    utils: true,
    logs: true,
    rtl: false,
    prefix: 'ds-',
  },
};
