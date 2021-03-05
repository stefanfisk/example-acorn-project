module.exports = {
    purge: {
        content: [
            './app/**/*',
            './public/content/themes/app/**/*',
            '!./public/content/themes/app/dist/**/*',
            './resources/**/*',
        ],
        options: {
            safelist: [],
        },
    },
};
