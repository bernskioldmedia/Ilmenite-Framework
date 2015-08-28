var gulp 		= require('gulp');
var concat 		= require('gulp-concat');
var imagemin 	= require('gulp-imagemin');
var jshint 		= require('gulp-jshint');
var livereload 	= require('gulp-livereload');
var notify 		= require('gulp-notify');
var plumber 	= require('gulp-plumber');
var rename 		= require("gulp-rename");
var sass 		= require('gulp-sass');
var sort 		= require('gulp-sort');
var sourcemaps 	= require("gulp-sourcemaps");
var uglify 		= require('gulp-uglify');
var wpPot 		= require('gulp-wp-pot');

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
		'assets/js/src/plugins/foundation/foundation.js',
		'assets/js/src/main.js'
	])
		.pipe(plumber(plumberErrorHandler))
		.pipe(jshint())
		.pipe(jshint.reporter('fail'))
		.pipe(concat('theme.js'))
		.pipe(gulp.dest('assets/js'))
		.pipe(livereload());

});

// Uglify JavaScript
gulp.task('compress',  function() {
  return gulp.src('assets/js/*.js')
  	.pipe(plumber(plumberErrorHandler))
  	.pipe(sourcemaps.init())
  	.pipe(concat("theme.js"))
  	.pipe(gulp.dest("assets/js"))
  	.pipe(rename("theme.min.js"))
  	.pipe(uglify())
  	.pipe(sourcemaps.write("./"))
  	.pipe(gulp.dest("assets/js"));
});

// Image Minifcation
gulp.task('img', function() {

	return gulp.src('assets/images/*.{png,jpg,gif}')

	.pipe(plumber(plumberErrorHandler))

    .pipe(imagemin({
      optimizationLevel: 7,
      progressive: true
    }))

    .pipe(gulp.dest('assets/images'));

});

// WordPress POT Files
gulp.task('pot', function() {

	return gulp.src('*.php')
	        .pipe(sort())
	        .pipe(wpPot( {
	            domain: 'TEXTDOMAIN',
	            destFile:'languages/TEXTDOMAIN.pot',
	            package: 'TEXTDOMAIN',
	            bugReport: 'http://www.bernskioldmedia.com',
	            lastTranslator: 'Bernskiold Media <info@bernskioldmedia.com>',
	            team: 'Bernskiold Media <info@bernskioldmedia.com>'
	        } ))
	        .pipe(gulp.dest('dist'));

});

// Watch...
gulp.task('watch', function() {

	livereload.listen();

	gulp.watch('assets/scss/**/*.scss', ['sass']);

	gulp.watch('assets/js/src/*.js', ['js', 'compress']);

	gulp.watch('assets/images/*.{png,jpg,gif}', ['img']);

});

gulp.task('default', ['sass', 'js', 'img', 'concat']);