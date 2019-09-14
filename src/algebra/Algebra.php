<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 10/9/2019
 **/

namespace Algebra;

use Exception;

class Algebra
{
    private const ZERO = 0;
    private const ONE = 1;
    private const PI = M_PI;


    /**
     * @param float $a
     * @param float $b
     * @return float|int return root of equation
     * @throws Exception
     */
    public function linearEquation($a, $b)
    {
        if ($a === self::ZERO)
            throw new Exception("This is not a linear equation!");
        return ((-$b) / $a);
    }


    /**
     * @param float $a
     * @param float $b
     * @param float $c
     * @return mixed return real roots of equation
     * @throws Exception
     */
    public function quadraticEquation($a, $b, $c)
    {
        if ($a === self::ZERO)
            throw new Exception("This is not a quadratic equation!");
        $delta = (($b ** 2) - (4 * $a * $c));
        if ($delta < self::ZERO)
            throw new Exception("This equation has no real roots!");
        if ($delta === self::ZERO)
            return ((-$b) / (2 * $a));
        $roots = array();
        $roots[] = (((-$b) + sqrt($delta)) / (2 * $a));
        $roots[] = (((-$b) - sqrt($delta)) / (2 * $a));
        return $roots;
    }


    private function nThRoot($value, $root)
    {
        if ($root & 1 && $value < 0) {
            $ans = pow(-$value, (self::ONE / $root));
            $ans *= -1;
            return $ans;
        }
        return pow($value, (self::ONE / $root));
    }

    /**
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @return mixed return real roots of equation
     * @throws Exception
     */
    public function cubicEquation($a, $b, $c, $d)
    {
        if ($a === self::ZERO)
            throw new Exception("This is not a cubic equation!");
        if ($a > 0 && $a < 1) {
            $b *= (1 / $a);
            $c *= (1 / $a);
            $d *= (1 / $a);
            $p = ($c - (($b ** 2) / 3));
            $q = (((2 * ($b ** 3)) / 27) - (($b * $c) / 3) + $d);
            $delta = ((($q ** 2) / 4) + (($p ** 3) / 27));
        } else if ($a > 1) {
            $b /= $a;
            $c /= $a;
            $d /= $a;
            $p = ($c - (($b ** 2) / 3));
            $q = (((2 * ($b ** 3)) / 27) - (($b * $c) / 3) + $d);
            $delta = ((($q ** 2) / 4) + (($p ** 3) / 27));
        } else {
            $p = ($c - (($b ** 2) / 3));
            $q = (((2 * ($b ** 3)) / 27) - (($b * $c) / 3) + $d);
            $delta = ((($q ** 2) / 4) + (($p ** 3) / 27));
        }
        if ($delta > self::ZERO)
            return ($this->nThRoot((-$q / 2) + sqrt($delta), 3) + $this->nThRoot(((-$q / 2) - sqrt($delta)), 3) - ($b / 3));
        $roots = array();
        if ($delta === self::ZERO) {
            $roots[] = ((-2 * $this->nThRoot($q / 2, 3)) - ($b / 2));
            $roots[] = ($this->nThRoot($q / 2, 3) - ($b / 2));
            return array_unique($roots);
        }
        $alpha = 2 / sqrt(3);
        $beta = 1 / 3;
        $gamma = 3 * sqrt(3) * $q;
        $landau = (pow(sqrt(-$p), 3) * 2);
        $roots[] = ($alpha * sqrt(-$p) * sin($beta * asin($gamma / $landau)) - $b / 3);
        $roots[] = (-$alpha * sqrt(-$p) * sin($beta * asin($gamma / $landau) + self::PI / 3) - $b / 3);
        $roots[] = ($alpha * sqrt(-$p) * cos($beta * asin($gamma / $landau) + self::PI / 6) - $b / 3);
        return $roots;
    }
    //TODO: line 108 use unique
}