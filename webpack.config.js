var Encore = require('@symfony/webpack-encore');
Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('app', './assets/js/app.js')
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })
;
module.exports = Encore.getWebpackConfig();