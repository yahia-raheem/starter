# starter
my starter theme
this repo has my html starter theme with sass and gulp
all you have to do is clone then run npm install in it then run npm start and when its production time run 'npm run build'
enjoy!

change log:

ver 2.0.3:
1) apparently not all bugs were squashed but maybe this time ?
2) a small change in the gulp file in the scripts function (don't ask)
3) imported the minified jquery slim instead of the normal one (less package size)

ver 2.0.2:
1) imported bootstrap's js
2) fixed some import problems in the js files
3) removed sourcemaps from js files (it took around 3s for it to compile .. who has the time right?)
4) reverted to jquery 3.4 because of a bug with bootstrap
5) i think by now i've squashed all the bugs of 2.0 (maybe?) 

ver 2.0.1:
1) changed the html folder location in the production environment so it wouldn't break images src
2) fixed a bug where converting webp images would distort them 
3) fixed a bug where stylesheets and scripts werent pointing to the correct files when in production mode
4) fixed a bug where image tags where still pointing to images (instead of webp files) after production

ver 2.0:
1) the theme is now using gulp. YAY!
2) reduced imports to one style and one script (both called either bundle or bundle-rtl)
3) running npm build produces a folder called bundle with a compressed theme zip that does not contain the node modules
3.1) the file name is the name in the package.json file followed by a dash and then the version number
4) images are now automatically compressed and transformed into the webp format 
5) you can now import inside the js files
6) reintroduced source maps into both the scss and js files (not in production ofcourse)
7) html files can now be included (an example can be found in src/html/index.html) just remember that all html parts should not be in the root html folder

ver 1.1.9:
1) changed the way different components are being loaded from the helpers folder (now there is a components file)
2) in the components file you can find an html snippet of the component and either a referance to where its mixin or the actual mixin
3) changed the way non-required variables are used in different mixins to reduce their size while giving more information about what their default values are
4) added a list component that accepts an icon with various customizable variables

ver 1.1.8:
1) added a simple slider that is not jquery dependant (to use it import the js file and call the myslider function in main.js and use the mixin)
2) added a navigation bar customization pattern that is used alot in our company
3) revised some mixins, for example the box ratio mixin now accepts any width to length
4) added more bootstrap customizations and removed some unwanted bootstrap behaviours such as the margin to headings and paragraphs
5) fixed some bugs in the navigators (introduced in 1.1.6)

ver 1.1.7:
1) fixed some import bugs in the entry sass file
2) fixed import bugs in the index html file
3) removed the loader and navigator abilities (introduced in 1.1.6) to a separate file to be imported if needed to avoid clutter in the main js file and to allow for not importing the file if you don't want to

ver 1.1.6.1:
1) fixed a bug where if the host wasn't a localhost or a subfolder the links behaviour wasn't as desired

ver 1.1.6:
1) added a loader file with a loader mixin (my-loader()) which takes some arguments with defaults included
2) added some keyframe animations to the theme
3) added the loader scripts to the es files
4) added a new script in the es files wich prevents the normal link action and allows you to make actions before following any navigational action
5) using any links now generate a footprint that can be traced using window.history and window.history.state
6) navigating between pages now is alot smoother thanks to the previous two points and the loader

ver 1.1.5:
1) removed the deployed theme javascript and css from the assets folder to a new dist folder for better readability
2) removed the map files generation as it wasn't accurate anyway and unusable since any change had to be done in the sass files
3) fixed the cannot inline remote sources warning so the font can now be imported in the scss files again
4) fixed some problems with the ninja-forms mixin in rtl mode
5) added an intro index.js for future package configurations (empty for now)

ver 1.1.4:
1) the form customization file is now a mixin to allow for different customizations to more than one form

ver 1.1.3:
1) modified the default widths for the container and container fluid
2) modified some default paddings for the container and sections

ver 1.1.2:
1) fixed bootstrap rtl not working corretly
2) added some mixins to the helpers files and removed the related classes
3) added the ability to change the font family of both the normal and rtl versions of bootstrap
4) removed some redundant prefixing from the custom classes as the prefixer takes care of it anyway

ver 1.1.1:
1) added a lazy loading script to the theme .. from now on use data-src instead of src and add the class lazy to all images in site

ver 1.1:
1) added bootstrap rtl in the starter theme.
2) added deploy scripts which create minified versions of the css files to include in the theme
3) maps are now generated with the css for better experience during development

ver 1.0.2:
1) now bootstrap is imported per module and not in a single bundle to reduce its size and performance print
2) imported the jquery slim instead of the normal one as a bases but you can always change that if needed

ver 1.0.1:
1) added bootstrap and jquery locally
2) new es files that support writing in es6 which is then compiled to be used in the theme

ver 1.0.0:
1) initial release.
