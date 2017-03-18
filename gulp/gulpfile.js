/**
 * Created by apple on 17/3/18.
 */
var gulp = require('gulp');
gulp.task('test',function(){
    console.log('aaa');
});
gulp.task('test1',function(){
    console.log('bbb');
});
gulp.task('test3',['test','test1']);
//copy
gulp.task('copy-html',function(){
    gulp.src('index.html').pipe(gulp.dest('dist'));
});
//copy img
gulp.task('copy-img',function(){
    gulp.src(['src/images/**/*.{jpg,png}','!src/images/prev.png']).pipe(gulp.dest('dist/img'));
});











