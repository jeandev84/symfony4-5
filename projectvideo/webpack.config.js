const Encore = require('@symfony/webpack-encore');


Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/assets/')

    // public path used by the web server to access the output path
    .setPublicPath('/assets')
    // only needed for CDN's or sub-directory deploy

    //.addEntry('app', './assets/app.js')
    .addEntry('js/likes', './assets/js/likes.js')
    .addStyleEntry('css/dashboard', ['./assets/css/dashboard.css'])
    .addStyleEntry('css/login', ['./assets/css/login.css'])
    .addStyleEntry('css/likes', ['./assets/css/likes.css'])

    // .enableSingleRuntimeChunk()
    //
    // .cleanupOutputBeforeBuild()
    // .enableSourceMaps(!Encore.isProduction())
    // // enables hashed filenames (e.g. app.abc123.css)
    // .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();