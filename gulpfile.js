var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

    mix.phpUnit();
	// Copy files
	mix.copy('vendor/bower_dl/jquery/dist/jquery.js', 'resources/assets/js/');
	mix.copy('vendor/bower_dl/bootstrap/less/**', 'resources/assets/less/bootstrap');
	mix.copy('vendor/bower_dl/bootstrap/dist/js/bootstrap.js', 'resources/assets/js/');
	mix.copy('vendor/bower_dl/angular/angular.js', 'resources/assets/js/');
	mix.copy('vendor/bower_dl/angular-ui-router/release/angular-ui-router.js', 'resources/assets/js/');
	mix.copy('vendor/bower_dl/satellizer/satellizer.js', 'resources/assets/js/');
	mix.copy('vendor/bower_dl/bootstrap/dist/fonts/**', 'public/assets/fonts');
	mix.copy('vendor/bower_dl/font-awesome/less/**', 'resources/assets/less/fontawesome');
	mix.copy('vendor/bower_dl/font-awesome/fonts/**', 'public/assets/fonts');

    // Combine scripts
    mix.scripts([
                'js/jquery.js',
                'js/bootstrap.js',
                'js/angular.js',
                'js/angular-ui-router.js',
                'js/satellizer.js'
            ],
            'public/assets/js/vendor.js',
            'resources/assets'
        )
        .scripts([
                'js/app.js',
                'js/controllers/authController.js',
                'js/controllers/reposController.js'
            ],
            'public/assets/js/application.js',
            'resources/assets'
        );

    // Compile Less
    mix.less('app.less', 'public/assets/css/app.css');
});
