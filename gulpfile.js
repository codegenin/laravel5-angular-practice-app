var elixir  = require('laravel-elixir'),
    gulp    = require('gulp'),
    gettext = require('gulp-angular-gettext');

var paths = {
    'resources': 'resources',
    'jquery': 'bower_components/jquery/dist',
    'bootstrap': 'bower_components/bootstrap-sass/assets',
    'angular': 'bower_components/angular',
    'angularAnimate': 'bower_components/angular-animate',
    'angularUIRouter': 'bower_components/angular-ui-router',
    'angularGettext': 'bower_components/angular-gettext',
    'angularStorage': 'bower_components/ngstorage',
    'fontawesome': 'bower_components/font-awesome',
    'ionic': 'resources/lib/ionic',
}

elixir(function (mix) {

    // Mix SASS
    mix.sass("app.scss",
        'public/assets/css/', {
            includePaths: [
                paths.resources + '/lib/ionic/css',
                paths.resources + +'/lib/ionic/scss',
                paths.bootstrap + '/stylesheets',
                paths.fontawesome + '/css',
            ]
        });

    // Copy Fonts
    mix.copy(paths.bootstrap + '/fonts/bootstrap/**', 'public/assets/fonts')
    mix.copy(paths.ionic + '/fonts/**', 'public/assets/fonts')

    // Mix Vendor Scripts
    mix.scripts([
        paths.jquery + "/jquery.min.js",
        paths.ionic + "/js/ionic.min.js",
        "bower_components/bootstrap/dist/js/bootstrap.min.js",
    ], 'public/assets/js/vendor/vendor.min.js', './');

    // Mix Angular Scripts
    mix.scripts([
        paths.angular + "/angular.js",
        paths.angularAnimate + "/angular-animate.js",
        //paths.angularStorage + "/ngStorage.js",
        paths.angularUIRouter + "/release/angular-ui-router.js",
        paths.angularGettext + "/dist/angular-gettext.js"
    ], 'public/assets/js/vendor/angular.min.js', './');

    // Copy Html files
    mix.copy(paths.resources + '/views/**/*.html', 'public/templates/');

    // Copy Images
    mix.copy(paths.resources + '/assets/**/*.{jpg,jpeg,png,gif}',
        'public/assets/');

    // Copy Remaning JS Files
    mix.copy(paths.resources + '/assets/js/**/*.js',
        'public/assets/js/');

    // Pot file
    gulp.task('pot', function () {
        return gulp.src([
            paths.resources + '/view/**/*.html',
            paths.resources + '/assets/js/**/*.js'])
            .pipe(gettext.extract('template.pot', {
                // options to pass to angular-gettext-tools...
            }))
            .pipe(gulp.dest(paths.resources + '/lang/po/'));
    });

    gulp.task('translations', function () {
        return gulp.src(paths.resources + '/lang/po/**/*.po')
            .pipe(gettext.compile({
                // options to pass to angular-gettext-tools...
            }))
            .pipe(gulp.dest('public/translations/'));
    });
});
