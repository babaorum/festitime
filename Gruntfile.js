module.exports = function (grunt) {
    /**
     * Déclaration, configuration des tâches,
     * l'ordre de déclaration n'a aucune importance
     */
    grunt.initConfig({

        /**
         * Configuration du plugin less
         * 2 sous tâches sont déclarées. 'less:dist' qui va compiler les fichiers less dans src/less/
         * dans le fichier 'dist/css/styles.css'. 'test:dist' qui va juste compiler le fichier file1.less
         */
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

        /**
         * Configuration du plugin concat
         * une seule tâche qui va concatener tous les fichiers situés dans 'src/js/'
         * dans un seul fichier 'dist/js/built.js'
         */
        concat: {
            dist: {
                src: ['./web/assets/js/*'],
                dest: './web/assets/dist/js/built.js'
            },
        },

        /**
         * Configuration du plugin uglify
         * une seule tâche qui va minimifier le fichier built.js
         * généré par la tâche précédente
         */
        uglify: {
            dist: {
                src: ['./web/assets/dist/js/built.js'],
                dest: './web/assets/dist/js/built.min.js'
            }
        },

        /**
         * Configuration du plugin watch
         * une seule tâche, qui va scruter le répertoire src
         * et si un fichier est modifié, va lancer la tâche 'default'
         */
        watch: {
            files: ['./web/assets/**'],
            tasks: ['default'],
        }
    });

    /**
     * Chargement des plugins Grunt
     */

    // plugin du préprocesseur less
    grunt.loadNpmTasks('grunt-contrib-less');

    // plugin pour concatener des fichiers
    grunt.loadNpmTasks('grunt-contrib-concat');

    // plugin pour minimifier les fichiers JS
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // plugin pour scruter les changements dans vos fichiers et lancer des tâches
    grunt.loadNpmTasks('grunt-contrib-watch');

    /**
     * Déclaration des tâches "groupées"
     * la tâche par default (en tapant juste 'grunt') lancera les tâches 'less:dist' 'concat' et 'uglify'
     * 'grunt watch-src' lancera les tâches 'default' puis 'watch' (l'ordre de déclaration est ici important)
     * 
     * le lancement de la tâche 'watch-src' ne vous rendra pas la main, mais grunt restera actif
     * pour scruter vos fichiers
     */
    grunt.registerTask('default', ['less:dist', 'concat', 'uglify']);
    grunt.registerTask('watch-src', ['default', 'watch']);

};
