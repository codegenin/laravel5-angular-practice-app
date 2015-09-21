// Gulp and plugins
var gulp    = require('gulp'),
    connect = require('gulp-connect'),
    concat  = require('gulp-concat'),
    sass    = require('gulp-sass'),
    uglify  = require('gulp-uglify'),
    rename  = require('gulp-rename'),
    clean   = require('gulp-clean');

// Source and distribution folder
var source      = 'src/',
    dest        = 'dist/',
    bowerPath   = 'bower_components/';

// Fonts
var fonts = {
    in: [
        bowerPath + 'bootstrap-sass/assets/fonts/**/*',
        bowerPath + 'font-awesome/fonts/*'
    ],
    out: dest + 'fonts/'
};

// CSS source file: .scss files
var css = {
    in: source + 'scss/main.scss',
    out: dest + 'css/',
    watch: source + 'scss/**/*',
    sassOpts: {
        outputStyle: 'nested',
        precison: 3,
        errLogToConsole: true,
        includePaths: [
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
        bowerPath + 'bootstrap/dist/js/bootstrap.min.js',
    ])
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(dest + 'js/vendor/'))
        .pipe(rename('vendor.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest + 'js/vendor/'));;
});

// Concatenates and minify angular scripts
gulp.task('angular-scripts', function() {
    return gulp.src([
        bowerPath + 'angular/angular.min.js',
        bowerPath + 'angular-animate/angular-animate.min.js',
        bowerPath + 'angular-route/angular-route.min.js',
        bowerPath + 'angular-ui-router/release/angular-ui-router.min.js'
    ])
        .pipe(concat('angular.js'))
        .pipe(gulp.dest(dest + 'js/vendor/'))
        .pipe(rename('angular.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dest + 'js/vendor/'));;;
});

// Copy all html files to dist
gulp.task('copy-html-files', function () {
    return gulp.src(source + '**/*.html')
        .pipe(gulp.dest(dest));
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
gulp.task('clean', function() {
    gulp.src('./dist/*')
        .pipe(clean({force: true}));
});
// Run local server
gulp.task('deploy', function () {
    connect.server({
        root: 'dist/',
        port: 8000
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
    'deploy',
], function () {
    gulp.watch(css.watch, ['sass']);
    gulp.watch(source + '**/*.html', ['copy-html-files']);
    gulp.watch(source + '**/*.js', ['copy-js-files']);
    gulp.watch(source + '**/*.{jpg,jpeg,png,gif}', ['copy-images-files']);
});