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
                tasks: ['imagemin'],
                options: {
                    spawn: false,
                }
            },
            sass: {
                files: ['sass/*.scss'],
                tasks: ['compass']
            },
            livereload: {
                files: ['css/*.css', '*.php', 'inc/*.php', 'js/*.js'],
                options: { livereload: true }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-compass');

    grunt.registerTask('default', ['uglify', 'imagemin', 'watch', 'compass']);

};