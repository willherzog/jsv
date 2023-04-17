<?php

namespace JSV\Twig\Util;

/**
 * @author Will Herzog <willherzog@gmail.com>
 */
class JavascriptUtil
{
	private function __construct()
	{}

	static protected function handleNonScalarValue(mixed $value, bool $castObjectToString): string
	{
		if( \is_array($value) && \array_is_list($value) ) {
			$array = $value;
			$values = [];

			foreach( $array as $value ) {
				$values[] = static::getCompatibleValueForOutput($value, $castObjectToString);
			}

			return '[' . implode(',', $values) . ']';
		}

		return json_encode($value);
	}

	static public function getCompatibleValueForOutput(mixed $value, bool $castObjectToString): string
	{
		$type = gettype($value);

		if( $castObjectToString && 'object' === $type && method_exists($value, '__toString') ) {
			$value = (string) $value;
			$type = 'string';
		}

		return match($type) {
			'string' => "'$value'",
			'boolean' => $value ? 'true' : 'false',
			'null' => 'null',
			'integer',
			'double' => (string) $value,
			default => static::handleNonScalarValue($value, $castObjectToString)
		};
	}
}
