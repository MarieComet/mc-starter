/**
 * MC Starter Makefile
 */
'use strict';

module.exports = function( grunt ) {

	require( 'matchdep' ).filterDev( 'grunt-*' ).forEach( grunt.loadNpmTasks );
	var projectname = grunt.option('projectname') || 'projectname';

	// Project configuration.
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		sass: {
			dist: {
				options: {
				  includePaths: require('bourbon').includePaths
				},
				files: [ {
					expand: true,
					cwd: 'sass',
					src: '*.scss',
					dest: './',
					ext: '.css'
				} ]
			}
		},

		postcss: {
			dev: {
				options: {
					//map: true,

					processors: [
						require( 'autoprefixer' )( {
							browsers: 'last 3 versions'
						} )
					]
				},
				files: [ {
					src: [
						'*.css',
						'!*.min.css'
					]
				} ]
			},
			minify: {
				options: {
					processors: [
						require( 'autoprefixer' )( {
							browsers: 'last 3 versions'
						} ),
						require( 'cssnano' )()
					]
				},
				files: [ {
					expand: true,
					src: [
						'*.css',
						'!*.min.css'
					],
					ext: '.min.css'
				} ]
			}
		},

		watch: {
			styles: {
				files: [
					'sass/**/*.scss'
				],
				tasks: [ 'styles' ]
			},
			scripts: {
				files: [ 'js/main.js' ],
				tasks: [ 'scripts' ]
			}
		},

		uglify: {
			build: {
		    	src: 'js/main.js',
		    	dest: 'js/main.min.js'
			}
		},

		// copy theme in new directory
		copy: {
		    newfolder: {
		        expand: true,
		        dot: false,
		        src: ['**', '!.git', '!node_modules/**'],
		        dest: '../' + projectname + '/', 
		    },
		},

		// replay text in new directory
		replace: {
		    newfolder: {
		    	expand: true,
		        src: [ '../' + projectname + '/*', projectname + '/**/*' ],
		        overwrite: true,
		        replacements: [{
		                from: 'mcstarter',
		                to: projectname
		            }
		        ],
		    }
		}

	} );

	grunt.registerTask( 'styles', [
		'sass',
		'postcss'
	] );

	grunt.registerTask( 'scripts', [
		'uglify'
	] );

	// Default task(s).
	grunt.registerTask( 'default', [
		'styles',
		'scripts',
	] );

	grunt.registerTask( 'setup', [
		'copy',
		'replace'
	] );
};
