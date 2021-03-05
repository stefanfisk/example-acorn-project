module.exports = {
    root: true,
    parser: 'babel-eslint',
    extends: [
        'airbnb',
        'plugin:@wordpress/eslint-plugin/i18n',
        'plugin:eslint-comments/recommended',
        'prettier',
    ],
    env: {
        browser: true,
    },
    plugins: ['prettier'],
    settings: {
        react: {
            version: 'latest',
        },
    },
    rules: {
        '@wordpress/i18n-text-domain': [
            'error',
            {
                allowedTextDomain: 'app',
            },
        ],
        'eslint-comments/disable-enable-pair': [
            'error',
            {
                allowWholeFile: true,
            },
        ],
        'no-param-reassign': 'off',
        'no-unused-vars': [
            'error',
            {
                argsIgnorePattern: '^_',
                varsIgnorePattern: '^_',
                ignoreRestSiblings: true,
            },
        ],
        'prettier/prettier': 'error',
        'react/jsx-filename-extension': 'off',
        'react/prop-types': 'off',
        'react/react-in-jsx-scope': 'off',
    },
};
