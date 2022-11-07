'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const browserSync = require('browser-sync');
const reload = browserSync.reload;
const mode = require('gulp-mode')({
  modes: ["prod", "dev"],
  default: "prod",
  verbose: false
});

// Build tasks.
function style() {
  return gulp.src('assets/scss/**/*.scss')
    .pipe(mode.dev(sourcemaps.init())) // Use "gulp style --dev" for sourcemaps
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(mode.dev(sourcemaps.write()))
    .pipe(gulp.dest('assets/css'))
    .pipe(browserSync.reload({
      stream: true
    }))
    ;
}

// Watch & Build tasks.
// Use "gulp watch --dev" for sourcemaps
function watchFiles() {
  var files = [
    'assets/css/app.css',
    'assets/js/**/*.js',
    'assets/images/**/*',
    'templates/**/*.twig',
    '*.twig'
  ];
  browserSync.init({
    proxy: "http://localhost/accufire/web/"
  });
  gulp.watch('./assets/scss/**/*.scss', style);
  gulp.watch(files).on('change', browserSync.reload)
}

const watch = gulp.series(style, watchFiles);

exports.style = style;
exports.css = style;
exports.build = style;
exports.watch = watch;
