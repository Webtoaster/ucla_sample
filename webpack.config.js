const Encore = require("@symfony/webpack-encore");
// var Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
}

Encore.setOutputPath("public/build/") // directory where compiled assets will be stored

  // public path used by the web server to access the output path
  .setPublicPath("/build")
  // only needed for CDN's or sub-directory deploy
  // .setManifestKeyPrefix('build/')

  /**
   * If you are using a CDN, then configure here.
   * .setManifestKeyPrefix('build/')
   */
  /**
   * ENTRIES
   *
   * Add 1 entry for each "page" of your app
   * (including one is included on every page - e.g. "app")
   *
   * Each entry will result in one JavaScript file (e.g. app.js)
   * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
   */
  .addEntry("app", "./assets/js/app.js")
  .addEntry("app_election", "./assets/js/app_election.js")
  .addEntry("app_register", "./assets/js/app_register.js")
  .addEntry("app_security", "./assets/js/app_security.js")
  .addEntry("app_upload", "./assets/js/app_upload.js")

  /**
   * Style Elements
   */
  .addStyleEntry("ui", "./assets/css/ui.scss")
  .addStyleEntry("ui_election", "./assets/css/ui_election.scss")
  .addStyleEntry("ui_register", "./assets/css/ui_register.scss")
  .addStyleEntry("ui_security", "./assets/css/ui_security.scss")
  .addStyleEntry("ui_upload", "./assets/css/ui_upload.scss")

  /**
   * Future Entries
   * .addEntry('app_dashboard', './assets/js/app_dashboard.js')
   * .addEntry('', './assets/js/.js')
   *
   */

  /**
   * Split Entries into Smaller Files.
   */
  .splitEntryChunks()
  .configureSplitChunks(function (splitChunks) {
    // change the configuration
    splitChunks.minSize = 20000;
  })

  /**
   * Runtime Chunks.
   *
   * You will require an extra script tag for runtime.js
   * but, you probably want this, unless you're building
   * a single-page app
   *
   * .disableSingleRuntimeChunk()
   *
   */
  //.enableSingleRuntimeChunk()
  .disableSingleRuntimeChunk()

  /**
   * FEATURE CONFIG
   *
   * Enable & configure other features below. For a full
   * list of features, see:
   * https://symfony.com/doc/current/frontend.html#adding-more-features
   *
   * .cleanupOutputBeforeBuild()
   * .enableBuildNotifications()
   * .enableSourceMaps(!Encore.isProduction())
   */
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()

  .enableSourceMaps(!Encore.isProduction())

  /**
   * Hashed File Names
   * .enableVersioning(Encore.isProduction())
   */
  //.enableVersioning(Encore.isProduction())

  /**
   * Babel Configurations
   * Enables @babel/preset-env polyfills
   */
  .configureBabel(() => {}, {
    useBuiltIns: "usage",
    corejs: 3,
  })

  /**
   * Enables SASS File Support
   * .enableSassLoader()
   * .enablePostCssLoader()
   */
  .enableSassLoader()
  .enablePostCssLoader()

  /**
   * If using type scripts
   * .enableTypeScriptLoader()
   */

  /**
   * To use integrity hashes
   * .enableIntegrityHashes()
   */
  // .enableIntegrityHashes()

  /**
   * Paths for Copied Files out of the Assets directory to public/build.
   */
  .copyFiles({
    from: "./assets/images",

    // optional target path, relative to the output dir
    // to: 'images/[path][name].[ext]',

    // if versioning is enabled, add the file hash too
    to: "images/[path][name].[hash:8].[ext]",

    // only copy files matching this pattern
    // pattern: /\.(png|jpg|jpeg)$/
  })

  /**
   * To fix problems with JQUery Plugins
   * .autoProvidejQuery()
   */
  .autoProvidejQuery();

/**
 * For using the API platform.
 * .enableReactPreset()
 * .addEntry('admin', './assets/js/admin.js')
 */

module.exports = Encore.getWebpackConfig();
