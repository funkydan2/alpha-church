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
* Discovered the [`rssLimit` configuration setting](https://gohugo.io/getting-started/configuration/#all-configuration-settings) so removed `.Params.Podcast.num_episodes` setting and code which used it. So now, to set how many episodes use the built in setting. (This does mean all feeds, e.g. blog and podcast, will have the same number of entries.)

# Wednesday, 26 September 2018
* Bugfix: Custom CSS variable was incorrect. To enable custom CSS, see the updated config.toml in the exampleSite. Place you custom CSS file in `/static`.
* Updated to [plyr 3.4.4](https://github.com/sampotts/plyr/releases/tag/v3.4.4)

# Monday, 17 September 2018
Big changes for podcast discovery.
* Added 'Subscribe on Android' and 'Subscribe in iTunes' link to list of sermons.
To make this work, there's been a few variables changed in `config.toml` - see the exampleSite config for details.

# Monday, 10 September 2018
* Added meta tag for linking to Apple Podcasts on iOS ([see this page for more information](https://blog.pacific-content.com/optimize-your-podcast-website-for-ios-with-a-single-line-of-code-cf56a7a3f486))
** `.Site.Params.Podcast.iTunesID` in config.toml required for this feature. **NB changes on 17/9/18**

# Sunday, 9 September 2018
* Changed to Relative Permalinks for assets to ensure the exampleSite builds on //themes.gohugo.io.

# Thursday, 30 August 2018
* FontAwesome 5.3.1 now has some ['religious' icons](https://fontawesome.com/icons?d=gallery&c=religion)

# Saturday, 18 August 2018
* Added scss for `input:not([type]),` to deal with `hugo --minify` in 0.47

# Friday, 17 August 2018
* Added [honeypot spam protection for netlify forms](https://www.netlify.com/docs/form-handling/#honeypot-field)
   * Updated to use scss to hide field (hopefully trickier for bots).

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
  * **Note: this breaks previous frontmatter.** feature_image is now deprecated, and replaced with images, which is an array.

# Thursday, 12 July 2018
* Updated SCSS processing for hugo 0.43

# Sunday, 24 June 2018
* Made copyright an array of options
* Seperate copyright notice for podcast

# Saturday, 23 June 2018
* Updated [fontawesome to 5.1.0](https://blog.fontawesome.com/font-awesome-5-1-409-new-icons-more-4c1e407fae49?gi=22b3b04bdc95)
* Updated [plyr to 3.3.20](https://github.com/sampotts/plyr/releases/tag/v3.3.20)

# Friday, 22 June 2018
* Changed CSS to keep images inside boxes.

# Friday, 22 June 2018
* Moved the 'feature image' for sermons into a left hand column. The reason for this is to have the audio controls show up 'before the fold'

# Friday, 22 June 2018
* Put anchor points (#services, #feature-icons, #feature-images, #call-to-action) within index.html layout.

# 21 June 2018
* Added plyr.io audio player
* Changed sermon single to work with new plyr

# 18 June 2018
* Changes to CSS so that h1 now looks like a heading.
* Changes to CSS so h1 use in Nav Bar fits with theme

# 28 May 2018
* Added bible popups using refTagger

# 18 May 2018
* First Release
* Basic functionality
