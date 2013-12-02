/*jshint camelcase:false */
module.exports = function(grunt) {
    "use strict";

    grunt.initConfig({
        uglify: {
            minprod: {
                files: {
                    'js/minified.js': [
                        'js/jquery.js',
                        'js/modernizr.js',
                        'js/plugins.js',
                        'js/script.js'
                    ]
                }
            }
        },

        cssmin: {
            minprod: {
                files: {
                    'css/minified.css': [
                        'css/bootstrap.css',
                        'css/bootstrap-responsive.css',
                        'css/control.css',
                        'css/plugin.css',
                        'css/style.css',
                        'css/style-responsive.css'
                    ]
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    //grunt.registerTask('mocha', ['mochaTest']);

    // Default task.
    //grunt.registerTask('default', ['test']);
};