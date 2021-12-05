const path         = require('path');
const gulp         = require('gulp');
const gulputil     = require('gulp-util');
const gulpif       = require('gulp-if');
const del          = require('del');
const rename       = require('gulp-rename');
const sourcemaps   = require('gulp-sourcemaps');
const browserSync  = require('browser-sync').create();
const webpack      = require('webpack-stream');
const postcss      = require('gulp-postcss');
const scss         = require('gulp-sass')(require('sass'));


const proxyUrl = 'pineapple.my';


const root = './static/';
const devFolder  = './src/';
const prodFolder = './dist/';

// devFolder +
const scriptsFolder = 'js/';
const stylesFolder  = 'scss/';

// devFolder + scriptsFolder
// devFolder + stylesFolder
const scriptsFiles = [
    'index.page.js',
];
const stylesFiles = [
    'index.page.scss',
];


const isDev  = gulputil.env.mode === 'development';


function scripts() {
    if (scriptsFiles.length === 0) {
        return gulp;
    }

    const entries = {};

    scriptsFiles.forEach((filename) => {
        let filenameName = filename;
        filenameName = filenameName.replace(/\.js$/, '');
        filenameName = filenameName.replace(/\.page$/, '');

        const name = `${scriptsFolder}${filenameName}`;
        const file = `${devFolder}${scriptsFolder}${filename}`;

        entries[name] = file;
    });

    return gulp.src('.')
        .pipe(webpack({
            mode: isDev ? 'development' : 'production',
            entry: entries,
            output: {
                filename: '[name].bundle.js',
            },
            resolve: {
                alias: {
                    '~root': path.resolve(
                        __dirname,
                        `${devFolder}${scriptsFolder}`
                    ),
                    '~modules': path.resolve(
                        __dirname,
                        `${devFolder}${scriptsFolder}modules/`
                    ),
                },
            },
            devtool: isDev ? 'source-map' : false,
            module: {
                rules: [{
                    test: /\.js/,
                    exclude: /node_modules/,
                    use: {
                        loader: 'babel-loader',
                    },
                }],
            },
        }))
        .pipe(gulp.dest(`${prodFolder}`))
        .pipe(browserSync.stream());
}


function styles() {
    if (stylesFiles.length === 0) {
        return gulp;
    }

    const entryFiles = stylesFiles.map((filename) => (
        `${devFolder}${stylesFolder}${filename}`
    ));

    return gulp.src(entryFiles, { base: `${devFolder}` })
        .pipe(gulpif(isDev, sourcemaps.init()))
        .pipe(scss())
        .pipe(postcss())
        .pipe(rename((filepath) => {
            let { dirname, basename, extname }  = filepath;

            dirname = dirname.replace('scss', 'css');
            basename = basename.replace('.page', '');
            basename += '.bundle';

            return { dirname, basename, extname };
        }))
        .pipe(gulpif(isDev, sourcemaps.write()))
        .pipe(gulp.dest(`${prodFolder}`))
        .pipe(browserSync.stream());
}


function watch() {
    gulp.watch(`${devFolder}${scriptsFolder}**/*.js`, scripts);
    gulp.watch(`${devFolder}${stylesFolder}**/*.scss`, styles);
    gulp.watch(`${root}**/*.html`).on('change', browserSync.reload);
}


function startStream() {
    browserSync.init({
        proxy: proxyUrl,
        // port: 22,
        notify: false,
        online: true,
    });
}


function clean() {
    return del([`${prodFolder}*`]);
}


exports.build = gulp.series(
    clean, gulp.parallel(scripts, styles)
);

exports.watch = gulp.series(
    clean, gulp.parallel(scripts, styles, watch)
);

exports.stream = gulp.series(
    clean, gulp.parallel(scripts, styles, startStream, watch)
);
