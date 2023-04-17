<?php

namespace JSV\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

use JSV\Twig\Util\JavascriptUtil;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
class Extension extends AbstractExtension
{
	/**
	 * @inheritDoc
	 */
	public function getFilters(): array
	{
		return [
			/**
			 * jsv a.k.a. JavaScript Value filter: Output ECMAScript format of input value.
			 * Avoid using with objects¹ or resources, as json_encode() will likely choke on these.
			 *
			 * ¹ By default objects with a __toString() method will first be casted to strings, making these safe to use.
			 *
			 * @uses JavascriptUtil::getCompatibleValueForOutput()
			 */
			new TwigFilter('jsv', function (mixed $value, bool $castObjectToString = true): string {
				return JavascriptUtil::getCompatibleValueForOutput($value, $castObjectToString);
			}, ['is_safe' => ['html']])
		];
	}
}
