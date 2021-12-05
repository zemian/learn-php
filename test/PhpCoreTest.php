<?php
use PHPUnit\Framework\TestCase;

class PhpCoreTest extends TestCase {	
	function test_expression() {
		$sum = 1 + 1;
		$this->assertSame($sum, 2);
	}
	
	function test_floating_point_precision() {
		//ini_set('precision', 17);
		$sum = 0.1 + 0.2;
		$this->assertSame(0.3, $sum); // Why this pass in default PHP?
		$this->assertLessThan(0.1e-15, abs($sum - 0.3));
	}
	
	function test_split_string() {
		$a = explode(' ', 'a b c');
		$this->assertIsArray($a);
		$this->assertSame(3, count($a));
		$this->assertEqualsCanonicalizing(['a', 'b', 'c'], $a);
		
		// Special cases
		$this->assertEqualsCanonicalizing([''], explode(' ', ''));
		$this->assertEqualsCanonicalizing(['', ''], explode(' ', ' '));
		$this->assertEqualsCanonicalizing(['', ''], explode('/', '/'));
		$this->assertEqualsCanonicalizing(['a', ''], explode(' ', 'a '));
		$this->assertEqualsCanonicalizing(['', 'a', ''], explode(' ', ' a '));
		$this->assertEqualsCanonicalizing(['', 'a'], explode(' ', ' a'));
		$this->assertEqualsCanonicalizing(['abc'], explode(' ', 'abc'));
	}
	
	function test_string_to_number() {
		// According to this post, +"99" is the fastest, follow by (int)"99", then intval("99)
		/// https://stackoverflow.com/questions/239136/fastest-way-to-convert-string-to-integer-in-php
		$s = '99';
		$this->assertFalse($s === 99);
		$this->assertTrue($s == 99);
		$this->assertTrue(($s + 1) === 100); // Auto cast string to number
		$this->assertTrue((1 + $s) === 100); // Auto cast string to number
	}

	function test_date() {
		// https://www.php.net/manual/en/datetime.format.php
		$this->assertMatchesRegularExpression('/\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d/', date('"Y-m-d H:i:s"'));
	}

	function test_php_object() {
		$a = new stdClass();
		$a->foo = 123;
		$a->bar = "test";
		$this->assertSame(123, $a->foo);
		$this->assertSame("test", $a->bar);
		
		$b = (object) array("foo" => 123, "bar" => "test");
		$this->assertEqualsCanonicalizing($a, $b);
		
		$c = json_decode('{"foo": 123, "bar": "test"}');
		$this->assertEqualsCanonicalizing($a, $c);
		$this->assertEqualsCanonicalizing($c, $b);
	}

	function test_json_serialization() {
		// Default decode result is an php object, not an array!
		$a = json_decode('{}');
		$this->assertIsNotArray($a);
		$this->assertIsObject($a);

		$a = json_decode('{"foo": 123, "bar": "test"}');
		$this->assertSame(123, $a->foo);
		$this->assertSame("test", $a->bar);		
		$this->assertTrue(property_exists($a, "foo"));
		$this->assertFalse(property_exists($a, "fooXX"));
		
		// Converting object to array
		$b = (array)$a;
		$this->assertIsArray($b);
		$this->assertIsNotObject($b);
		$this->assertSame(123, $b['foo']);
		$this->assertSame("test", $b['bar']);
		$this->assertTrue(array_key_exists("foo", $b));
		$this->assertFalse(array_key_exists("fooXX", $b));
		
		// Encoding object and array produce the same json string!
		$s = json_encode($a);
		$this->assertSame('{"foo":123,"bar":"test"}', $s);

		$b = array("foo" => 123, "bar" => "test");
		$s = json_encode($b);
		$this->assertSame('{"foo":123,"bar":"test"}', $s);
	}

	function test_hash_array() {
		$hash = array();
		$this->assertSame(0, count($hash));
		
		// TODO: Is there a better way to do this?
		// Note: you can't access key that does not exists, it will error with "Undefined index: foo"
		// but it's not an exception1
		//
		// echo $hash['foo'];
		//
		// We need to guard it		
		if (array_key_exists('foo', $hash))
			echo $hash['foo'];
		// Or we can assert key check
		$this->assertArrayNotHasKey('foo', $hash);
	}
	
	function test_unset_and_null_check() {
		// Use '??' to test unset or null value assignment
		$input = null;
		$array = array('foo' => 123);
		$this->assertSame('', $array['bar'] ?? '');
		$this->assertSame(123, $array['foo'] ?? '');
		$this->assertSame('', $input ?? '');
		
		$input = 456;
		$this->assertSame(456, $input ?? '');

		// Note that '?:' operator can also be use to check for null assignment
		$input = null;
		$this->assertSame('', $input ?: '');
		$input = 456;
		$this->assertSame(456, $input ?: '');

		// But the '?:' operator can not be used to variable is unset.
		// Below will error with "Undefined index: bar"
		//$this->assertSame('', $array['bar'] ?: '');
	}
}
