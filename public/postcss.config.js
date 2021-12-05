const cssMqpacker  = require('css-mqpacker');
const autoprefixer = require('autoprefixer');
const cssnano      = require('cssnano');


module.exports = (api) => {
    if (api.mode === 'development') {
        return {
            plugins: [
                autoprefixer,
            ],
        };
    }

    return {
        plugins: [
            autoprefixer({
                grid: true,
            }),
            cssMqpacker,
            cssnano({
                preset: ['default'],
            }),
        ],
    };
};
