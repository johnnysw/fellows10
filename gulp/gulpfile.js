/**
 * Created by apple on 17/3/18.
 */
var gulp = require('gulp');
var sass = require('gulp-sass');
var connect = require('gulp-connect');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var minCss = require('gulp-minify-css');




gulp.task('test',function(){
    console.log('aaa');
});
gulp.task('test1',function(){
    console.log('bbb');
});
gulp.task('test3',['test','test1']);

//copy img
gulp.task('copy-img',function(){
    gulp.src(['src/images/**/*.{jpg,png}','!src/images/prev.png'])
        .pipe(gulp.dest('dist/img'));
});

//


gulp.task('sass',function(){
    gulp.src('src/sass/*.scss')
        .pipe(sass({ outputStyle: 'expanded'}))
        .pipe(gulp.dest('dist/css')).pipe(connect.reload());
});

gulp.task('watch',function(){
    gulp.watch('index.html',['copy-html']);
    gulp.watch('src/sass/*.scss',['sass'])
});
//copy
gulp.task('copy-html',function(){
    gulp.src('index.html')
        .pipe(gulp.dest('dist'))
        .pipe(connect.reload());
});
//
gulp.task('server',function(){
    connect.server({
        root:'dist',
        livereload:true
    })
});
gulp.task('default',['server','watch']);

//concat

gulp.task('concat',function(){
    gulp.src('src/js/*.js').pipe(concat('index.js'))
        .pipe(gulp.dest('dist/js'))
        .pipe(uglify()).pipe(rename('index.min.js')).pipe(gulp.dest('dist/js'));
});






















