const path = require('path');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
            '@core': path.resolve('resources/js/core'),
            '@config': path.resolve('resources/js/config'),
            '@modules': path.resolve('resources/js/modules'),
            '@shared': path.resolve('resources/js/shared'),
        },
    },
};
