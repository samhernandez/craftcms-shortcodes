<?php
namespace Craft;

class MyshortcodesPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('My Shortcodes');
	}

	public function getVersion()
	{
		return '0.0';
	}

	public function getDeveloper()
	{
		return 'Happy Cog';
	}

	public function getDeveloperUrl()
	{
		return 'http://happycog.com';
	}

	/**
	 * Use this method in any plugin to register shortcodes.
	 *
	 * You may register a single callback:
	 * 
	 *    return array($this, 'myTag');
	 *
	 * Or you may register an array of callbacks:
	 *
	 *     return array(
	 *         array($this, 'myTag'),
	 *         array($this, 'myOtherTag'),
	 *         array($that_object, 'thatTag'),
	 *     );
	 *
	 * The shortcode tag name will match the method name.
	 *
	 *     eg. `[doubleRainbow]` will render the output of the `doubleRainbow()`
	 *     method on this class if registered as `array($this, 'doubleRainbow')`
	 * 
	 * @return array A single array representation of a callable method, or an array of them.
	 */
	public function registerShortcodes()
	{
		return array($this, 'doubleRainbow');
	}

	/**
	 * An example shortcode callback method.
	 *
	 * Examples:
	 *
	 *     Single:     [doubleRainbow]
	 *     Pair:       [doubleRainbow]Text wrapped by shortcode[/doubleRainbow]
	 *     Attributes: [doubleRainbow foo="bar"]
	 * 
	 * @param  array $attributes  Key/value pairs of shortcode attributes
	 * @param  string $content    The content between shortcode pairs
	 * @param  string $tag        The tag name. Same as the method name.
	 * @return string             Replacement text.
	 */
	public function doubleRainbow($attributes, $content, $tag)
	{
		$quotes = array(
			"Whoa, that’s a full rainbow, all the way.",
			"Double rainbow, oh my god! It’s a double rainbow all the way.",
			"Whoa, that’s so intense! Whoa! Man! Wow! Whoa, Uu, Whoa, Oh, Whoa Oh OH! Oh My God!",
			"Oh my god! Look at that! It’s starting to look like a triple rainbow.", 
			"Too much. Tell me what it means?",
		);

		$colors = array(
			'yellow',
			'lime',
			'aqua',
			'magenta',
		);

		$chars = explode(' ', $quotes[array_rand($quotes)]);
		$quote = '';

		foreach($chars as $char)
		{
			$color = $colors[array_rand($colors)];
			$quote .= "<span style=\"background-color: $color;\">$char</span> ";
		}

		return '<span style="font-weight: bold; font-size: 2em;">' . $quote . '</span>';
	}

}
