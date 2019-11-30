<?php
function coin()
{
    $a = mt_rand(0, 99);
    return $a < 90 ? 'орел' : 'решка';
}

$result = [];
for($i = 0; $i < 10000; $i++) {
    @$result[coin()]++;
}

var_dump($result);