// https://github.com/shelljs/shelljs
require('./check-versions')();

process.env.NODE_ENV = 'production';

var path = require('path');
var chalk = require('chalk');
var merge = require('webpack-merge');
var shell = require('shelljs');
var webpack = require('webpack');
var config = require('../config');
var buildWebpackConfig = require('./webpack.prod.conf');
var webpackConfig = merge(buildWebpackConfig, {
    plugins: [
        new webpack.ProgressPlugin()
    ]
});

var assetsPath = path.join(config.build.assetsRoot, config.build.assetsSubDirectory);
shell.rm('-rf', assetsPath);
shell.mkdir('-p', assetsPath);
shell.config.silent = true;
shell.cp('-R', 'static/*', assetsPath);
shell.config.silent = false;

webpack(webpackConfig, function (err, stats) {
    if (err) throw err;
    process.stdout.write(stats.toString({
            colors: true,
            modules: false,
            children: false,
            chunks: false,
            chunkModules: false
        }) + '\n\n');

    console.log(chalk.cyan('  Build complete.\n'));
});
