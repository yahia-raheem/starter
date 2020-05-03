import { src, dest, watch, series, parallel } from "gulp";
import yargs from "yargs";
import sass from "gulp-sass";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import imagemin from "gulp-imagemin";
import webp from "gulp-webp";
import del from "del";
import webpack from "webpack-stream";
import named from "vinyl-named";
import zip from "gulp-zip";
import info from "./package.json";
import fileinclude from "gulp-file-include";
import replace from "gulp-replace";
import filter from "gulp-filter";
const PRODUCTION = yargs.argv.prod;

export const styles = () => {
  return src(["src/scss/bundle.scss", "src/scss/bundle-rtl.scss"])
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass().on("error", sass.logError))
    .pipe(gulpif(PRODUCTION, postcss([autoprefixer])))
    .pipe(gulpif(PRODUCTION, cleanCss({ compatibility: "ie8" })))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest("dist/css"));
};

export const scripts = () => {
  return src(["src/js/bundle.js", "src/js/bundle-rtl.js"])
    .pipe(named())
    .pipe(
      webpack({
        module: {
          rules: [
            {
              test: /\.js$/,
              use: {
                loader: "babel-loader",
                options: {
                  presets: ["@babel/preset-env"],
                },
              },
            },
          ],
        },
        mode: PRODUCTION ? "production" : "development",
        devtool: !PRODUCTION ? "inline-source-map" : false,
        output: {
          filename: "[name].js",
        },
      })
    )
    .pipe(dest("dist/js"));
};

export const images = () => {
  const webpless = filter("**/*.{jpg,jpeg,png,svg,gif}", { restore: true });
  return src("src/images/**/*.{jpg,jpeg,png,svg,gif,webp}")
    .pipe(gulpif(PRODUCTION, imagemin()))
    .pipe(webpless)
    .pipe(webp({ quality: 100, method: 6 }))
    .pipe(webpless.restore)
    .pipe(dest("dist/images"));
};

export const copy = () => {
  return src([
    "src/**/*",
    "!src/{images,js,scss,html}",
    "!src/{images,js,scss,html}/**/*",
  ]).pipe(dest("dist"));
};

export const html = () => {
  return src("src/html/*.html")
    .pipe(
      fileinclude({
        prefix: "@@",
        basepath: "@file",
      })
    )
    .pipe(replace(/.(gif|jpe?g|svg|png)\"/g, ".webp\""))
    .pipe(dest("dist/html"));
};

export const clean = () => del(["dist"]);

export const compress = () => {
  return src([
    "**/*",
    "!node_modules{,/**}",
    "!bundled{,/**}",
    "!src{,/**}",
    "!.babelrc",
    "!.gitignore",
    "!gulpfile.babel.js",
    "!package.json",
    "!package-lock.json",
  ])
    .pipe(zip(`${info.name}-${info.version}.zip`))
    .pipe(dest("bundled"));
};

export const watchForChanges = () => {
  watch("src/scss/**/*.scss", styles);
  watch("src/images/**/*.{jpg,jpeg,png,svg,gif}", images);
  watch(
    ["src/**/*", "!src/{images,js,scss}", "!src/{images,js,scss}/**/*"],
    copy
  );
  watch("src/js/**/*.js", scripts);
  watch("./src/html/**/*.html", html);
};

export const dev = series(
  clean,
  parallel(styles, images, copy, scripts),
  html,
  watchForChanges
);
export const build = series(
  clean,
  parallel(styles, images, copy, scripts),
  html,
  compress
);
export default dev;
