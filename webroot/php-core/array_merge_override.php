// Unlike the array_merge_recursively(), we will merge recursively, 
// but will not combine array elements.
// Note: $array2 will override $array1 on same keys.
function array_merge_override($array1, $array2) {
    $result = array();
    foreach ($array1 as $key1 => $value1) {
        $result[$key1] = $value1;
        if (array_key_exists($key1, $array2)) {
            $value2 = $array2[$key1];
            if (is_array($value2)) {
                $result[$key1] = array_override($value1, $value2);
            } else {
                $result[$key1] = $value2;
            }
        }
    }
    return $result;
}