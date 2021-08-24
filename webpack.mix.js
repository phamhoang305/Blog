const mix = require('laravel-mix');
mix.styles([
    'public/assets/themes/plugins/jquery-ui/jquery-ui.min.css',
    "public/assets/themes/plugins/overlayScrollbars/css/OverlayScrollbars.css",
    "public/assets/themes/plugins/toastr/toastr.min.css",
    "public/assets/themes/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css",
    "public/assets/themes/plugins/pace-progress/pace.css",
    "public/assets/themes/plugins/skeletons/css-skeletons.min.css",
    "public/assets/themes/dist/css/adminlte.min.css",
],'public/assets/themes/app/style.css').minify('public/assets/themes/app/style.css').sourceMaps();
mix.scripts([
    "public/assets/themes/plugins/jquery/jquery.min.js",
    'public/assets/themes/plugins/jquery-ui/jquery-ui.min.js',
    "public/assets/themes/plugins/bootstrap/js/bootstrap.bundle.min.js",
    "public/assets/themes/plugins/sweetalert2/sweetalert2.min.js",
    "public/assets/themes/plugins/toastr/toastr.min.js",
    "public/assets/themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
    "public/assets/themes/plugins/pace-progress/pace.min.js",
    "public/assets/themes/dist/js/adminlte.min.js",
],'public/assets/themes/app/script.js').minify('public/assets/themes/app/script.js').sourceMaps();
mix.styles(['public/assets/main/dev.css'],"public/assets/main/main.css").minify('public/assets/main/main.css').sourceMaps();;
mix.scripts(['public/assets/main/dev.js'],"public/assets/main/main.js").minify('public/assets/main/main.js').sourceMaps();;
// mix.minTemplate = require('laravel-mix-template-minifier')
// if (mix.inProduction()) {
//   mix.minTemplate('storage/framework/views/*.php', 'storage/framework/views/')
// }
