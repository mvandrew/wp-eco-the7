var gulp                = require("gulp"),
    replace             = require('gulp-replace'),
    imagemin            = require('gulp-imagemin'),
    imageminPngquant    = require('imagemin-pngquant'),
    cache               = require('gulp-cache'),
    plumber             = require('gulp-plumber'),
    notify              = require('gulp-notify'),
    stripCssComments    = require('gulp-strip-css-comments'),
    cssnano             = require("gulp-cssnano"),
    concat              = require('gulp-concat'),
    rename              = require('gulp-rename'),
    sass                = require("gulp-sass"),
    autoprefixer        = require("gulp-autoprefixer"),
    gcmq                = require('gulp-group-css-media-queries'),
    browserSync         = require('browser-sync'),
    reload              = browserSync.reload;


/**
 * Запуск браузера отслеживания изменений в коде
 */
gulp.task('browser-sync', function () {

    var workFiles           = [
        './**/*.php',
        './**/*.css',
        './js/**/*.js',
        './img/**/*.+(jpeg|jpg|gif|png|svg)',

        // Exclude system and core files
        '!./src/**/*',
        '!./node_modules/**/*'
    ];

    browserSync.init( workFiles, {
        proxy: {
            target: 'http://ecosaltlamps.ru/'
        },
        injectChanges: true
    } );
});



/**
 * Возвращает номер текущей версии пакета
 */
function get_version() {
    var fs = require("fs");
    var json = JSON.parse(fs.readFileSync("./package.json"));
    return json.version;
}


/**
 * Перенос файлов описания темы
 */
gulp.task( 'theme', function () {
    gulp.src('./src/theme/*.png')
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( cache(imagemin({
                interlaced: true,
                progressive: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [imageminPngquant()]
            }))
        )
        .pipe( gulp.dest( './') );

    return gulp.src( './src/theme/style.css' )
        .pipe( replace('%%version%%', get_version()) )
        .pipe( gulp.dest( './') );
});


/**
 * Формирование каталога с файлами Шрифтов
 */
gulp.task('fonts', function () {
    return gulp.src( './src/vendor/font-awesome/fonts/**/*.+(otf|eot|svg|ttf|woff|woff2)' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( gulp.dest('./fonts/') )
        .pipe( notify({ message: 'Fonts task complete', onLast: true }) );
});



/**
 * Формирование объединённого CSS файла из библиотек поставщиков
 */
gulp.task('vendor-css', function () {
    return gulp.src( [
        './src/vendor/font-awesome/css/font-awesome.css'
    ] )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( stripCssComments({preserve: false}) )
        .pipe( cssnano() )
        .pipe( concat('vendor-css.min.css') )
        .pipe( gulp.dest('./css/') )
        .pipe( notify({ message: 'Vendor styles task complete', onLast: true }) );
});



/**
 * Компиляция стилей оформления
 */
gulp.task('sass', function () {
    return gulp.src( './src/sass/**/*.scss' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( sass() )
        .pipe( autoprefixer(['last 15 versions', '> 1%', 'ie 8', 'ie 7'], { cascade: true }) )
        .pipe( gcmq() )
        .pipe( gulp.dest('./css/') )
        .pipe( cssnano() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./css/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Styles task complete', onLast: true }) );
});


gulp.task( 'watch', ['theme', 'fonts', 'vendor-css', 'sass', 'browser-sync'], function () {

    gulp.watch( './src/sass/**/*.scss', ['sass'] );

});

gulp.task("default", ["watch"]);
