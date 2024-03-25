<?php
function rand_(int $max, int $time = null){
    $const = 24;
    $time = abs($time) + 1 ?? hrtime(true);
    $value = $time;
    
    $value = $value * $const;
    $value = array_sum(array_map(function ($e) { static $i = 0; return (int)($e / ($i += 1)); }, array_fill(0, $const, $value)));
    $value = $value * $time;
    $value = $value + (int)(PHP_INT_MAX / $value);

    return ((int) $value) % ($max + 1);
}

function measure(){
    $last_random = null;
    $max = 10000000;
    for($i = 0; $i < 1000; $i++){
        $time = 10000 + $i;
        // $time = hrtime(true);
        $random = rand_($max, $time);
        $spacer = "- - - - - ";
        echo "time(seed): $time ms $spacer";
        echo "random 0-$max: $random";
        // $diff = $random - $last_random;
        // echo "dif: ".(($diff < 0) ? ($diff + $max) : $diff);

        $last_random = $random;
        echo "<br>";
    }
}

// echo hrtime(true)."<br>";
// echo rand_(1000, -2137)."<br>";

measure();
