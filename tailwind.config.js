import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import colors from 'tailwindcss/colors';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                transparent: 'transparent',
                current: 'currentColor',
                'azul': {
                    50:'#ebeeef',
                    100: '#c4d7e0',
                    200: '#A0BED1',
                    300: '#7FA4C2',
                    400: '#6289B3',
                    500: '#476EA3',
                    600: '#315494',
                    700: '#1D3B85',
                    800: '#0D2476',
                    900: '#001067',
                },
                'carmesi': {
                    50: '#FFE4F6',
                    100: '#EEBDDE',
                    200: '#DD9AC7',
                    300: '#CC7AB1',
                    400: '#BB5D9C',
                    500: '#AB4488',
                    600: '#9A2E75',
                    700: '#891B64',
                    800: '#780C53',
                    900: '#670044',
                },
                'ocre': {
                    50: '#FFFADD',
                    100: '#EEE6B7',
                    200: '#DDD295',
                    300: '#CCBF76',
                    400: '#BBAD5A',
                    500: '#AB9B42',
                    600: '#9A892C',
                    700: '#89781A',
                    800: '#78670C',
                    900: '#675700',
                },
                'verde': {
                    50: '#E5FFEE',
                    100: '#BEEECF',
                    200: '#9BDDB2',
                    300: '#7ACC97',
                    400: '#5EBB7E',
                    500: '#44AB67',
                    600: '#2E9A53',
                    700: '#1B8941',
                    800: '#0C7831',
                    900: '#006723',
                },
                'turquesa': {
                    50: '#effaff',
                    100: '#C6E2EE',
                    200: '#A1CADD',
                    300: '#80B4CC',
                    400: '#629EBB',
                    500: '#478AAB',
                    600: '#30779A',
                    700: '#1C6589',
                    800: '#0C5478',
                    900: '#004467',
                },
                'violeta': {
                    50: '#EBE1FF',
                    100: '#CCBBEE',
                    200: '#AF98DD',
                    300: '#9478CC',
                    400: '#7C5CBB',
                    500: '#6643AB',
                    600: '#522D9A',
                    700: '#401B89',
                    800: '#300C78',
                    900: '#230067',
                },
                'gris': '#a1a1a1',
            },
            fontFamily: {
                // sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
                serif: 'Roboto Slab',
                mono: 'Roboto Mono'
            },
        },
    },

    plugins: [forms, typography, colors],
};
