module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		uglify: {
			build: {
				src: 'assets/js/main.js',
				dest: 'assets/js/main.min.js'
			}
		},

		pot: {
	      options:{
	          text_domain: 'TEXTDOMAINTHEMENAME', // Your text domain. Produces my-text-domain.pot
	          dest: 'languages/', //directory to place the pot file
	          keywords: [ //WordPress localisation functions
	            '__:1',
	            '_e:1',
	            '_x:1,2c',
	            'esc_html__:1',
	            'esc_html_e:1',
	            'esc_html_x:1,2c',
	            'esc_attr__:1',
	            'esc_attr_e:1',
	            'esc_attr_x:1,2c',
	            '_ex:1,2c',
	            '_n:1,2',
	            '_nx:1,2,4c',
	            '_n_noop:1,2',
	            '_nx_noop:1,2,3c'
	           ],
	      },
	      files:{
	          src:  [ '**/*.php' ], //Parse all php files
	          expand: true,
	      }
		},

		autoprefixer: {
         dist: {
            files: {
               'assets/css/layout.css': 'assets/css/layout.css'
            }
         }
      },

		sass: {
			dist: {
				options: {
					style: 'compressed',
					sourcemap: true,
				},
				files: {
					'assets/css/layout.css': 'assets/scss/layout.scss'
				}
			}
		},

		watch: {
			options: {
				livereload: true,
			},
			scripts: {
				files: ['assets/js/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false,
				}
			},
			css: {
				files: [
					'assets/scss/*.scss',
				],
				tasks: [ 'sass', 'autoprefixer' ],
				options : {
					spawn: false,
				}
			}
		},

	});

	// Load Plugins
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-pot');

	// Run!
	grunt.registerTask('default', ['sass', 'uglify', 'watch']);

}