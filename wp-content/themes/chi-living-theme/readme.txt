All WooCommerce functions are in the madcow WooCommerce Plugin.

All styles are in the sass folder. main.scss pulls all the partials in.
site uses "chi-styles.css" as its stylesheet.


To compile your scss/sass
npm install -g sass (if you don't already have sass running locally)
sass --watch sass/main.scss:chi-styles.css (to compile your sass)

**** Git Push currently fires off an "Action" and auto-deploys the child theme to the WPEngine server ********
This needs to be removed when we go live.