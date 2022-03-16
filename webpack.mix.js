const mix = require('laravel-mix');

const isProduction = mix.inProduction();
const config = require('./webpack.config');
const devConfig = {
    ...config,
    devtool: 'inline-source-map'
}

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .webpackConfig(isProduction ? config : devConfig);

if (isProduction) {
    mix.version();
} else {
    mix.sourceMaps();
}
