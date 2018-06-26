"use strict";

const webpack = require("webpack");
const autoprefixer = require("autoprefixer");
const AssetsPlugin = require("assets-webpack-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const FriendlyErrorsPlugin = require("friendly-errors-webpack-plugin");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const OptimCSS = require("optimize-css-assets-webpack-plugin");
const path = require("path");
const fs = require("fs");

// Make sure any symlinks in the project folder are resolved:
// https://github.com/facebookincubator/create-react-app/issues/637
const appDirectory = fs.realpathSync(process.cwd());

function resolveApp(relativePath) {
  return path.resolve(appDirectory, relativePath);
}

const paths = {
  appSrc: resolveApp("src"),
  appBuild: resolveApp("build"),
  appIndexJs: resolveApp("wp-content/themes/ceam2018/src/index.js"),
  appNodeModules: resolveApp("node_modules")
};

const DEV = process.env.NODE_ENV === "development";

module.exports = {
  bail: !DEV,
  // We generate sourcemaps in production. This is slow but gives good results.
  // You can exclude the *.map files from the build during deployment.
  target: "web",
  devtool: DEV ? "cheap-eval-source-map" : "source-map",
  entry: [paths.appIndexJs],
  output: {
    path: paths.appBuild,
    filename: DEV ? "bundle.js" : "bundle.[hash:8].js"
  },
  module: {
    rules: [
      // Disable require.ensure as it's not a standard language feature.
      { parser: { requireEnsure: false } },
      // Transform ES6 with Babel
      {
        test: /\.js?$/,
        loader: "babel-loader",
        include: paths.appSrc
      },
      {
        test: /.styl$/,
        use: [
          {
            loader: MiniCSSExtractPlugin.loader
          },
          {
            loader: "css-loader",
            options: {
              importLoaders: 1,
              minimize: !DEV
            }
          },
          {
            loader: "postcss-loader",
            options: {
              ident: "postcss", // https://webpack.js.org/guides/migrating/#complex-options
              plugins: () => [
                autoprefixer({
                  browsers: [
                    ">1%",
                    "last 4 versions",
                    "Firefox ESR",
                    "not ie < 9" // React doesn't support IE8 anyway
                  ]
                })
              ]
            }
          },
          "stylus-loader"
        ]
      }
    ]
  },
  plugins: [
    !DEV && new OptimCSS(),
    !DEV &&
      new MiniCSSExtractPlugin({
        filename: "[name]-[contenthash].css"
      }),
    !DEV && new CleanWebpackPlugin(["build"]),
    new webpack.NamedModulesPlugin(),
    new webpack.EnvironmentPlugin({
      NODE_ENV: "development", // use 'development' unless process.env.NODE_ENV is defined
      DEBUG: false
    }),
    !DEV && new UglifyJSPlugin(),
    new AssetsPlugin({
      path: paths.appBuild,
      filename: "assets.json"
    }),
    DEV &&
      new FriendlyErrorsPlugin({
        clearConsole: false
      }),
    DEV &&
      new BrowserSyncPlugin({
        notify: false,
        host: "localhost",
        port: 4000,
        logLevel: "silent",
        files: ["./*.php"],
        proxy: "http://localhost:9980/"
      })
  ].filter(Boolean)
};
