var gulp 			= require('gulp');
var autoprefixer 	= require('gulp-autoprefixer');
var concat 			= require('gulp-concat');
var jshint 			= require('gulp-jshint');
var livereload 		= require('gulp-livereload');
var notify 			= require('gulp-notify');
var plumber 		= require('gulp-plumber');
var rename 			= require("gulp-rename");
var sass 			= require('gulp-sass');
var sort 			= require('gulp-sort');
var sourcemaps 		= require("gulp-sourcemaps");
var uglify 			= require('gulp-uglify');

// Handle Errors
var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
  })
};

// SASS
gulp.task('sass', function () {

    return gulp.src('assets/scss/layout.scss')
    	.pipe(plumber(plumberErrorHandler))
    	.pipe(sass({outputStyle: 'compressed'}))
    	.pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest('assets/css'))
        .pipe(livereload());

});

// JavaScript
gulp.task('js', function () {

	return gulp.src([
		'assets/js/src/plugins/iconic.min.js',
		'assets/js/src/plugins/foundation/foundation.core.js',
		'assets/js/src/plugins/foundation/foundation.util.*.js',
		'assets/js/src/main.js'
	])
		.pipe(plumber(plumberErrorHandler))
		.pipe(sourcemaps.init())
		.pipe(concat("theme.js"))
		.pipe(gulp.dest("assets/js"))
		.pipe(rename("theme.min.js"))
		.pipe(uglify())
		.pipe(sourcemaps.write("./"))
		.pipe(gulp.dest("assets/js"))
		.pipe(livereload());

});

// Watch...
gulp.task('watch', function() {

	livereload.listen();

	gulp.watch('assets/scss/**/*.scss', ['sass']);

	gulp.watch('assets/js/src/*.js', ['js']);

});

gulp.task('default', ['sass', 'js', 'concat']);