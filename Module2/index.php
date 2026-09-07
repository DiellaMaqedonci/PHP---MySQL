<?php

   $myName = "Diella Maqedonci";

   echo "My name is $myName";



   $x = 13;
   $y = 10;
   $z = 3;

   echo "<br>";
   echo $x + $y + $z;
   echo "<br>";
   echo $x - $y - $z;
   echo "<br>";
   echo $x * $y * $z;
   echo "<br>";
   echo $x / $y / $z;
   echo "<br>";
   echo $x % $y % $z;
   echo "<br>";



   $a = "Diella";
   $b = "Maqedonci";
   $c = $a.$b;

   echo "$c <br>";



   $the_string = "Diella Maqeonci";
   echo strlen($the_string);
   echo "<br>";
   echo str_word_count($the_string);
   echo "<br>";
   echo strrev($the_string);
   echo "<br>";



   $programming = "Programming is not cool";
   echo str_replace("not", "very", $programming);
?>