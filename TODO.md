# Alpha-Church TODO
## Soon
- [x] Fix the landing page which breaks when using Adblock Plus in Safari. The problem is somehow related to the OpenStreetMap being loaded through leafletjs.
  - Possible solution - create option to use Google Maps or OSM.
- [x] Look at [BLB Plugin](https://www.blueletterbible.org/webtools/BLB_ScriptTagger.cfm) for bible popups since reftagger is blocked by [adblock plus](https://community.logos.com/forums/p/139517/890932.aspx) which causes strange behaviour of index.html.
- [x] Bible Verse popups using [bib.ly](//bib.ly) or [reftagger](//reftagger.com).
  - Went with reftagger because it worked straight away. Bib.ly was causing some CSS issues.
  - [x] Setting in config.toml
  - [x] Javascript

## Dreams
- [ ] Break up home page (index.html) into widgets
- [x] Look at [audio.js](https://kolber.github.io/audiojs/) or [Plyr](https://plyr.io/) for sermon podcast player.
- [ ] Allow the map shortcode to display other locations by passing lat/long parameters
