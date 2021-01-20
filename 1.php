

<html>

<body>
<?php
$array[0] = array('key_a' => '99', 'key_b' => 'c');
$array[1] = array('key_a' => '33', 'key_b' => 'b');
$array[2] = array('key_a' => '55', 'key_b' => 'a');

function build_sorter($key) {
    return function ($a, $b) use ($key) {
        return strnatcmp($a[$key], $b[$key]);
    };
}

usort($array, build_sorter('key_b'));

foreach ($array as $item) {
    echo $item['key_a'] . ', ' . $item['key_b'] . "<br>";
}
?>
</body>

</html>