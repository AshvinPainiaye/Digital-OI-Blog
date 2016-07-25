module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        //Configuration for watch
        watch: {
            //watch all changes on any css files
            //and reload the page when they changed
            front: {
                files: ['css/**/*.css','**/*.html','**/*.js','!**/node_modules/**'],
                options: {
                    livereload: true,
                },
            },
            scss: {
                files: 'scss/**/*.scss',
                tasks: ['sass']
            },
        },
        sass: {
            dev: {
                src: ['scss/*.scss'],
                dest: 'css/main.css',
            },
        },
    });

    // Load the plugin that provides the "watch" task.
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Load the plugin that provides the "sass watch" task.
    grunt.loadNpmTasks('grunt-contrib-sass');


    // Default task(s).
    grunt.registerTask('default',['watch']);

};
