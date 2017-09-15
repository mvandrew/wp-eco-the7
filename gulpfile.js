var gulp                = require("gulp"),
    replace             = require('gulp-replace'),
    imagemin            = require('gulp-imagemin'),
    imageminPngquant    = require('imagemin-pngquant'),
    cache               = require('gulp-cache'),
    plumber             = require('gulp-plumber'),
    notify              = require('gulp-notify');


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