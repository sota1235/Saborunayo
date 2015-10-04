'use strict';

var gulp       = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
var browserify = require('browserify');
var source     = require('vinyl-source-stream');
var buffer     = require('vinyl-buffer');
var glob       = require('glob');

gulp.task('script', () => {
  let scripts = glob.sync('./resources/assets/js');
  browserify({
    entries: scripts,
    debug: true
  })
  .bundle()
  .pipe(source('app.js'))
  .pipe(buffer())
  .pipe(sourcemaps.init({
    loadMaps: true
  }))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./public/js'));
});

gulp.task('default', ['script']);
