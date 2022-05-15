const mix = require('laravel-mix');

mix.webpackConfig({
    stats: {
        children: true,
    },
});

mix.js('resources/js/app.js', 'public/js').vue({
        options: {
            compilerOptions: {
                isCustomElement: (tag) => ['md-linedivider'].includes(tag),
            },
        },
    })
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);
