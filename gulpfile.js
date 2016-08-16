var gulp 			= require('gulp');
var autoprefixer 	= require('gulp-autoprefixer');
var concat 			= require('gulp-concat');
var imagemin 		= require('gulp-imagemin'),
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

// Styles
gulp.task('styles', function() {

	return gulp.src('assets/scss/main.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(autoprefixer({
			browsers: [
				'last 2 versions'
			],
			cascade: false
		}))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('assets/css'))
		.pipe(livereload());
		.pipe(notify({
			message: 'Styles Task Completed!'
		}));

});

// Scripts
gulp.task('scripts', function() {

	var scripts = [
		'assets/js/src/plugins/iconic.min.js',
		'assets/js/src/plugins/foundation/foundation.core.js',
		'assets/js/src/plugins/foundation/foundation.util.*.js',
		'assets/js/src/main.js'
	];

	return gulp.src(scripts)
		.pipe(sourcemaps.init())
		.pipe(concat('theme.js'))
		.pipe(gulp.dest('assets/js'))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('assets/js'))
		.pipe(livereload())
		.pipe(notify({
			message: 'Scripts Task Completed!'
		}));

});

// Images
gulp.task('images', function() {
  return gulp.src('assets/images/**/*')
    .pipe(cache(imagemin({
    	optimizationLevel: 3,
    	progressive: true,
    	interlaced: true
    })))
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
	gulp.watch('assets/scss/**/*.scss', function(event) {
		console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		gulp.run('styles');
	});

	// Watch .js files
	gulp.watch('assets/js/src/**/*.js', function(event) {
		console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		gulp.run('scripts');
	});

	// Watch image files
	gulp.watch('assets/images/**/*', function(event) {
		console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		gulp.run('images');
	});

});

// Define Default Task
gulp.task( 'default', [ 'styles', 'scripts', 'images' ] );