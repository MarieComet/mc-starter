# MCStarter

Based on [Kawi](https://wordpress.org/themes/kawi/)

[GitHub](https://github.com/MarieComet/mc-starter)

MCStarter is a solid and clean theme for blogs and any other sites.
It has clean typography, plenty of white space and puts the emphasis on your content.

The theme is very simple to use and supports WordPress' core functionalities:

- custom logo
- custom background
- custom header
- custom menu
- featured images (post thumbnails)
- A single widget area you can place on the left, right, or at the bottom, just before the footer.

There are five menu locations :

- The main menu slot features your main menu, obviously. On mobile, the menu is displayed in a sliding sidebar.
- The main social menu allows you to add social link icons along your main menu. Just link to your profile on your favorite platforms.
- There's a footer menu area.
- And another social menu area in the footer.
- And you also have a top bar menu for account link, for example. Note that it doesn't support nested menus.

Supported social icons :

- facebook
- mail (to display an enveloppe icon): just use 'mailto://' in the menu item url.
- github
- instagram
- linkedin
- pinterest
- skype
- soundcloud
- telegram
- tumblr
- twitter
- vimeo
- youtube

## The Customizer options

This theme doesn't include any options page. Everything is handled in the customizer. Go to front end of your site while logged in and click 'Customize' to see the available options.

MCStarter supports all standard customizer options, like 'Site Identity' and 'Background Image', has an extended 'Header Image' section, and also features a new 'Layout' section, in which you can choose your widget area position, and the featured image size you want to display on blog listing pages.

## Jetpack compatibility

This theme supports basic Content Options from Jetpack, Infinite Scroll, and featured image settings.
Just Activate Jetpack, and go to the Customizer to see the Content Options in action.

## Gutenberg support

The theme offers simple support for the built-in blocks of the new WordPress editor, including a custom color palette, custom font sizes and wide and full alignments.

# Dev

## Dépendances utilisées
* [NodeJS](https://nodejs.org)
* [Grunt](https://gruntjs.com)
* [SASS](https://sass-lang.com)
* [Bourbon](https://www.bourbon.io/)


## Prérequis
* installer NodeJS
* installer Grunt `npm install -g grunt-cli`
* installer SASS `npm install -g sass`
* installer Bourbon `gem install bourbon`


## Installation
* dans le dossier des thèmes :
	* `git clone git@github.com:MarieComet/mc-starter.git`
	* `cd mcstarter`
	* `npm install`
	* dupliquer le thème vers un dossier personnalisé : `grunt setup --projectname=nomduprojet` => remplacer `nomduprojet` par le nom du projet, en minuscule, sans espaces. `nomduprojet` est utilisé pour : dossier du thème, prefixes des fonctions, text-domain.
	* `cd nomduprojet`
	* `npm install`
	* observer avec Grunt : `grunt watch`
* supprimer le thème original `mcstarter`

## Tâches Grunt
* watch : observe et compile les fichiers SCSS à chaque changement
* sass : compile les fichiers SCSS - one shot
* potcss : préfixe les minifie les fichiers CSS - one shot
* styles : sass + postcss - one shot
* default : styles - one shot
