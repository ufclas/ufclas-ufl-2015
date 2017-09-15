module.exports = function(grunt){
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),	
		
		/**
		 * Combine already minified JS from plugins folder
		 */
		concat: {
            options: {
            },
            dist: {
                src: [
                    'js/plugins/iframe-resizer.min.js',
					'js/plugins/jquery.hoverIntent.min.js',
					'js/plugins/js.cookie.min.js',
					'js/plugins/slick.min.js',
					'js/plugins/modernizr.min.js',
					'js/plugins/svg4everybody.min.js',
					'js/plugins/smartresize-debounce.js',
					'js/plugins/smooth-scrolling.js',
					'js/plugins/velocity.min.js',
					'js/plugins/velocity.ui.min.js'
                ],
                dest: 'js/plugins.min.js'
            }
        },
		
		/**
		 * Minify and custom JS
		 */
		 uglify: {
            options: {
                banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %> */',
                sourceMap: true
            },
            dist: {
                files: {
                    'js/scripts.min.js': ['js/scripts.js'],
                    'js/customizer.min.js': ['js/customizer.js'],
                }
            }
        },
        
		/**
		 * Lint JS
		 */
        jshint: {
            all: ['Gruntfile.js', 'js/*.js', '!js/*.min.js'],
            options: {
                globals: {
                    jQuery: true
                }
            }
        },
		
		/**
		 * Sass tasks
		 */
		 sass: {
			dist: {
				options: {
					style: 'compressed'
				},
				files: {
					'./style.css' : 'sass/style.scss',
					'./editor-style.css' : 'sass/editor-style.scss'	
				}	
			}	 
		 },
		 
		 /**
		 * Autoprefixer
		 */
		 postcss: {
			options: {
				map: {
					inline: false	
				},
				processors: [
					require('autoprefixer')({browsers: ['last 2 versions']})
				]
			},
			// prefix all css files in the project root
			dist: {
				src: './*.css'
			}	 
		 },
		
		/**
		 * Watch task
		 */
		 watch: {
			grunt: {
				files: ['Gruntfile.js'],
				options: {
					reload: true
				}
			},
			css: {
				files: ['./sass/*.scss'],
				tasks: ['sass', 'postcss']
			},
			js: {
				files: ['js/*.js', '!node_modules/*'],
				tasks: ['concat', 'uglify', 'jshint']
			} 
		 }
	});
	
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-sass');
	grunt.registerTask('default',['watch']);
};