const mix = require( 'laravel-mix' );

mix.setPublicPath('./');

mix.sass('assets/scss/style.scss', 'dist/css');
mix.js('assets/js/app.js', 'dist/js');

if ( process.env.sync ) {
    mix.browserSync({
        proxy: 'http://premmerce2',
        files: [
            '**/*.php',
            'dist/**/*.css',
            'dist/**/*.js'
        ],
        injectChanges: true,
        open: false
    });
}

// Add versioning to assets in production environment
if ( mix.inProduction() ) {
    mix.version();
}