let mix = require('laravel-mix');

mix.webpackConfig({
    watchOptions: {
        ignored: /node_modules/
    }
});



mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('Modules/Chat/Resources/assets/js/chat.js', 'public/js')
    .sass('Modules/Chat/Resources/assets/sass/chat.scss', 'public/css');