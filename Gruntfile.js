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
                    ],

                    'fbgallery_files/minified.js': [
                        'fbgallery_files/jquery.js',
                        'fbgallery_files/jquery.wookmark.js',
                        'fbgallery_files/jquery.capty.js'
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
                    ],

                    'fbgallery_files/minified.css': [
                        'fbgallery_files/bootstrap.css',
                        'fbgallery_files/masonry.css',
                        'fbgallery_files/jquery.capty.css'
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