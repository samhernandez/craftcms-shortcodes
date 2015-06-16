<?php
namespace Craft;

class ShortcodesTwigExtension extends \Twig_Extension
{
	protected $env;

	public function getName()
	{
		return 'Shortcodes Twig Extension';
	}

	public function getFilters()
	{
		return array(
			'shortcodes' => new \Twig_Filter_Method($this, 'shortcodes'),
			'stripShortcodes' => new \Twig_Filter_Method($this, 'stripShortcodes')
		);
	}

	public function getFunctions()
	{
		return array('shortcodes' => new \Twig_Function_Method($this, 'shortcodes'));
	}

	public function initRuntime(\Twig_Environment $env)
	{
		$this->env = $env;
	}

	public function shortcodes($content)
	{
		$result = Shortcodes::do_shortcode($content);

		// If it's Rich Text Field content then we need to return a RichTextData object.
		// Returning a simple string results in escaped html tags.
		if (is_object($content) && get_class($content) === 'Craft\RichTextData')
		{
			$charset = craft()->templates->getTwig()->getCharset();
			$content = new RichTextData($result, $charset);
		}
		else
		{
			$content = $result;
		}

		return $content;
	}

	public function stripShortcodes($content) {
		return Shortcodes::strip_shortcodes($content);
	}
}
