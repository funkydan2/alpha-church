# Things to do
- [x] Add a google maps shortcode type thing!
  - [x] Why not [Open Street Maps](https://leafletjs.com/examples/quick-start/)?
  - [x] [This theme](https://github.com/devcows/hugo-universal-theme) has maps! Check out its contact page
  - [x] Create a shortcode that displays a google map `{{ osmap }}`
    * [x] By default, centred on the location set in `config.toml`,
  - [ ] Fix CSS for the map so that it's height is set to 4:3
- [ ] Podcast page/content type
    - [x] Single Page
      - [ ] Preacher's name [taxonomy](https://gohugo.io/content-management/taxonomies#what-is-a-taxonomy)
        - [ ] Need a 'list page' to work.
      - [x] CSS for the Audio player.
        - [ ] ~~Make it the same height as the download button~~
        - [ ] ~~Put both on the same line~~
    - [x] List Page
      - [x] Left align text
      - [x] Right align 'feature image'
      - [x] Should the text be full width if there's no image?
      - [x] Fix the CSS so `<ul class="pagination">` looks good!
      - [x] Remove horizontal rule for last entry.
  - [ ] Podcast RSS ([see here?](https://discourse.gohugo.io/t/need-to-create-a-podcast-friendly-rss-feed/1727/12))
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
- [x] Find out how to pass through conditions in HTML comments. (Ans: escape the string with backticks, not inverted commas)
- [x] ~~Markdownify the Site title (so you could have Alpha *Church*)~~ This didn't work easily.
- [x] Move version control of libraries (css and javascript) to /data/dependencies.toml ( [see this example](https://github.com/gcushen/hugo-academic/blob/master/data/sri.toml))
  - [x] Remove local dependencies and use their https://cdnjs.com Version
    - [x] jQuery
    - [x] jQuery.dropotron
    - [x] scrollgress
    - [x] Skel
    - [x] leafletjs (js and css)
    - [x] fontawesome
    - [x] (Make sure I implement SHA checking!)
- [x] More 'social' links
  - [x] Don't specify type - let users put in their list and range through it!

## Version 2
- [ ] Break up home page (index.html) into widgets
- [ ] Look at [audio.js](https://kolber.github.io/audiojs/) or [Plyr](https://plyr.io/) for sermon podcast player.
- [ ] Allow the map shortcode to display other locations by passing lat/long parameters
