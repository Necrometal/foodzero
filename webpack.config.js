const path = require("path")

module.exports = {
    resolve: {
        alias: require('./resources/js/aliases.config').webpack,
    },
    module: {
        rules: [
            {
                test: /\.(mjs|js|jsx)$/,
                exclude: /node_modules/,
                loader: 'babel-loader',


                options: {
                    presets: [
                        '@babel/preset-env',
                        {
                            plugins: [
                                '@babel/plugin-proposal-class-properties'
                            ]
                        }
                    ]
                },


            }
        ],
    }
}
