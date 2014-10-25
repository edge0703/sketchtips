module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        uglify: {
            dist: {
                files: {
                    'assets/js/script.min.js': 'assets/js/script.js',
                    'assets/js/modern.min.js': 'assets/js/modern.js'
                }
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'assets/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'assets/images/'
                }]
            }
        },
        compass: {
           dist: { 
                 options: {
                   config: 'assets/sass/config.rb'
             }
           },
        },
        svgmin: {
            options: {
               plugins: [{
                   removeViewBox: false
               }, {
                   removeUselessStrokeAndFill: false
               }, {
                   convertPathData: {
                       straightCurves: false
                   }
               }, {
                   collapseGroups: false
               }, {
                   convertTransform: false
               }, {
                   moveGroupAttrsToElems: false
               }]
            },
            dist: {
               files: [{
                   expand: true,
                   cwd: 'assets/images/',
                   src: ['assets/images/*.svg'],
                   dest: 'assets/images/'
               }]
            }
        },
        pixrem: {
            options: {
                rootvalue: '1em'
            },
            dist: {
                src: 'assets/css/style.css',
                dest: 'assets/css/style.css'
            }
        },
        watch: {
            scripts: {
                files: ['assets/js/*.js'],
                tasks: ['uglify'],
                options: {
                    spawn: false,
                }
            },
            svg: {
               tasks: ['newer:svgmin:dist'],
               files: ["assets/images/*.svg"]
           },
            images: {
                files: ['assets/images/**/*.{png,jpg,gif}'],
                tasks: ['newer:imagemin:dynamic'],
                options: {
                    spawn: false,
                }
            },
            sass: {
                files: ['assets/sass/*.scss'],
                tasks: ['compass']
            },
            livereload: {
                files: ['assets/css/*.css', 'site/**/*.php', 'assets/js/*.js'],
                options: { livereload: true }
            }
        }
    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('default', ['uglify', 'imagemin', 'watch', 'compass', 'svgmin']);

};