/**
 * Gulpfile.js
 */

// Load the Gulp modules.
var gulp 			= require('gulp');
var autoprefixer 	= require('gulp-autoprefixer');
var babel 			= require("gulp-babel");
var concat 			= require('gulp-concat');
var imagemin 		= require('gulp-imagemin');
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

// Set files to be processed
var processFiles = {
	scripts: [
		'assets/js/src/vendor/iconic.min.js',
		'assets/js/src/vendor/foundation/foundation.core.js',
		'assets/js/src/vendor/foundation/foundation.util.*.js',
		'assets/js/src/main.js'
	],
	styles: [
		'assets/scss/main.scss'
	],
	images: [
		'assets/images/**/*'
	]
}

// Styles
gulp.task('styles', function() {

	return gulp.src(processFiles.styles)
		.pipe(plumber(plumberErrorHandler))
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(autoprefixer({
			browsers: [
				'> 1%',
				'last 2 versions'
			],
			cascade: false
		}))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('assets/css'))
		.pipe(plumber.stop())
		.pipe(livereload())
		.pipe(notify({
			message: 'Styles Task Completed!'
		}));

});

// Scripts
gulp.task('scripts', function() {

	return gulp.src(processFiles.scripts)
		.pipe(plumber(plumberErrorHandler))
		.pipe(sourcemaps.init())
		.pipe(babel())
		.pipe(concat('theme.js'))
		.pipe(gulp.dest('assets/js'))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('assets/js'))
		.pipe(plumber.stop())
		.pipe(livereload())
		.pipe(notify({
			message: 'Scripts Task Completed!'
		}));

});

// Images
gulp.task('images', function() {
  return gulp.src(processFiles.images)
  	.pipe(plumber(plumberErrorHandler))
    .pipe(imagemin({
    	optimizationLevel: 3,
    	progressive: true,
    	interlaced: true
    }))
    .pipe(livereload())
    .pipe(gulp.dest('assets/images'))
    .pipe(notify({
    	message: 'Images Task Completed'
    }));
});

// Watch...
gulp.task('watch', function() {

	livereload.listen();

	// Watch .scss files
	gulp.watch('assets/scss/**/*.scss',  ['styles']);

	// Watch .js files
	gulp.watch('assets/js/src/**/*.js', ['scripts']);

});

// Define Default Task
gulp.task( 'default', [ 'styles', 'scripts', 'images' ] );