<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 10/9/2019
 **/

namespace PHPMath\Algebra;

use PHPMath\Math\Math;
use Exception;

class Algebra
{
    /*
     * private fields for inner usage
     */
    private const ZERO = 0;
    private const TWO = 2;
    private const THREE = 3;
    private const PI = M_PI;
    private $math;
    private $matrixFactory;


    /**
     * main constructor to create an instance of Math class and MatrixFactory class
     **/
    public function __construct()
    {
        $this->math = new Math();
        $this->matrixFactory = new MatrixFactory();
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
     * @param array $coefficients matrix
     * @param array $anonymity matrix
     * @return array return answer of the system of linear equations in an array
     * @throws Exception
     */
    public function systemOf2Equation2anonymity($coefficients, $anonymity)
    {
        $cDet = $this->matrixFactory->determinant($coefficients, self::TWO);
        if ($cDet === self::ZERO)
            throw new Exception("this system has no answer!");
        $xMatrix = array(array($anonymity[0][0], $coefficients[0][1]), array($anonymity[1][0], $coefficients[1][1]));
        $yMatrix = array(array($coefficients[0][0], $anonymity[0][0]), array($coefficients[1][0], $anonymity[1][0]));
        $ans = array();
        $ans[] = (($this->matrixFactory->determinant($xMatrix, self::TWO)) / $cDet);
        $ans[] = (($this->matrixFactory->determinant($yMatrix, self::TWO)) / $cDet);
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
        $cDet = $this->matrixFactory->determinant($coefficients, self::THREE);
        if ($cDet === self::ZERO)
            throw new Exception("this system has no answer!");
        $xMatrix = array(array($anonymity[0][0], $coefficients[0][1], $coefficients[0][2]), array($anonymity[1][0], $coefficients[1][1], $coefficients[1][2]), array($anonymity[2][0], $coefficients[2][1], $coefficients[2][2]));
        $yMatrix = array(array($coefficients[0][0], $anonymity[0][0], $coefficients[0][2]), array($coefficients[1][0], $anonymity[1][0], $coefficients[1][2]), array($coefficients[2][0], $anonymity[2][0], $coefficients[2][2]));
        $zMatrix = array(array($coefficients[0][0], $coefficients[0][1], $anonymity[0][0]), array($coefficients[1][0], $coefficients[1][1], $anonymity[1][0]), array($coefficients[2][0], $coefficients[2][1], $anonymity[2][0]));
        $ans = array();
        $ans[] = (($this->matrixFactory->determinant($xMatrix, self::THREE)) / $cDet);
        $ans[] = (($this->matrixFactory->determinant($yMatrix, self::THREE)) / $cDet);
        $ans[] = (($this->matrixFactory->determinant($zMatrix, self::THREE)) / $cDet);
        return $ans;
    }
}
