# Saturday, 23 November 2019
* Support for sub-submenus. See `exampleSite/config.toml` for an idea of how to implement this. Note that these sub-sub-menus *will not have a visual prompt for users*, so don't hide essential navigation in them. (This is because I couldn't work out a way to implement this attractively in the UI, as well as to discourage burying essential navigation.)
Note: this is the last update which will be reported in this changelog. This project will move to use [github tags](https://developer.github.com/v3/git/tags/).

# Saturday, 16 November 2019
On the home page (\_index.html), feature_icons tiles can have an optional `url` specified. This will make the whole tile clickable. The text of that tile will turn into the link accent colour. (Thanks @ryanclarke)

# Sunday, 3 November 2019
I've made it possible for a sermon to have multiple preachers. Now, 99% of the time a sermon will only be preached by one person, so why the change?
1. It makes [the taxonomies](https://gohugo.io/content-management/taxonomies/#readout) more consistent with pluralisation.
2. There is a potential *use case* for having multiple preachers, such as a panel discussion, or a sermon where one person does an exegetical portion and another person applies the passage.

This is a **breaking change**: you'll need to change all your sermons to have the `preachers:` parameter an array. If you're using TOML frontmatter you can do this with a regular expression. In [atom](//atom.io) I ran a regex find-and-replace over my whole project *Finding* `preachers: "([A-z ]+)"` and replacing it with `preachers: ["$1"]`.

# Tuesday, 13 August 2019
* Thanks to [@Anaeijon](https://github.com/Anaeijon) who [provided a PR](https://github.com/funkydan2/alpha-church/pull/15) with some improved SCSS process.
    * Banner Image is now set in `config.toml` by the variable `Params.banner_image` so it can be processed through Hugo Pipes.
    * _Optional_ more google fonts can be loaded through `config.toml` (See `config.toml` in exampleSite)
    * _Optional_ some plain text contact information can be included above the contact form.

# Tuesday, 9 July 2019
* Fix to Contact form when using Formspree (thanks [@sjloregonwi](https://github.com/funkydan2/alpha-church/commit/e04873db2d36bf73ead1de4cd1dd887b0313cd71))

Friday, 5 July 2019
* Using some caching to speed up build time.
* Added an image to the `exampleSite` contact page.

# Thursday, 27 June 2019
* Thanks @fabianying for notices a few problems.
** Gone back to distributing FontAwesome with the site, so that mobile UI is complete.
** Increased size of the Map box to make it visible on mobile screens (thanks to @theofruitrouge)

# Monday, 17 June 2019
Moved audio player for the sermons into the same <div> as the content because I didn't like where the download button was being placed.

# Wednesday, 5 June 2019
Now using the [FontAwesome kit](https://blog.fontawesome.com/introducing-font-awesome-kits-7134d1d59959) to load icons.

# Thursday, 30 May 2019
* Merged [PR from Clint Davis](https://github.com/funkydan2/alpha-church/pull/11) to improve accessibility of the theme.

# Tuesday, 28 May 2019
* Netlify now uses [Akismet spam filtering](https://www.netlify.com/blog/2019/02/12/improved-netlify-forms-spam-filtering-using-akismet/), so no more need for a honeypot.

# Wednesday, 15 May 2019
Big change to configuration. Options for the landing/home page are now defined in `/content/_index.md` (This is a [homepage template](https://gohugo.io/templates/homepage/)b). The reason for this is to make the main configuration smaller and neater—`config.toml` should mainly have whole-site configuration values.

# Wednesday, 17 April 2019
Added *optional* setting for Google Maps to be localised due to [this issue](https://github.com/funkydan2/alpha-church/issues/10). Under `[params.map]` there are two *optional* settings `language` and `region`. These will force Google Maps to be displayed for the given localisation. See [here for a list of supported languages](https://developers.google.com/maps/faq#languagesupport) and [here for a list of valid regions](https://www.iso.org/obp/ui/#search) (Google uses the two-letter, Alpha-2 code).

# Saturday, 13 April 2019
* Shortcode {{< osmap >}} is now {{< map >}} because it could be google or OSM.

# Thursday, 11 April 2019
* New option - maps can be either from Google or Open Street Maps.
    * New setting in `config.toml` under [Params.Map] you need to set `service = "osm"` or `service="google"`
    * To use Google Maps, you also need to define `api_key` https://developers.google.com/maps/documentation/embed/get-api-key

# Tuesday, 9 April 2019
* There's now an option to use either [Faithlife Reftagger](https://faithlife.com/products/reftagger) or the [Blue Letter Bible ScriptTagger](https://faithlife.com/products/reftagger). I think Faithlife's reftagger looks much better, ~~but its incompatibility with [adblock plus](https://community.logos.com/forums/p/139517/890932.aspx) may be a deal-breaker for some websites~~. (Actually, I've no idea what causes the site to break with adblock plus. It's javascript, but I can't work out which one.)

# Wednesday, 3 April 2019
Big change - really version 2 now!
* Updated a bunch of SCSS and js to newer version from html5up.

# Monday, 1 April 2019
* A bunch of changes to javascript libraries. Fewer are now pulled from CDN, and there are a few more libraries loaded which weren't being before (my mistake) with the hope of improving sites using Safari.

# Monday, 4 March 2019
* Changed podcast feed so passage is displayed in brackets following the sermon title.

# Tuesday, 19 February 2019
* [Plyr 3.5.0](https://github.com/sampotts/plyr/releases/tag/v3.5.0)

# Monday, 18 February 2019
* Somehow `overlay.png` got lost (probably when I converted to using Hugo Pipes). It's not found.

# Monday, 11 February 2019
* Added optional [instant.page](//instant.page) support. This allows for prefetching of pages in some modern browsers and should increase the speed of the site for users. To enable, set `instant_page = true` in the `[params]` section of `config.toml`.
* Only load [plyr](//plyr.io) on *pages*. This should slightly improve loading time, but it would be even better to only load the library when  `<audio>` is on a page - I'm not sure how to do that.

# Tuesday, 29 January 2019
* [FontAwesome 5.7.0](https://github.com/FortAwesome/Font-Awesome/releases/tag/5.7.0)

# Monday, 14 January 2019
* Added a small space between icon and word in download button for sermon recordings.

# Monday, 5 November 2018
* FontAwesome 5.5
* Fixed pluralised titles for sermon series.

# Saturday, 13 October 2018
* FontAwesome 5.4.1
* [Leaflet JS 1.3.4](https://leafletjs.com/2018/08/21/leaflet-1.3.4.html)

# Wednesday, 3 October 2018
* A small change to the single sermon partial to make code more [DRY](https://en.wikipedia.org/wiki/Don%27t_repeat_yourself).
* Discovered the [`rssLimit` configuration setting](https://gohugo.io/getting-started/configuration/#all-configuration-settings) so removed `.Params.Podcast.num_episodes` setting and code which used it. So now, to set how many episodes use the built-in setting. (This does mean all feeds, e.g. blog and podcast, will have the same number of entries.)

# Wednesday, 26 September 2018
* Bugfix: Custom CSS variable was incorrect. To enable custom CSS, see the updated config.toml in the exampleSite. Place your custom CSS file in `/static`.
* Updated to [plyr 3.4.4](https://github.com/sampotts/plyr/releases/tag/v3.4.4)

# Monday, 17 September 2018
Big changes for podcast discovery.
* Added 'Subscribe on Android' and 'Subscribe in iTunes' link to list of sermons.
To make this work, there's been a few variables changed in `config.toml` - see the `exampleSite config for details.

# Monday, 10 September 2018
* Added meta tag for linking to Apple Podcasts on iOS ([see this page for more information](https://blog.pacific-content.com/optimize-your-podcast-website-for-ios-with-a-single-line-of-code-cf56a7a3f486))
** `.Site.Params.Podcast.iTunesID` in config.toml required for this feature. **NB changes on 17/9/18**

# Sunday, 9 September 2018
* Changed to Relative Permalinks for assets to ensure the `exampleSite` builds on //themes.gohugo.io.

# Thursday, 30 August 2018
* FontAwesome 5.3.1 now has some ['religious' icons](https://fontawesome.com/icons?d=gallery&c=religion)

# Saturday, 18 August 2018
* Added scss for `input:not([type]),` to deal with `hugo --minify` in 0.47

# Friday, 17 August 2018
* Added [honeypot spam protection for netlify forms](https://www.netlify.com/docs/form-handling/#honeypot-field)
   * Updated to use scss to hide the field (hopefully trickier for bots).

# Tuesday, 14 August 2018
* [Plyr 3.4.0](https://github.com/sampotts/plyr/releases/tag/v3.4.0)

# Wednesday, 8 August 2018
* Limit podcast episodes to 50 by default. This can be changed by setting num_episodes in the [Podcast] section of config.toml.

# Tuesday, 24 July 2018
* Update FontAwesome to 5.2

# Monday, 23 July 2018
* Change preachers from an array, since sermons are (normally) only preached by one person.

# Friday, 20 July 2018
* Include OpenGraph and Twitter Card meta-data.
  * **Note: this breaks previous frontmatter.** feature_image is now deprecated and replaced with images, which is an array.

# Thursday, 12 July 2018
* Updated SCSS processing for Hugo 0.43

# Sunday, 24 June 2018
* Made copyright an array of options
* Separate copyright notice for podcast

# Saturday, 23 June 2018
* Updated [fontawesome to 5.1.0](https://blog.fontawesome.com/font-awesome-5-1-409-new-icons-more-4c1e407fae49?gi=22b3b04bdc95)
* Updated [plyr to 3.3.20](https://github.com/sampotts/plyr/releases/tag/v3.3.20)

# Friday, 22 June 2018
* Changed CSS to keep images inside boxes.

# Friday, 22 June 2018
* Moved the 'featured image' for sermons into a left-hand column. The reason for this is to have the audio controls show up 'before the fold'

# Friday, 22 June 2018
* Put anchor points (#services, #feature-icons, #feature-images, #call-to-action) within index.html layout.

# 21 June 2018
* Added plyr.io audio player
* Changed sermon single to work with new plyr

# 18 June 2018
* Changes to CSS so that h1 now looks like a heading.
* Changes to CSS so h1 use in Nav Bar fits with the theme

# 28 May 2018
* Added bible popups using refTagger

# 18 May 2018
* First Release
* Basic functionality
