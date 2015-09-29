// Gulp and plugins
var gulp    = require('gulp'),
    connect = require('gulp-connect'),
    concat  = require('gulp-concat'),
    sass    = require('gulp-sass'),
    uglify  = require('gulp-uglify'),
    rename  = require('gulp-rename'),
    clean   = require('gulp-clean'),
    gettext = require('gulp-angular-gettext');;

// Source and distribution folder
var source      = 'resources/',
    dest        = 'public/',
    bowerPath   = 'bower_components/';

// Fonts
var fonts = {
    in: [
        bowerPath + 'bootstrap-sass/assets/fonts/**/*',
        bowerPath + 'font-awesome/fonts/*',
        source + 'lib/ionic/fonts/*',
    ],
    out: dest + 'assets/fonts/'
};

// CSS source file: .scss files
var css = {
    in: source + 'assets/sass/app.scss',
    out: dest + 'assets/css/',
    watch: source + 'assets/sass/**/*',
    sassOpts: {
        outputStyle: 'nested',
        precison: 3,
        errLogToConsole: true,
        includePaths: [
            source + 'lib/ionic/css',
            source + 'lib/ionic/scss',
            bowerPath + 'bootstrap-sass/assets/stylesheets',
            bowerPath + 'font-awesome/css',
        ]
    }
};

// Copy bootstrap required fonts to dist
gulp.task('fonts', function () {
    return gulp
        .src(fonts.in)
        .pipe(gulp.dest(fonts.out));
});

// Compile scss
gulp.task('sass', ['fonts'], function () {
    return gulp.src(css.in)
        .pipe(sass(css.sassOpts))
        .pipe(gulp.dest(css.out));
});

// Concatenates and minify vendor scripts
gulp.task('vendor-scripts', function() {
    return gulp.src([
        bowerPath + 'jquery/dist/jquery.min.js',
        source + 'lib/ionic/js/ionic.min.js',
        bowerPath + 'bootstrap/dist/js/bootstrap.min.js',
    ])
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(dest + 'assets/js/vendor/'))
        .pipe(rename('vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest + 'assets/js/vendor/'));;
});

// Concatenates and minify angular scripts
gulp.task('angular-scripts', function() {
    return gulp.src([
        bowerPath + 'angular/angular.min.js',
        bowerPath + 'angular-animate/angular-animate.min.js',
        bowerPath + 'angular-route/angular-route.min.js',
        bowerPath + 'angular-ui-router/release/angular-ui-router.min.js',
        bowerPath + 'angular-gettext/dist/angular-gettext.js'
    ])
        .pipe(concat('angular.js'))
        .pipe(gulp.dest(dest + 'assets/js/vendor/'))
        .pipe(rename('angular.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest + 'assets/js/vendor/'));;;
});

// Copy all html files to dist
gulp.task('copy-html-files', function () {
    return gulp.src(source + 'views/**/*.html')
        .pipe(gulp.dest(dest + 'templates'));
});

// Copy all image files to dist
gulp.task('copy-images-files', function () {
    return gulp.src(source + '**/*.{jpg,jpeg,png,gif}')
        .pipe(gulp.dest(dest));
});

// Copy all js files to dist
gulp.task('copy-js-files', function () {
    return gulp.src(source + '**/*.js')
        .pipe(gulp.dest(dest));
});

// Clean all files in dist
/*gulp.task('clean', function() {
    gulp.src('./publi/!*')
        .pipe(clean({force: true}));
});*/

// Pot file
gulp.task('pot', function () {
    return gulp.src([source +'/**/*.html', source + '/js/**/*.js'])
        .pipe(gettext.extract('template.pot', {
            // options to pass to angular-gettext-tools...
        }))
        .pipe(gulp.dest(source + 'po/'));
});

gulp.task('translations', function () {
    return gulp.src( source + 'lang/po/**/*.po')
        .pipe(gettext.compile({
            // options to pass to angular-gettext-tools...
        }))
        .pipe(gulp.dest(dest + '/translations/'));
});

// Run local server
gulp.task('deploy', function () {
    connect.server({
        root: dest,
        port: 80
    });
});

// Default task
gulp.task('default', [
    'sass',
    'vendor-scripts',
    'angular-scripts',
    'copy-html-files',
    'copy-js-files',
    'copy-images-files',
    'translations',
    //'deploy',
], function () {
    gulp.watch(css.watch, ['sass']);
    gulp.watch(source + '**/*.html', ['copy-html-files']);
    gulp.watch(source + '**/*.js', ['copy-js-files']);
    gulp.watch(source + '**/*.{jpg,jpeg,png,gif}', ['copy-images-files']);
});