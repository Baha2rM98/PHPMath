<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 10/9/2019
 **/

namespace Algebra;
require_once "src\math\Math.php";

use Math\Math;
use Exception;

class Algebra
{
    /*
     * private fields for inner usage
     */
    private const ZERO = 0;
    private const ONE = 1;
    private const NEG_ONE = -1;
    private const TWO = 2;
    private const THREE = 3;
    private const PI = M_PI;
    private $math;


    /**
     * main constructor to create an instance of Math class
     **/
    public function __construct()
    {
        $this->math = new Math();
    }


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
            return ($this->math->nThRoot((-$q / 2) + sqrt($delta), 3) + $this->math->nThRoot(((-$q / 2) - sqrt($delta)), 3) - ($b / 3));
        $roots = array();
        if ($delta === self::ZERO) {
            $roots[] = ((-2 * $this->math->nThRoot($q / 2, 3)) - ($b / 2));
            $roots[] = ($this->math->nThRoot($q / 2, 3) - ($b / 2));
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

    /**
     * @param array $matrix the input $matrix
     * @param integer $n the dimension of the $matrix
     * @return float|int return calculated determinant of this $matrix
     * @throws Exception
     */
    public function determinant($matrix, $n)
    {
        if ($n <= self::ONE)
            throw new Exception("the dimension of matrix can not be one or less than!");
        if ((count($matrix) !== count(current($matrix))))
            throw new Exception("this is not a square matrix!");
        $d = count($matrix);
        if ($d !== $n)
            throw new Exception("entered data does not match!");
        if ($n === self::TWO)
            return (($matrix[0][0] * $matrix[1][1]) - ($matrix[1][0] * $matrix[0][1]));
        $det = 0;
        $subMatrix = array(array());
        for ($x = 0; $x < $n; $x++) {
            $subI = 0;
            for ($i = 1; $i < $n; $i++) {
                $subJ = 0;
                for ($j = 0; $j < $n; $j++) {
                    if ($j === $x)
                        continue;
                    $subMatrix[$subI][$subJ] = $matrix[$i][$j];
                    $subJ++;
                }
                $subI++;
            }
            $det = $det + ($this->math->pow(self::NEG_ONE, $x) * $matrix[0][$x] * $this->determinant($subMatrix, $n - self::ONE));
        }
        return $det;
    }


    /**
     * @param array $coefficients matrix
     * @param array $anonymity matrix
     * @return array return answer of the system of linear equations in an array
     * @throws Exception
     */
    public function systemOf2Equation2anonymity($coefficients, $anonymity)
    {
        $cDet = $this->determinant($coefficients, self::TWO);
        if ($cDet === self::ZERO)
            throw new Exception("this system has no answer!");
        $xMatrix = array(array($anonymity[0][0], $coefficients[0][1]), array($anonymity[1][0], $coefficients[1][1]));
        $yMatrix = array(array($coefficients[0][0], $anonymity[0][0]), array($coefficients[1][0], $anonymity[1][0]));
        $ans = array();
        $ans[] = (($this->determinant($xMatrix, self::TWO)) / $cDet);
        $ans[] = (($this->determinant($yMatrix, self::TWO)) / $cDet);
        return $ans;
    }


    /**
     * @param array $coefficients matrix
     * @param array $anonymity matrix
     * @return array return answer of the system of linear equations in an array
     * @throws Exception
     */
    public function systemOf3Equation3anonymity($coefficients, $anonymity)
    {
        $cDet = $this->determinant($coefficients, self::THREE);
        if ($cDet === self::ZERO)
            throw new Exception("this system has no answer!");
        $xMatrix = array(array($anonymity[0][0], $coefficients[0][1], $coefficients[0][2]), array($anonymity[1][0], $coefficients[1][1], $coefficients[1][2]), array($anonymity[2][0], $coefficients[2][1], $coefficients[2][2]));
        $yMatrix = array(array($coefficients[0][0], $anonymity[0][0], $coefficients[0][2]), array($coefficients[1][0], $anonymity[1][0], $coefficients[1][2]), array($coefficients[2][0], $anonymity[2][0], $coefficients[2][2]));
        $zMatrix = array(array($coefficients[0][0], $coefficients[0][1], $anonymity[0][0]), array($coefficients[1][0], $coefficients[1][1], $anonymity[1][0]), array($coefficients[2][0], $coefficients[2][1], $anonymity[2][0]));
        $ans = array();
        $ans[] = (($this->determinant($xMatrix, self::THREE)) / $cDet);
        $ans[] = (($this->determinant($yMatrix, self::THREE)) / $cDet);
        $ans[] = (($this->determinant($zMatrix, self::THREE)) / $cDet);
        return $ans;
    }
}
