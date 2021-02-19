const mix = require('laravel-mix');

mix.options({
	processCssUrls: false,
	terser: {
	    extractComments: false,
	}
});
if(mix.inProduction()){
	mix.version();
}
else{
	mix.sourceMaps();
}
mix.browserSync({
	open: "external",
	online: true,
	proxy: "localhost:8000"
})

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

mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/app.js', 'public/js').vue();

mix.sass('resources/assets/sass/admin.scss', 'public/css');
mix.js('resources/assets/js/admin.js', 'public/js').vue();

