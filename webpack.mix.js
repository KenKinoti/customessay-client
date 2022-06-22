const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/scripts.js', 'public/js/scripts.bundle.js')
    .sass('resources/sass/vendor.scss', 'public/css/vendor.bundle.css')
    .sass('resources/sass/style.scss', 'public/css/styles.bundle.css');

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /datatables\.net.*/,
                loader: 'imports-loader?define=>false'
            }
        ]
    }
});

if (mix.inProduction()) {
    mix.version();
}
