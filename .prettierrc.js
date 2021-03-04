module.exports = {
    singleQuote: true,
    trailingCommas: 'all',
    overrides: [
        {
            files: ['**/*.css', '**/*.scss', '**/*.html'],
            options: {
                singleQuote: false,
            },
        },
    ],
};
