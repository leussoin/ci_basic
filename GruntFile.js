let src_js = 'src/js/';
let dest_js = 'assets/js/';
let src_sass = 'src/sass';
let dest_css = 'assets/css/';
let extra_dir = 'src/extra/';

module.exports = function(grunt) {
    require('load-grunt-tasks');

    grunt.loadNpmTasks('grunt-eslint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.initConfig({
        eslint: {
            options: {
                configFile: '.eslintrc',
                fix: true,
                maxWarnings: -1
            },
            src: [src_js + '*.js', '!' + extra_dir]
        },
        uglify: {
            src: {
                files: [{
                    expand: true,
                    cwd: src_js,
                    src: ['*.js', '!' + extra_dir],
                    dest: dest_js,
                    ext: '.min.js'
                }]
            }
        },
        concat: {
            extrajs: {
                src: [extra_dir + 'js/*.js', extra_dir + 'js/*.min.js'],
                dest: dest_js + 'extra.bundle.js',
            },
            extracss: {
                src: [extra_dir + 'css/*.css', extra_dir + 'js/*.min.css'],
                dest: dest_css + 'extra.bundle.css',
            }
        }
    });

    grunt.registerTask('pre-commit', 'eslint');
    grunt.registerTask('build', ['eslint', 'uglify', 'concat']);
}