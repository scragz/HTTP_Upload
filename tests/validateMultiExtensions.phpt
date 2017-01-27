--TEST--
test for multiple extension
--FILE--
<?php
error_reporting(E_ALL ^ E_STRICT);
if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
} else {
    set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../');
    require_once 'HTTP/Upload.php';
}
$up = new HTTP_Upload_File('file.txt.foo');

// initial set
$up->setValidExtensions(array('txt'), 'allow', false);
var_dump($up->getValidExtensions());

// our file is should be in the valid list
var_dump($up->hasValidExtension());

$up->addValidExtension('foo');
var_dump($up->getValidExtensions());
var_dump($up->hasValidExtension());
?>
--EXPECTF--
array(1) {
  [0]=>
  string(3) "txt"
}
bool(false)
array(2) {
  [0]=>
  string(3) "txt"
  [1]=>
  string(3) "foo"
}
bool(true)