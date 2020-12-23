# starter
my starter theme
this repo has my html starter theme with sass and gulp (and wp support! .. more on that below).
all you have to do is download the latest version from releases then run npm install in it then run npm start and when its production time run 'npm run build'
enjoy!

how to use (more specific):
after doing the three steps above your coding day should go like this (no wordpress):
1) run npm start then work fully inside the src folder and see your changes in the dist/html folder
2) to import html files inside html files you can use the following function [@@include('path-to-html-file')]
3) run npm run build when you are done with the project (don't forget to delete the php files).

with wordpress:
1) step one as before
2) put the theme folder in themes and call it [theme name]_dev
3) remove the comment dashes from before the external part in the gulp file in the scripts function
3) copy html from the dist folder to the header, footer, and pages (this is not a wp guide)
4) run gulp phpMigrate --file=path to file.php on each php file you copied stuff into (yes this could have been easier but not as fool proof as it is now)
5) when you're done with your theme development run npm run build and take the zip from the bundle folder and extract it in the themes folder (so now its on the same level as the development theme) and switch themes in the wordpress dashboard
