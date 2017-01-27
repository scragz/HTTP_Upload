--TEST--
test the valid extension accessors
--FILE--
<?php
error_reporting(E_ALL ^ E_STRICT);
if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
} else {
    set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../');
    require_once 'HTTP/Upload.php';
}
$up = new HTTP_Upload_File('file.txt');

// initial set
$up->setValidExtensions(array('jpg', 'png'), 'allow', false);
var_dump($up->getValidExtensions());

// add one
$up->addValidExtension('gif');
var_dump($up->getValidExtensions());

// our file is not in the valid list
var_dump($up->hasValidExtension());

// now it is valid
$up->addValidExtension('txt');
var_dump($up->hasValidExtension());
?>
--EXPECTF--
array(2) {
  [0]=>
  string(3) "jpg"
  [1]=>
  string(3) "png"
}
array(3) {
  [0]=>
  string(3) "jpg"
  [1]=>
  string(3) "png"
  [2]=>
  string(3) "gif"
}
bool(false)
bool(true)