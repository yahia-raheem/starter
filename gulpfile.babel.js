import { src, dest, watch, series, parallel } from "gulp";
import yargs from "yargs";
import sass from "gulp-sass";
import cleanCss from "gulp-clean-css";
import gulpif from "gulp-if";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import autoprefixer from "autoprefixer";
import imagemin from "gulp-imagemin";
import del from "del";
import webpack from "webpack-stream";
import named from "vinyl-named";
import zip from "gulp-zip";
import info from "./package.json";
import fileinclude from "gulp-file-include";
import replace from "gulp-replace";
import cssnano from "cssnano";
import Fiber from "fibers";
import scrape from 'website-scraper';
import purgecss from 'gulp-purgecss';
import safelist from './purgecss.safelist'

const PRODUCTION = yargs.argv.prod;
sass.compiler = require('sass');

export const extractHtml = (c) => {
  return scrape({
    urls: [`${info.link}`],
    directory: 'dist/extracted',
    recursive: true,
    maxRecursiveDepth: 2,
    sources: [
      {}
    ]
  }, c);
};

export const styles = () => {
  return src(["src/scss/bundle.scss", "src/scss/bundle-rtl.scss"])
    .pipe(gulpif(!PRODUCTION, sourcemaps.init()))
    .pipe(sass({ fiber: Fiber }).on("error", sass.logError))
    .pipe(gulpif(PRODUCTION, cleanCss({ level: 0 })))
    .pipe(gulpif(PRODUCTION, postcss([cssnano({ preset: 'advanced' })])))
    .pipe(gulpif(!PRODUCTION, sourcemaps.write()))
    .pipe(dest("dist/css"));
};

export const stylePurge = () => {
  return src(['dist/css/**/*.css'])
    .pipe(gulpif(PRODUCTION, purgecss({
      content: ['dist/extracted/**/*.html', 'dist/js/**/*.js'],
      safelist: {
        standard: [...safelist.whitelist],
        deep: [...safelist.whitelistPatterns]
      }
    })))
    .pipe(dest("dist/css"))
}

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
        devtool: false,
        output: {
          filename: "[name].js",
        },
        externals: {
          jquery: 'jQuery',
        },
      })
    )
    .pipe(dest("dist/js"));
};



export const images = () => {
  return src("src/images/**/*.{jpg,jpeg,png,svg,gif}")
    .pipe(gulpif(PRODUCTION, imagemin()))
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
  return src(["src/html/*.html", "!src/html/*.part.html"])
    .pipe(
      fileinclude({
        prefix: "@@",
        basepath: "@file",
      })
    )
    .pipe(dest("dist/html"));
};

export const phpMigrate = (cb) => {
  let file = yargs.argv.file;
  if (file) {
    return src(file)
      .pipe(
        fileinclude({
          prefix: "@@",
          basepath: "@file",
        })
      )
      .pipe(replace('="../', "=\"<?php bloginfo('template_directory'); ?>/dist/"))
      .pipe(dest(function (file) { return file.base; }));
  } else {
    console.log('no file provided ... use --file= + file path to use this function');
    cb();
  }
};

export const clean = () => del(["dist"]);
export const extractClean = () => del(["dist/extracted"]);

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
    .pipe(
      gulpif(
        (file) => file.relative.split(".").pop() !== "zip",
        replace("_themename", info.name)
      )
    )
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
  extractHtml,
  scripts,
  parallel(styles, images, copy),
  stylePurge,
  html,
  extractClean,
  compress
);
export default dev;
