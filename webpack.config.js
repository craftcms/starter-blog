const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserJSPlugin = require('terser-webpack-plugin');
const devMode = process.env.NODE_ENV !== 'production';
const path = require('path');
const sane = require('sane');
const webpack = require('webpack');

config = {
  optimization: {
    minimizer: devMode ? [] : [
      new TerserJSPlugin(),
      new CssMinimizerPlugin(),
    ],
  },
  devServer: {
    allowedHosts: "all",
    static: {
      directory: path.join(__dirname, 'web/assets/dist'),
    },
    devMiddleware: {
      writeToDisk: true,
    },
    port: 8080,
    hot: true,
    onBeforeSetupMiddleware: (server) => {
      const watcher = sane(path.join(__dirname, './templates/'), {
        glob: ['**/*'],
      });
      watcher.on('change', function (filePath, root, stat) {
        console.log('  File modified:', filePath);
        server.sendMessage(server.webSocketServer.clients, "content-changed");
      });
    }
  },
  output: {
    path: path.resolve(__dirname, 'web/assets/dist'),
    filename: devMode ? "[name].js" : "[name].[fullhash].js",
    chunkFilename: "[name].[chunkhash].js",
    publicPath: '/assets/dist/'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader"
        }
      },
      {
        test: /\.css$/,
        use: ['style-loader', 'css-loader']
      },
      {
        test: /\.(png|jpe?g|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
            },
          },
        ],
      }
    ]
  },
  plugins: [
    new CleanWebpackPlugin(),
    new WebpackManifestPlugin(),
    new MiniCssExtractPlugin({
      filename: devMode ? '[name].css' : '[name].[fullhash].css',
      chunkFilename: devMode ? '[id].css' : '[id].[fullhash].css',
    }),
    new webpack.ProvidePlugin({
     $: "jquery",
     jQuery: "jquery"
    })
  ]
}

module.exports = (env) => {
  if (env.WEBPACK_SERVE) {
    config.module.rules.push({
      test: /\.scss$/,
      use: [
        "style-loader",
        "css-loader",
        "postcss-loader",
        "sass-loader"
      ]
    });
  } else {
    config.module.rules.push({
      test: /\.scss$/,
      use: [
        MiniCssExtractPlugin.loader,
        "css-loader",
        "postcss-loader",
        "sass-loader"
      ]
    });
  }

  return config;
};
