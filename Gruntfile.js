/*global module:false*/
module.exports = function(grunt) {
    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        shell: {
            theme_npm_install: {
                command: 'npm install',
                options: {
                    execOptions: {
                        cwd: '<%= pkg.themesPath %>/<%= pkg.domain %>/'
                    }
                }
            },
            theme_bower_install: {
                command: 'bower install',
                options: {
                    execOptions: {
                        cwd: '<%= pkg.themesPath %>/<%= pkg.domain %>/'
                    }
                }
            },
            wordpress_download: {
                command: 'wp core download --force'
            }
        },

        // Setup filesystem
        // environment specific configs will override all default configs
        // see documentation: https://github.com/viastudio/grunt-via-filesystem
        via_filesystem: {
            default: {
                symLinks: [
                ],
                dirs: [
                    {
                        path: 'wp-content/uploads',
                        permissions: '0777'
                    },
                ]
            },
            dev: {
                symLinks: [
                    {
                        src: '/var/www/<%= pkg.name %>/wp-content/uploads',
                        dest: 'wp-content/uploads'
                    },
                    {
                        src: 'wp-via-config.php',
                        dest: 'wp-config.php'
                    },
                    {
                        src: '',
                        dest: 'webroot'
                    }
                ]
            },
            stage: {
                symLinks: [
                    {
                        src: 'robots.stage.txt',
                        dest: 'robots.txt'
                    }
                ]
            },
            prod: {
                symLinks: [
                    {
                        src: 'robots.prod.txt',
                        dest: 'robots.txt'
                    }
                ]
            }
        },

        hub: {
            // Build for stage/prod
            build: {
                src: ['<%= pkg.themesPath %>/*/Gruntfile.js']
            }
        }
    });

    // Load plugins. Run npm install to install these according to package.json
    grunt.loadNpmTasks('grunt-hub');
    grunt.loadNpmTasks('grunt-shell');
    grunt.loadNpmTasks('grunt-via-filesystem');

    grunt.registerTask('default', ['shell:theme_npm_install', 'shell:theme_bower_install', 'hub:build']); // Default task - executes when you run grunt
    grunt.registerTask('setup', ['shell:wordpress_download', 'shell:theme_npm_install', 'shell:theme_bower_install', 'via_filesystem']);
};
