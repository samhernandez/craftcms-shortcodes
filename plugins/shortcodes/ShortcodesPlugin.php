<?php
namespace Craft;

class ShortcodesPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Shortcodes Twig Extension');
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

	public function init()
	{
		Craft::import('plugins.shortcodes.lib.Shortcodes');

		$results = craft()->plugins->call('registerShortcodes');

		foreach($results as $class => $result)
		{
			$callables = is_object($result[0]) ? array($result) : $result;

			foreach ($callables as $callable)
			{
				Shortcodes::add_shortcode($callable[1], $callable);
			}
		}
	}

	public function hookAddTwigExtension()
	{
		Craft::import('plugins.shortcodes.lib.Shortcodes');
		Craft::import('plugins.shortcodes.twigextensions.ShortcodesTwigExtension');

		return new ShortcodesTwigExtension();
	}
}
