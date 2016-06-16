/*global module:false*/
module.exports = function (grunt) {
    // Load plugins. Run npm install to install these according to package.json
    grunt.loadNpmTasks('grunt-composer');

    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        composer: {
            options: {}
        },
    });

    grunt.registerTask('default', ['composer:install']);
};
