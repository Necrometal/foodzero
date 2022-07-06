const path = require('path')

function resolveSrc(_path) {
  return path.resolve(__dirname, _path)
}

const aliases = {
    '@src': '',
    '@stores': 'stores/',
    '@components': 'components/',
    '@pages': 'pages/',
    '@middlewares': 'middlewares/',
    '@composables': 'composables/',
    '@services': 'services/',
    '@tools': 'tools/',
}

module.exports = {
  webpack: {},
  jest: {},
}

for (const alias in aliases) {
  module.exports.webpack[alias] = resolveSrc(aliases[alias])
  module.exports.jest['^' + alias + '/(.*)$'] =
    '<rootDir>/' + aliases[alias] + '/$1'
}
