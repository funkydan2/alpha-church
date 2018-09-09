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
