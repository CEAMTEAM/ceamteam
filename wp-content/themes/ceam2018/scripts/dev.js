"use strict";

const webpack = require("webpack");
const config = require("./webpack.dev");

const clientCompiler = webpack(config);

clientCompiler.watch(
  {
    noInfo: false,
    quiet: false
  },
  (err, stats) => {
    if (err) return;
  }
);
