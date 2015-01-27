module.exports = function (grunt) {
    
    grunt.initConfig({

        less: {
            dist: {
                src: ['./web/assets/less/*'],
                dest: './web/assets/dist/css/styles.css'
            },

            test: {
                src: ['./web/assets/less/file1.less'],
                dest: './web/assets/dist/css/file1.css'
            }
        },

        cssmin: {
            dist: {
                src: ['./web/assets/dist/css/styles.css'],
                dest: './web/assets/dist/css/styles.min.css'
            }
        },

        concat: {
            dist: {
                src: ['./web/assets/js/app/**'],
                dest: './web/assets/dist/js/built.js'
            },
        },

        uglify: {
            dist: {
                src: ['./web/assets/dist/js/built.js'],
                dest: './web/assets/dist/js/built.min.js'
            }
        },

        'sf2-cache-clear': {
            options: {},
            clear_all: {
                cmd: 'cache:clear'
            }
        },

        watch: {
            files: ['./web/assets/**'],
            tasks: ['default'],
        }
    });

    /**
     * loading Grunt plugins
     */

    // plugin less preprocessor
    grunt.loadNpmTasks('grunt-contrib-less');

    // plugin for minify css files
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // plugin for concat files
    grunt.loadNpmTasks('grunt-contrib-concat');

    // plugin for minify js files
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // plugin for using symfony2 console's commands
    grunt.loadNpmTasks('grunt-symfony2');

    // plugin for watching for change and play tasks
    grunt.loadNpmTasks('grunt-contrib-watch');

    /**
     * Declaration of grouped tasks
     * the default task (when just tiping 'grunt') will load tasks 'less:dist', 'cssmin', 'concat' and 'uglify'
     * 'grunt watch-src' will load task 'default' then 'watch' (the declaration order is important)
     * 
     * task 'watch-src' will not stop, but grunt will stay active
     * to see any possible change
     */
    grunt.registerTask('default', ['less:dist', 'cssmin', 'concat', 'uglify', 'sf2-cache-clear:clear_all']);
    grunt.registerTask('watch-src', ['default', 'watch']);

};
