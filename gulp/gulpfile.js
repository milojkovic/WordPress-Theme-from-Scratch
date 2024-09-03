const {src, dest, watch, series} = require('gulp');
const sass = require('gulp-sass')(require('sass')); // Install sass as a dev dependency `npm i -D sass` if dose'n work
const autoprefixer = require('autoprefixer')
const postcss = require('gulp-postcss')
const terser = require('gulp-terser');
const minify = require('gulp-clean-css');

//compile, prefix, and min scss
function compilescss() {
    return src('../assets/css/scss/*.scss') // change to your source directory
        .pipe(sass())
        .pipe(postcss([autoprefixer('last 2 versions')]))
        .pipe(minify())
        .pipe(dest('../assets/css')) // change to your final/public directory
};

// minify js
function jsmin() {
    return src('../assets/js/*.js') // change to your source directory
        .pipe(terser())
        .pipe(dest('../assets/js/dist')); // change to your final/public directory
}


//watchtask
function watchTask() {
    watch('../assets/css/scss/**/*.scss', compilescss); // change to your source directory
    watch('../assets/js/*.js', jsmin); // change to your source directory
}


// Default Gulp task 
exports.default = series(
    compilescss,
    jsmin,
    watchTask
);
