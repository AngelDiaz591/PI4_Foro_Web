<?php
/**
 * Convert an array to an object
 * 
 * @param array $array
 * @return object
 */
function as_object($array) {
  return json_decode(json_encode($array));
}
?>
