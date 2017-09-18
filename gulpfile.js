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
    reload              = browserSync.reload,
    wpPot               = require('gulp-wp-pot'),
    sort                = require('gulp-sort'),
    uglify              = require('gulp-uglify'),
    stripComments       = require('gulp-strip-comments'), // Удаление js комментариев
    coffee              = require('gulp-coffee');


/**
 * Компиляция coffee-script файлов
 */
gulp.task('coffee', function() {
    gulp.src( './src/coffee/**/*.coffee' )
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( coffee({bare: true}) )
        .pipe( gulp.dest('./js/') )
        .pipe( uglify() )
        .pipe( rename({suffix: '.min'}) )
        .pipe( gulp.dest('./js/') )
        .pipe( reload({stream:true}) )
        .pipe( notify({ message: 'Javascript task complete', onLast: true }) );
});



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
 * Формирование файла переводов родительской темы,
 * ибо эта поделака по неведомой причине нормально
 * не локализована.
 */
gulp.task( 'makepot-parent', function () {
    return gulp.src( '../dt-the7/**/*.php' )
        .pipe(sort())
        .pipe(wpPot({
            domain: 'presscore',
            destFile: 'presscore.pot',
            package: 'The7',
            team: 'Andrey Mishchenko <msav@msav.ru>'
        }))
        .pipe(gulp.dest('../dt-the7/languages/presscore.pot'));
} );


/**
 * Формирование файла переводов текущей темы.
 */
gulp.task( 'makepot', function () {
    return gulp.src( './**/*.php' )
        .pipe(sort())
        .pipe(wpPot({
            domain: 'eco-the7',
            destFile: 'eco-the7.pot',
            package: 'Eco The7',
            team: 'Andrey Mishchenko <msav@msav.ru>'
        }))
        .pipe(gulp.dest('./languages/eco-the7.pot'));
} );


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
 * Сборка скриптов поставщиков
 */
gulp.task('vendor-js', function () {
    return gulp.src([
        './src/vendor/matchHeight/dist/jquery.matchHeight-min.js'
        ])
        .pipe( plumber({ errorHandler: function(err) {
            notify.onError({
                title: "Gulp error in " + err.plugin,
                message:  err.toString()
            })(err);
        }}) )
        .pipe( stripComments() )
        .pipe( concat('vendor-js.min.js') )
        .pipe( uglify() )
        .pipe( gulp.dest('./js/') )
        .pipe( notify({ message: 'Vendor Javascripts task complete', onLast: true }) );
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


gulp.task( 'watch', ['makepot', 'theme', 'fonts', 'vendor-css', 'vendor-js', 'sass', 'coffee', 'browser-sync'], function () {

    gulp.watch( './src/sass/**/*.scss', ['sass'] );
    gulp.watch( './src/coffee/**/*.coffee', ['coffee'] );

});

gulp.task("default", ["watch"]);
