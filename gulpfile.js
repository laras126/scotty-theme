
'use strict';

var gulp = require('gulp'),
    sass = require('gulp-sass'),
    svgmin = require('gulp-svgmin'),
    svgstore = require('gulp-svgstore'),
    path = require('path'),
    autoprefix = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

// Put JS files into array
var jsFileList = [
  'assets/js/vendor/*.js',
  'assets/js/main.js'
];

gulp.task('sass', function() {
  return gulp.src('assets/scss/main.scss')
    .pipe(sass())
    .pipe(autoprefix({
        browsers: 'last 5 versions'
    }))
    .pipe(gulp.dest('assets/css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(gulp.dest('assets/css'));
});

gulp.task('js', function() {
  return gulp.src(jsFileList)
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest('assets/js/build'))
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('assets/js/build'));
});

gulp.task('js-head', function() {
  return gulp.src('assets/js/vendor-head/*.js')
    .pipe(concat('scripts-head.js'))
    .pipe(gulp.dest('assets/js/build'))
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('assets/js/build'));
});

gulp.task('watch', function() {
  gulp.watch('assets/scss/**/*.scss', ['sass']);
  gulp.watch('assets/js/**/*.js', ['scripts']);
});


gulp.task('svgs', function () {
  return gulp
    .src('assets/img/svg/*.svg')
    .pipe(rename({prefix: 'shape-'}))
    .pipe(svgmin(function (file) {
        var prefix = path.basename(file.relative, path.extname(file.relative));
        return {
          plugins: [{
            cleanupIDs: {
              prefix: prefix + '-',
              minify: true
            }
          }]
        }
    }))
    .pipe(svgstore())
    .pipe(rename('svg-defs.svg'))
    .pipe(gulp.dest('views/utility'));
});

// sass --watch input:output
