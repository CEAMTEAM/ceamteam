const path = require("path");
const webpack = require("webpack");
const AssetsPlugin = require("assets-webpack-plugin");
const MiniCSSExtractPlugin = require("mini-css-extract-plugin");
const OptimCSS = require("optimize-css-assets-webpack-plugin");

const themePath = "./wp-content/themes/ceam2018";

module.exports = {
  entry: {
    main: [
      //"babel-runtime/regenerator",

      // `${themePath}/src/vendor/headroom.js`,
      // `${themePath}/src/vendor/modernizr-custom.js`,
      // `${themePath}/src/scripts.js`,

      // "webpack-hot-middleware/client?reload=true",

      // "./src/main.js",

      `${themePath}/src/index.js`
    ]
  },
  mode: "production",
  output: {
    filename: "[name]-bundle.js",
    path: path.resolve(__dirname, "../build")
    //publicPath: "/"
  },
  devtool: "source-map",
  module: {
    rules: [
      {
        test: /\.js$/,
        use: [
          {
            loader: "babel-loader"
          }
        ],
        exclude: /node_modules/
      },
      // {
      //   test: /\.css$/,
      //   use: [
      //     // these run in reverse order
      //     // so the css-loader will run first here
      //     {
      //       loader: "style-loader"
      //     },
      //     {
      //       loader: "css-loader"
      //     }
      //   ]
      // },
      {
        test: /\.styl$/,
        use: [
          {
            loader: MiniCSSExtractPlugin.loader
          },
          { loader: "css-loader" },
          { loader: "postcss-loader" },
          { loader: "stylus-loader" }
        ]
      },
      {
        test: /\.(jpg|gif|png)$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: "img/[name].[ext]"
            }
          }
        ]
      }
    ]
  },
  plugins: [
    // new webpack.HotModuleReplacementPlugin(),
    new webpack.EnvironmentPlugin({
      NODE_ENV: "development", // use 'development' unless process.env.NODE_ENV is defined
      DEBUG: false
    }),
    new AssetsPlugin({
      path: path.resolve(__dirname, "../build"),
      filename: "assets.json"
    }),
    new OptimCSS(),
    new MiniCSSExtractPlugin({
      filename: "bundle.css",
      path: path.resolve(__dirname, "../build")
    })
  ]
};
