# Setup Instructions

## Get the theme

If you have `git` installed, you can do the following at the command-line-interface within the Hugo directory:

```
$ mkdir themes
$ cd themes
$ git submodule add https://github.com/funkydan2/alpha-church.git
```

You should see a folder called `alpha-church` inside the `themes` directory that we created a few moments ago. For more information read the official [setup guide](//gohugo.io/overview/installing/) of Hugo.

## Update the theme
  If the theme has been updated, you can use `git` to merge latest commits to the submodule by running `git submodule update --rebase --remote` in root directory of your project.

## Configuration

In the next step navigate to the `exampleSite` folder at `themes/alpha-church/exampleSite/` and copy `hugo.toml` from the exampleSite folder into the root folder of your Hugo site. Then delete the line which says `themesDir = "../.."`.

(Please refer to https://gohugo.io/overview/quickstart/ for installing a Hugo theme.)

## The `hugo` file

Now, let us take a look at `hugo.toml`. Let's take a look at some of the settings.

### 1. Custom CSS
The easiest way to change the look of your site is by overriding the included style sheet. You can do this by putting your css file in `static/css/my.css` and entering `customCSS = ["/css/my.css"]` in the config file.

### 2. Google Analytics
Enable by putting your Analytics key here.
```
GoogleAnalytics = ""
```

### 3. Menu & Nested Menus

The entries in the items menu can be customised. The structure of the menu is defined in `hugo.toml`.

```
[menu]
  [[menu.main]]
    name = "Home"
    url = "/"
    weight = 1
```

Define a label and enter the URL of the resource you want to link. The `weight` value determines the order of menu items. Lower weighted entries appear to the *left* of higher weighted entries.

For sub-menus, you can use the following format:

```
[[menu.main]]
  name = "About"
  url = "/about"
  weight = 2

[[menu.main]]
  name = "About Us"
  parent = "About"
  url = "/about"
  weight = 1
```
In this example, *About* is in the main menu, but *About Us* is in the *About* sub-menu. In *Alpha Church* the sub-menu is a drop-down menu.

### 4. Podcasting
In `hugo.toml` there are settings which are used to generate the podcast RSS feed.

```
[params.podcast]
  title = "Listen to Alpha Church"
  subtitle = ""
  summary = "Alpha-Church sermons, talks, messages—podcasted."
  email = "test@example.com"
  image = "Link to 1400*1400 (or larger) file"
  category = "Religion & Spirituality"
  sub_category = "Christianity"
  #num_episodes = 50
  #iTunesID = 12345677
```
Almost all of these need to be set or else the feed will not be valid. You can leave the `subtitle` entry blank. You don't need to set `num_episodes` unless you want your feed to include a number other than the default (50).

Some of these entries look like site-wide settings (e.g. `title`). They need to be set here as you may which to use a title for your site which is different from your podcast.

The `iTunedID` setting is used to create a subscribe banner for users of the Safari web browser on iOS. Only set this variable if your sermon podcast feed has been submitted to iTunes. [Click here to read instructions on how to find the ID number](https://www.podigee.com/en/help/how-to-find-your-podcasts-itunes-id/).

As you're developing your site, you'll need to check the podcast feed is valid by entering the feed's URL into [a podcast feed validator](https://castfeedvalidator.com).

The podcast feed is found at `/sermons/index.xml`.

### 5. Landing (Home) page
The landing page is quite customisable. It consists of six blocks: a banner, an area for information about services (including a map), links to recent posts, featured icons, featured images, and a contact form.

Settings for the landing page are configured in the frontmatter of `/content/_index.md`. There is an example configuration in the `exampleSite` folder.

The order of the feature blocks (service information, recent posts, feature icons, feature images) is configurable with a `features` list:

```
features = ["recent_posts", "services", "feature_icons", "feature_images"]
```

Only the features named in the list are rendered, in the order given (each still needs to be enabled in its own settings block). If the list is omitted, all four features are rendered in the default order: services, recent posts, feature icons, feature images. The banner always stays at the top of the page and the contact form (CTA) at the bottom.

A feature can appear more than once with different content. Instead of a plain name, use an inline table with `feature` (the block to render) and `key` (the settings block to read it from):

```
features = ["services", "feature_icons", { feature = "feature_icons", key = "feature_icons_youth" }]
```

Then add a `[feature_icons_youth]` settings block in the same format as `[feature_icons]`. Any feature can be repeated this way, including services and recent posts. This works with both TOML and YAML frontmatter (in YAML, a repeat entry is a list item with `feature:` and `key:` fields). The plain instance keeps its usual anchor (`#feature-icons`); an instance with a different key gets an anchor suffixed with the key (`#feature-icons-feature_icons_youth`), and a repeated services block gets its own map container ID, so links and maps stay unique.

Entries are not deduplicated: a plain name listed twice still renders the same content twice with duplicate anchors — use a different `key` for each instance instead. A `key` with no matching settings block logs a warning and is skipped.

Each feature block is a partial in `layouts/_partials/home/`, so new features can be added by creating a partial there and naming it in the `features` list.

#### a. Banner
The banner section requires a background image to be set. This image should be 1800*1200 px, and a relatively simple image will probably look best. The filename of this banner is set in `hugo.toml`
```
[params.banner]
  image = "/img/banner.jpg"
```

You can place link buttons in this area by using the following settings.

```
[[banner.button]]
  url = "/contact"
  text = "Get in touch"
  type = "primary"
```

#### b. Service information
Below the banner is an area which could be used for highlight service location and times. The settings for the [open street map](https://openstreetmap.org) in this area are detailed below.

#### c. Recent Posts
This section displays links to your most recent posts, each with its publication date.

```
[recent_posts]
  enable = true
  count = 3
  section = "posts"
  button_text = "All posts"
```

`count` sets the number of posts to link to (default: 5) and `section` sets the content section they're pulled from (default: `posts`). The heading defaults to "Recent Posts" (translated to the site language); override it with `title`. If `button_text` is set, a button with that text links to the section's archive page. The section is hidden if there are no posts to show.

#### d. Feature Icons
These feature icons are pulled from [fontawesome](https://fontawesome.com). The layout requires an even number of these blocks (well, you could have an odd number, but it would look, well, odd). To find items [search around on the fontawesome site](https://fontawesome.com/icons?d=gallery)

```
[[feature_icons.tile]]
  icon = "fa-users"
  icon_pack = "fas"
  accent = "2"
  title = "Meet"
  text = "Meeting together to hear."
```
The value of the `icon` and `icon_pack` setting is found on the FontAwesome site. `Accent` is a colour scheme set in the css (there are 5 accent colours).

An optional `title` directly under `[feature_icons]` (not under a tile) adds a heading above the tiles:

```
[feature_icons]
  enable = true
  title = "Our Ministries"
```

This is especially useful when the block is repeated with different content, so each group of tiles can be labelled.

#### e. Feature Images
Like the *Feature Icons* this section looks best with an even number of entries.

### 6. Map
This theme makes use of [open street maps](https://openstreetmap.org) on the landing page and as a shortcode.

To set your organisations' location edit `hugo.toml`.
```
[params.map]
  service = "osm"
  latitude = "48.8530"
  longitude = "2.3498"
  zoom = "18"
```
To find the appropriate values, visit https://openstreetmap.org and find the location you want to be shown on your map. Then look at the URL in your browser's location bar. You'll see something like `https://www.openstreetmap.org/search?query=New%20York#map=14/40.6971/-73.9796`. The final three numbers in this URL give the values of Zoom/Latitude/Longitude.

If you'd like a map on another page, you can use an inline shortcode `{{< map.inline >}}{{ partial "map" . }}{{< /map.inline >}}`. **N.B. inline shortcodes must be [enabled in your config file](https://gohugo.io/templates/shortcode-templates/#inline-shortcodes).**

You can also use Google Maps. To do this, you'll need an [API Key from Google](https://developers.google.com/maps/documentation/embed/get-api-key) and set it in `hugo.toml`:
```
[params.map]
  service = "google"
  latitude = "48.8530"
  longitude = "2.3498"
  zoom = "18"
  api_key = "XXXXXXXX"
```
If you're using Google Maps there are two *optional* settings `language` and `region`. Without these settings, Google Maps will display in the language of the user's browser. Using these settings will force Google Maps to be displayed for the given localisation. See [here for a list of supported languages](https://developers.google.com/maps/faq#languagesupport) and [here for a list of valid regions](https://www.iso.org/obp/ui/#search).

e.g.
```
  language = "fr"
  region = "FR"
```

You can also use Mapbox. To do this you'll need an [API Key from Mapbox](https://docs.mapbox.com/help/how-mapbox-works/access-tokens/) and set it in `hugo.toml`. You can also define your custom map style using [Mapbox Studio](https://www.mapbox.com/mapbox-studio/).

```
[params.map]
  service = "mapbox" 
  latitude = "48.137232"
  longitude = "11.575503"
  zoom = "13"
  api_key = "XXXXXXXX"
  style_url = "mapbox://LINK_TO_MAPBOXP_STYLE"
  marker_title = "Popup Marker Title"
  marker_address= "Streetname <br> Postcode Town"
```

> If `marker_title` and `marker_address` are not set, the popup will not be rendered in the map.

### 7. Contact Form
You can have a contact form using a [netlify form](https://www.netlify.com/docs/form-handling/) (if you're deploying with netlify), [formspree](https://formspree.io), or a PHP mail script on your own server.
```
[params.contact]
  service = ""
  confirm_page = "/contact_thanks"
  formspree_email=""
```
Set *service* to `service = "netlify"`, `service = "formspree"` or `service = "php"`.

If you're using formspree, you'll also need to set `formspree_email` to your email address.

If you're using netlify, you'll also want to set the `confirm_page = "url"` to a page on your site. That way after a user submits the form they'll be sent to a page with your customised thank you message, rather than a generic netlify page.

#### PHP mail scripts
If your site is hosted on a server that runs PHP, set `service = "php"` and copy one of the two interchangeable scripts from the `exampleSite`'s `static/` folder to your site's `static/` folder:

* **`contact_mail.php`** — the simple option: sends with PHP's built-in `mail()` function, no dependencies. Edit the settings at the top (recipient, sender, subject, redirect pages). It works wherever the server's mail setup can deliver to the recipient — many shared hosts can; cloud VMs often need authenticated SMTP instead. It validates input and checks the form's hidden honeypot field. It also supports the ALTCHA captcha when the Composer library is installed (see below); without the library, captcha submissions fail closed.
* **`contact_mail_smtp.php`** — sends through an SMTP server using [PHPMailer](https://github.com/PHPMailer/PHPMailer): any provider, with documented presets for Google Workspace. Also supports the ALTCHA captcha and the honeypot check. Install the dependency with [Composer](https://getcomposer.org), ideally outside the web root:

  ```
  composer require phpmailer/phpmailer
  ```

Select which script the form posts to with `php_script` (defaults to `/contact_mail.php`):

```
[params.contact]
  service = "php"
  php_script = "/contact_mail_smtp.php"
```

The SMTP script optionally loads settings from `contact_mail_config.php` one directory above itself — outside the web root when the script lives in your published `static/` folder. Any variables set there override the defaults in the script.

**SMTP settings.** Edit the settings at the top of `contact_mail_smtp.php`: recipient, sender, subject, redirect pages, the SMTP server (`$smtp_host`, `$smtp_port`, `$smtp_secure` — the defaults are Gmail's), and the path to Composer's `vendor/autoload.php`. Choose an authentication mode via `$smtp_mode`:

* **`relay`** — no SMTP authentication; the server is trusted by IP or network. For Google's [SMTP relay service](https://support.google.com/a/answer/176600), set `$smtp_host = 'smtp-relay.gmail.com'`; a Workspace admin must allow the server's IP under *Admin console > Apps > Google Workspace > Gmail > Routing > SMTP relay service* (restrict allowed senders to your domains). The server needs a static IP. This is Google's recommended option for websites.
* **`password`** — username/password SMTP auth, works with any provider. For Gmail/Workspace use a [Google app password](https://support.google.com/accounts/answer/185833): the sending account needs 2-Step Verification, and your Workspace admin must allow app passwords (they can be disabled org-wide, e.g. by security-key-only 2SV). Note that app passwords are revoked whenever the account password changes. Google no longer accepts plain account passwords.
* **`oauth2`** — XOAUTH2 with auto-refreshed tokens via the Google provider (`league/oauth2-google`, install it alongside PHPMailer). Most robust long-term for Gmail. Setup:
  1. In the [Google Cloud console](https://console.cloud.google.com), create a project, enable the **Gmail API**, and configure the OAuth consent screen as **Internal** (so refresh tokens don't expire after 7 days).
  2. Create an OAuth client ID of type **Desktop app**.
  3. Run the one-time helper `contact_oauth_setup.php` (in `exampleSite`, next to `hugo.toml`) on any machine with PHP: `php contact_oauth_setup.php`. It prints a URL; sign in with the sending account, consent, and paste back the redirect URL. It outputs the refresh token.
  4. Set `$smtp_mode = 'oauth2'` and fill in `$oauth_client_id`, `$oauth_client_secret` and `$oauth_refresh_token`.

  For other providers, swap the `League\OAuth2\Client\Provider\Google` class in the script for the matching `league/oauth2-*` provider.

With Gmail, the sender (`$from`) must be the authenticated account or a verified "send as" alias of it, otherwise Gmail rewrites or rejects it.

**Keep credentials secret.** Rather than editing credentials into `contact_mail_smtp.php` (which lives in your web root), put them in the separate config file *outside* the web root described above. Never commit credentials to git. Sending failures are logged to the PHP error log.

#### Captcha (ALTCHA)
The PHP contact form can be protected with [ALTCHA](https://altcha.org), a self-hosted, MIT-licensed captcha. Instead of puzzles or tracking, the visitor's browser silently solves a small cryptographic proof-of-work challenge; your server verifies it before sending the mail. No cookies, no external service, no data leaves your server, and it is screen-reader accessible (WCAG 2.2 AA). A hidden honeypot field is also checked as a baseline. (The netlify and formspree backends include their own spam filtering, so this option applies to `service = "php"` only.)

**The captcha works with either mail script.** Verifying the proof-of-work needs the ALTCHA PHP library (Composer) and the shared `altcha_verify.php` include next to the mail script. This suits hosts where `mail()` works but outbound SMTP is blocked. If the captcha is enabled while the library is missing, submissions fail closed (rejected, with the reason logged) — install the library or disable the captcha.

Setup:

1. Install the PHP library (alongside PHPMailer if using the SMTP script): `composer require altcha-org/altcha`
2. Copy `static/altcha_challenge.php` and `static/altcha_verify.php` from the `exampleSite` to your site's `static/` folder, next to your chosen mail script. The challenge endpoint issues fresh challenges to the widget; the verify include is shared by both mail scripts.
3. Generate two random secrets and put them — with your mail credentials — in the config file outside the web root (both scripts load the same file):
   ```php
   <?php // contact_mail_config.php
   $altcha_hmac_secret = '...'; # php -r "echo bin2hex(random_bytes(32));"
   $altcha_key_secret  = '...'; # another random string (optional, recommended)
   $captcha_service = 'altcha';
   ```
4. Enable the widget in `hugo.toml`:
   ```
   [params.contact.captcha]
     service = "altcha"
     #challenge_url = "/altcha_challenge.php" #default
   ```

The widget script (with translations) is bundled with the theme and self-hosted — no CDN. It loads only on pages that show the contact form (once per page, even if the form appears twice), and localises itself to the page language. Verification enforces the challenge signature, expiry (5 minutes by default) and single use (solved payloads cannot be replayed). The site must be served over **HTTPS** (the widget uses the Web Crypto API, which requires a secure context; `localhost` works for development). Hugo warns at build time if the captcha is enabled with the classic `mail()` script (a reminder that the server then needs the Composer library and `altcha_verify.php`) or the `baseURL` is plain HTTP.

**Bundled widget provenance:** `assets/js/altcha.i18n.min.js` is the official ALTCHA **v3.7.0** i18n UMD build from [altcha-org/altcha](https://github.com/altcha-org/altcha) (MIT; license text alongside it in `assets/js/altcha-LICENSE.txt`, not published with your site). To update: download the newer `altcha.i18n.min.js` from the [ALTCHA releases](https://github.com/altcha-org/altcha/releases) (or the `altcha` npm package's `dist/`), replace the file, and refresh the license text if it changed. The asset is fingerprinted with SRI at build time, so no manual hash maintenance is needed.

Difficulty and lifetime can be tuned in `altcha_challenge.php` (`$altcha_cost`, `$altcha_counter_min/max`, `$altcha_ttl`). Keep the library up to date (`composer update altcha-org/altcha`) — like any security component, it receives occasional security fixes.

The single-use (replay) guard keeps a small JSON file in the system temp directory. If that file is unwritable, the default behaviour is to log loudly and accept the payload — the challenge signature and expiry are still enforced, so the form keeps working on misconfigured hosts. Set `$altcha_replay_strict = true;` in the config file to reject payloads instead (fail closed).

If you'd like a contact form on another page, use an inline shortcode `{{< contact.inline >}}{{ partial "contact" . }}{{< /contact.inline >}}` **N.B. inline shortcodes must be [enabled in your config file](https://gohugo.io/templates/shortcode-templates/#inline-shortcodes).**

### 8. Links
At the very bottom of each page is a bunch of icons (from FontAwesome) which can be used for links to social media, RSS feeds, or whatever you like!
```
[[params.links]]
  service = "Facebook"
  icon = "fa-facebook"
  icon_pack = "fab"
  link = "//facebook.com/"

[[params.links]]
  service = "Instagram"
  icon = "fa-instagram"
  icon_pack = "fab"
  link = "//instagram.com"

[[params.links]]
  service = "Podcast"
  icon = "fa-podcast"
  icon_pack = "fas"
  link = "/sermons/index.xml"

[[params.links]]
  service = "Full RSS Feed"
  icon = "fa-rss"
  icon_pack = "fas"
  link = "/index.xml"
```

### 8. Bible Popups
Configuration in [params]. Set `bible_popups = "faithlife"` to include Bible reference popups from [Faithlife](https://faithlife.com/products/reftagger), or `bible_popups = "blb"` to use the [Blue Letter Bible](https://www.blueletterbible.org/webtools/BLB_ScriptTagger.cfm) popups.

You may also set the bible translation by defining `bible_version = "ESV"` (or NLT, KJV, CSB, etc.). If you don't define a translation, the default *ESV* will be used.

## Nearly finished

To preview your site, run Hugo's built-in local server.

```
$ hugo server -D
```

Now enter [`localhost:1313`](http://localhost:1313) in the address bar of your browser.

# Usage Instructions
## Image Dimensions
This theme makes use of 'hero' images for regular and sermon/podcast pages. Images need to be the right dimesions in order to display properly.

|Page Type|Width|Height|
|---|---|---|
|Sermon|768px|644px|
|Regular page|1280px|   |
|Front page feature images|618px|412px|
