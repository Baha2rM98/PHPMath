<?php

require_once "vendor\autoload.php";

use PHPMAth\Math\Math;
use PHPMAth\Algebra\Algebra;

//example for Math class
$math = new Math();
echo '<pre>';
print_r($math->ProbablePrimeNumbersList(20000, 185));
echo '</pre>';

//example for Algebra class
$algebra = new Algebra();
echo '<pre>';
print_r($algebra->systemOf3Equation3anonymity([[2, -4, 5], [4, -1, 0], [-2, 2, -3]], [[-33], [-5], [19]]));
echo '</pre>';