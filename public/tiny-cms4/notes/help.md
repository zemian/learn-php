# FoxPages

FoxPages is a simple file based CMS web application. You can use it to host a website, take notes, or write 
documentations. All you need is just PHP and a directory with write access. It's easy to setup and manage. Just 
drop this application in any web server's DocumentRoot folder and it's ready to run!

Project Owner: Zemian Deng

Project Home: <https://github.com/zemian/marknotes>

## Getting Started

To try this project, run this:

```
cd marknotes
php -S localhost:3000

# To view the site:
open http://localhost:3000

# To view the admin:
open http://localhost:3000/admin.php
```

## Features Overview

* File based content management (no database needed!)
* Web based Admin interface to manage content files
* Password protected Admin area
* Easy content creation support for Html, Markdown or JSON data files
* Nice default look and feel with Bulma CSS styling
* Auto Navigation links that mirror the content folder structures (up to 3 levels in depth)
* Auto hide dot folders and files from navigation bar
* Editor and syntax highlight for Markdown, HTML/JavaScript/CSS and Json
* Customizable templates for notes and admin screens
* Updatable configuration file
* Log file support

## Supported Content Types

By default, the application will use `notes` directory to serve any note files. The following file types are
supported by default:

* `.html` - Write any static HTML files and it will be served as it.
* `.md` - Write any Markdown files and it will be parsed as GitHub Markdown flavor.
* `.txt` - Write any plain text file as it will automatically wrap in a `<pre>` tag.
* `.json` - Write any static `JSON` data files and it will be served as `application/json` Content-Type.

Any of these content will be loaded by `index.php` and use `templates/note.php` as template for rendering. You can
override the template to anything you like. You may also use extension specific template such as 
`templates/note-json.php` that only returns data.

You may use the `admin.php` page to manage notes. It let you view, edit and delete notes with a clean and simple
interface.

## How to access JSON data files

Just use the same URL pattern to access any content. Like this: `index.php?note=data/hello.json`

You can manage these static data files using the same Admin interface. You can create HTML content that access
these data JSON to build quick and interactive UI easily.

If you want dynamic JSON data, you would need to write PHP code. And the easiest way to do that is simply 
override the `note-json.php` template file.

## FoxPages Configuration

The default configuration file is at `notes/.config/marknotes.json`. 
This config file can be overridden by server environment variable named `MARKNOTES_CONFIG`.

You may customize the following settings:

```
{
    "admin_password": "",           /* Set to non-empty if you want to secure the Admin interface. */
    "title" : "FoxPages",          /* HTML title (browser tab) name. */
    "content_dir" : "notes",          /* Dir path to content storage. It can be outside of the app (use an absolute path). */
    "templates_dir" : "templates",  /* Dir path to PHP templates that render the site. */
    "allow_extensions" : [".html", ".md", ".txt", ".json"], /* Allowed content types. */
    "root_menu_label" : "Notes",              /* Top level navigation menu label */
    "exclude_folders" : ["data"], /* Content folders you do not want to shows up on the site. */
    "max_menu_levels": 3,      /* Max level of navigation menu links can be nested. */
    "default_page" : "home.md",           /* Default content page to load. */
    "log_file" : "marknotes.log",    /* File path on where to write log file. */
    "log_level" : "off",                  /* Logger level: off, error, warning, info, debug */
    "is_pretty_link": true,            /* Auto convert content file name into pretty link name under navigation. */
    "is_auto_links": true,               /* To generate navigation links based on content directory structure or not. */
}
```

You may override the link label and order value in the generated `is_auto_links`. You would configure it like this:

```
{
  "menu_links_override": {
    "home.md": {"order":  1, "link_label":  "Home"},
    "help.md": {"order":  2, "link_label":  "Help"},
    ".config": {"menu_order": 1, "is_disable_pretty_link": true},
    "data": {"menu_order": 2, "is_disable_pretty_link": true}
  }
}
```

You may also turn off `is_auto_links`, then you may set your own navigation links structure in the config file like this:

```
{
  "menu_links": {
    "menu_label": "Notes",
    "menu_name": "",
    "menu_order": 0,
    "links": [
      {"link_label":  "My Home", "name": "home2.md", "order":  1},
      {"link_label":  "Search", "url": "https://www.google.com", "order":  2}
    ],
    "child_menu_links": [
        {
            "menu_label": "User Guide",
            "menu_name": "guide",
            "menu_order": 1,
            "links": [
              {"link_label":  "Chapter1", "name": "ch1.md", "order":  1},
              {"link_label":  "Chapter2", "name": "ch2.md", "order":  2},
              {"link_label":  "Chapter3", "name": "ch3.md", "order":  3},
            ],
            "child_menu_links": []
        }
    ]
  }
}
```

## Dependencies

This application is written in PHP and tested with version `7.4.11`.

The following already packaged in this application:

* [PHP Markdown Parser](https://github.com/erusev/parsedown)
* [Bulma CSS](https://bulma.io/)
* [JS CodeMirror](https://codemirror.net/)
