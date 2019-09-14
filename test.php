<?php

require_once "vendor\autoload.php";

use Algebra\Algebra;
use Math\Math;

//example for Math class
$math = new Math();
echo '<pre>';
print_r($math->primeNumbersList(20000, 185));
echo '</pre>';

//example for Algebra class
$algebra = new Algebra();
echo '<pre>';
print_r($algebra->quadraticEquation(2, -3, 1));
echo '</pre>';
