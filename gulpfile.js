var gulp = require('gulp'),
    less = require('gulp-less'),
    path = require('path'),
    minifycss = require('gulp-minify-css'),
    del = require('del'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify');


gulp.task('clean', function(){
  return del(['web/styles','web/scripts']);
});

gulp.task('scripts', function() {
  return gulp.src([
        'node_modules/vue/dist/vue.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'resources/assets/scripts/**/*.js'
    ])
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(gulp.dest('web/scripts'));
});

gulp.task('less', function () {
  return gulp.src('resources/assets/less/**/*.less')
    .pipe(less({
        paths: [
            'node_modules/bootstrap/less',
            path.join(__dirname, 'less', 'includes')
        ]
    }))
    .pipe(minifycss({compatibility: 'ie8'}))
    .pipe(gulp.dest('web/styles'));
});

gulp.task('default', ['clean'], function() {
    gulp.start('less');
    gulp.start('scripts');
});
