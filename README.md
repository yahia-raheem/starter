# starter
my starter theme
this repo has my html starter theme with sass support 
all you have to do is clone then run npm install in it then run npm start

change log:

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