module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        uglify: {
            dist: {
                files: {
                    'js/script.min.js': 'js/script.js',
                    'js/modern.min.js': 'js/modern.js'
                }
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: 'img/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: 'img/'
                }]
            }
        },
        compass: {
           dist: { 
                 options: {
                   config: 'sass/config.rb'
             }
           },
        },
        watch: {
            scripts: {
                files: ['js/*.js'],
                tasks: ['uglify'],
                options: {
                    spawn: false,
                }
            },
            images: {
                files: ['img/**/*.{png,jpg,gif}'],
                tasks: ['newer:imagemin:dynamic'],
                options: {
                    spawn: false,
                }
            },
            sass: {
                files: ['sass/*.scss'],
                tasks: ['compass']
            },
            livereload: {
                files: ['css/*.css', '*.php', 'inc/*.php', 'js/*.js', '*.html'],
                options: { livereload: true }
            }
        }
    });

    require('load-grunt-tasks')(grunt);

    grunt.registerTask('default', ['uglify', 'imagemin', 'watch', 'compass']);

};