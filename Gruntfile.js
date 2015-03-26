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
                src: ['./web/assets/js/app/*/*/module.js', './web/assets/js/app/**'],
                dest: './web/assets/dist/js/built.js'
            }
        },

        ngAnnotate: {
            dist: {
                src: ['./web/assets/dist/js/built.js'],
                dest: './web/assets/dist/js/built.js'
            }
        },

        uglify: {
            dist: {
                src: ['./web/assets/dist/js/built.js'],
                dest: './web/assets/dist/js/built.min.js'
            }
        },

        shell: {
            removeSymfonyCache: {
                command: 'rm -rf ./app/cache'
            }
        },

        watch: {
            files: ['./web/assets/**'],
            tasks: ['default'],
        }
    });

    grunt.registerTask('blueprint2json', 'Generate js version of apiary file.', function () {
        var done = this.async();
        var parser = require('protagonist');
        var content = grunt.file.read('API.md');

        parser.parse(content, function (error, result) {
            if (error) {
                console.log(error);
                return;
            }
            var json = JSON.stringify(result.ast);
            grunt.file.write('web/assets/blueprint/blueprint.json', json);
        done();
        });
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

    // plugin for annotate AngularJS files
    grunt.loadNpmTasks('grunt-ng-annotate');

    // plugin for minify js files
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // plugin for using shell commands
    grunt.loadNpmTasks('grunt-shell');

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
    grunt.registerTask('default', ['less:dist', 'cssmin', 'concat', 'ngAnnotate', 'uglify', 'shell:removeSymfonyCache']);
    grunt.registerTask('watch-src', ['default', 'watch']);

};
