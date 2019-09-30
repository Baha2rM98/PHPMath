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


    /*
     * private methods for inner usage
     */
    private function minor($matrix, $row, $column)
    {
        $minor = array(array());
        for ($i = 0; $i < count($matrix); $i++)
            for ($j = 0; $i != $row && $j < count(current($matrix)); $j++)
                if ($j !== $column)
                    $minor[$i < $row ? $i : $i - 1][$j < $column ? $j : $j - 1] = $matrix[$i][$j];
        return $minor;
    }


    /**
     * @param array $matrix the input $matrix
     * @param integer $n the dimension of the $matrix
     * @return float|int return calculated determinant of this $matrix
     * @throws Exception
     */
    public function determinant($matrix, $n)
    {
        if ($n < self::ONE)
            throw new Exception("the dimension of matrix can not be less than!");
        if ((count($matrix) !== count(current($matrix))))
            throw new Exception("this is not a square matrix!");
        $d = count($matrix);
        if ($d !== $n)
            throw new Exception("entered data does not match!");
        if ($n === self::ONE)
            return $matrix[0][0];
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


    /**
     * @param $A array matrix will be negative
     * @return array return negative matrix of $A
     */
    public function neg($A)
    {
        $ans = array(array());
        $row = count($A);
        $column = count(current($A));
        for ($i = 0; $i < $row; $i++)
            for ($j = 0; $j < $column; $j++)
                $ans[$i][$j] = (-$A[$i][$j]);
        return $ans;
    }


    /**
     * @param $A array first matrix
     * @param $B array second matrix will be subtracted from first one
     * @return array return subtract of $A and $B
     * @throws Exception
     */
    public function subtract($A, $B)
    {
        return $this->sum($A, $this->neg($B));
    }


    /**
     * @param $A array matrix will be transposed
     * @return array return transposed of matrix $A
     */
    public function transpose($A)
    {
        $row = count($A);
        $column = count(current($A));
        $transposed = array(array());
        for ($i = 0; $i < $row; $i++)
            for ($j = 0; $j < $column; $j++)
                $transposed[$j][$i] = $A[$i][$j];
        return $transposed;
    }


    /**
     * @param $A array matrix will be check if it is singular or not
     * @return boolean return true if $A is singular return false otherwise
     * @throws Exception
     */
    public function isSingular($A)
    {
        $n = count($A);
        return $this->determinant($A, $n) !== 0;
    }


    /**
     * @param $A array the matrix will be inverse
     * @return array return inverse of matrix $A
     * @throws Exception
     */
    public function inverse($A)
    {
        $inverse = array(array());
        $rows = count($A);
        $columns = count(current($A));
        for ($i = 0; $i < $rows; $i++)
            for ($j = 0; $j < $columns; $j++)
                $inverse[$i][$j] = $this->math->pow(-1, $i + $j) * $this->determinant($this->minor($A, $i, $j), $rows - self::ONE);
        if (!$this->isSingular($A))
            throw new Exception("this matrix has no inverse!");
        $det = self::ONE / $this->determinant($A, $rows);
        for ($i = 0; $i < count($inverse); $i++)
            for ($j = 0; $j <= $i; $j++) {
                $temp = $inverse[$i][$j];
                $inverse[$i][$j] = $inverse[$j][$i] * $det;
                $inverse[$j][$i] = $temp * $det;
            }
        return $inverse;
    }
}