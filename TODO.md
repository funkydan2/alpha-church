# Things to do
- [x] Add a google maps shortcode type thing!
  * [x] [This theme](https://github.com/devcows/hugo-universal-theme) has maps! Check out its contact page
  * [ ] Create a shortcode that displays a google map {{ googlemap }}
    * [ ] By default, centred on the location set in `config.toml`,
    * [ ] Though maybe if an optional location is passed...it could display that??
  * [ ] Create a CSS Box for the map to live in that's taller than 'box special'
- [ ] Podcast page/content type
  * [x] Single Page
    * [x] CSS for the Audio player.
      * [ ] ~~Make it the same height as the download button~~
      * [ ] ~~Put both on the same line~~
      * [ ] Is it worth looking at [audio.js](https://kolber.github.io/audiojs/) or [Plyr](https://plyr.io/)?
  * [x] List Page
    * [x] Left align text
    * [x] Right align 'feature image'
    * [x] Should the text be full width if there's no image?
    * [x] Fix the CSS so <ul class="pagination"> looks good!
    * [x] Remove horizontal rule for last entry.
  * [ ] Podcast RSS
- [ ] Make the screen/overlay of the background image darker or give it a pattern
- [ ] [Submit to Theme list](https://github.com/gohugoio/hugoThemes/blob/master/README.md)

### Done?
- [x] Break pages into partials
- [x] Make index.html configurable via .toml
  - [x] Social/feed icons config
  - [x] Copyright notice
  - [x] Acknowledgements
- [x] Include Google Analytics
- [x] User configurable multi-level menu. (https://gohugo.io/templates/menu-templates/)
- [x] Find out how to pass through conditions in HTML comments. Ans: use `` to escape the string rather than "
- [x] ~~Markdownify the Site title (so you could have Alpha *Church*)~~ This didn't work easily.

## Version 2

* [ ] Break up home page (index.html) into widgets
