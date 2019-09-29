<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 29/9/2019
 **/

namespace PHPMath\Algebra;

use PHPMath\Math\Math;
use Exception;

class MatrixFactory
{
    /*
    * private fields for inner usage
    */
    private const ONE = 1;
    private const NEG_ONE = -1;
    private const TWO = 2;
    private $math;


    /**
     * main constructor to create an instance of Math class
     **/
    public function __construct()
    {
        $this->math = new Math();
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
     * @param $A array first matrix
     * @param $B array second matrix will be added to first one
     * @return array return sum of $A and $B
     * @throws Exception
     */
    public function sum($A, $B)
    {
        $row = count($A);
        $column = count(current($A));
        if (($row !== count($B)) || ($column !== count(current($B))))
            throw new Exception("row and column of A and B are not equal!");
        $ans = array(array());
        for ($i = 0; $i < $row; $i++)
            for ($j = 0; $j < $column; $j++)
                $ans[$i][$j] = ($A[$i][$j] + $B[$i][$j]);
        return $ans;
    }
}