# Shortcodes for Craft CMS 2.x

This is for the older version of Craft. Find the Craft 3 version here: https://github.com/samhernandez/craft-shortcodes

This is a port of Wordpress shortcode functions for Craft CMS.

This plugin allows you to register shortcode callbacks in your own custom plugins.
Better code docs will come, but it's very simple to understand by glancing at the code.
Suggestions and pull requests are very welcome.

## Usage

This repo comes with two plugins: The Shortcodes plugin as well as the Myshortcodes plugin as an example of how to use.

In your own plugin simply use the `registerShortcodes()` hook to register a single tag, or a list of tags.

### Register a single tag

```php
class MyPlugin {

  ...

  public function registerShortcodes()
  {
    return array($this, 'foobar');
  }
  
  public function foobar($attributes, $content, $tag)
  {
    return 'Foo Bar!';
  }

}
```

### Register multiple tags

```php
  public function registerShortcodes()
  {
    return array(
      array($this, 'foobar'),
      array($this, 'doubleRainbow'),
    );
  }
  
  public function foobar($attributes, $content, $tag) { ...
  public function doubleRainbow($attributes, $content, $tag) { ...

}
```

### Callback arguments

Just like WordPress callbacks you get:

  1. A key/value pair array of tag attributes,
  2. The content between the tags.
  3. The tag name, which will be the name of the method called.

If your text input is

```
[foobar one="two" hey="who"]This is the wrapped text[/foobar]
```

then

```php
  public function foobar($attributes, $content, $tag)
  {
    $one = $attributes['one'];  // 'two'
    $hey = $attributes['hey'];  // 'who'
    $content;                   // 'This is the wrapped text'
    $tag;                       // 'foobar'
    
    return 'Replacement text.';
  }
```

### Template tag

Add the `shortcodes` filter to the twig template tag.

```
{{ entry.body | shortcodes }}
```
