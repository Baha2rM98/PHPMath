<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 29/9/2019
 *
 * MatrixFactory class includes lots of method to do operations on matrices
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
     * Main constructor to create an instance of Math class
     **/
    public function __construct()
    {
        $this->math = new Math();
    }


    /*
     * private methods for inner usage *************************************************************
     */

    /**
     * Creates minor matrix
     * @param array $matrix
     * @param integer $row
     * @param integer $column
     * @return array return minor matrix
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
     * Detects if an array is a matrix or not
     * @param $var array the array will be check if is matrix or not
     * @return boolean return true if $var is a matrix, return false otherwise
     */
    private function isMatrix($var)
    {
        return is_array($var[0]);
    }

    /***************************************************************************************************/

    /**
     * Converts a an array into a matrix with specific row and column or Converts a matrix into an array or Reshape rows
     * and columns of matrix
     * @param array $data an array includes data to fill built matrix
     * @param integer $rows number of rows
     * @param integer $columns number of columns
     * @return array return built array
     * @throws Exception throws exception if shape is out of range
     */
    public function reShape($data, $rows = null, $columns = null)
    {
        $matrix = array(array());
        $array = array();
        $temp = array();
        $s = $this->size($data);
        $c = 0;
        if (!$this->isMatrix($data)) {
            if (($rows * $columns) > count($data))
                throw new Exception("can not reshape array of size $s into shape ['rows' => $rows, 'columns' => $columns]");
            for ($i = 0; $i < $rows; $i++)
                for ($j = 0; $j < $columns; $j++) {
                    if ($c === count($data))
                        break;
                    $matrix[$i][$j] = $data[$c];
                    $c++;
                }
            return $matrix;
        }

        if ($this->isMatrix($data) && is_null($rows) && is_null($columns)) {
            for ($i = 0; $i < count($data); $i++)
                for ($j = 0; $j < count(current($data)); $j++)
                    $array[] = $data[$i][$j];
            return $array;
        }

        if ($this->isMatrix($data) && !is_null($rows) && !is_null($columns)) {
            for ($i = 0; $i < count($data); $i++)
                for ($j = 0; $j < count(current($data)); $j++)
                    $temp[] = $data[$i][$j];
            if (($rows * $columns) > $this->size($data))
                throw new Exception("can not reshape array of size $s into shape ['rows' => $rows, 'columns' => $columns]");
            for ($i = 0; $i < $rows; $i++)
                for ($j = 0; $j < $columns; $j++) {
                    if ($c === count($temp))
                        break;
                    $matrix[$i][$j] = $temp[$c];
                    $c++;
                }
            return $matrix;
        }

        if (($this->isMatrix($data) && is_null($rows) && !is_null($columns)) || $this->isMatrix($data) && !is_null($rows) && is_null($columns))
            throw new Exception("can not reshape array of size $s into shape ['rows' => null, 'columns' => $columns] or ['rows' => $rows, 'columns' => null]");
        return null;
    }

    /**
     * Calculates determinant of input matrix
     * @param array $matrix the input $matrix
     * @param integer $n the dimension of the $matrix
     * @return float|int return calculated determinant of this $matrix
     * @throws Exception throws exception if it is impossible to calculate determinant
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
     * Calculates sum of two matrices
     * @param $A array first matrix
     * @param $B array second matrix will be added to first one
     * @return array return sum of $A and $B
     * @throws Exception throws exception if row and column of A and B are not equal
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
     * Make a matrix negative
     * @param $matrix array matrix will be negative
     * @return array return negative matrix of $A
     */
    public function neg($matrix)
    {
        $ans = array(array());
        $row = count($matrix);
        $column = count(current($matrix));
        for ($i = 0; $i < $row; $i++)
            for ($j = 0; $j < $column; $j++)
                $ans[$i][$j] = (-$matrix[$i][$j]);
        return $ans;
    }


    /**
     * Calculates subtraction of two matrices
     * @param $A array first matrix
     * @param $B array second matrix will be subtracted from first one
     * @return array return subtraction of $A and $B
     * @throws Exception throws exception if row and column of A and B are not equal
     */
    public function subtract($A, $B)
    {
        return $this->sum($A, $this->neg($B));
    }


    /**
     * Creates transpose of a matrix
     * @param $matrix array matrix will be transposed
     * @return array return transposed of matrix $A
     */
    public function transpose($matrix)
    {
        $row = count($matrix);
        $column = count(current($matrix));
        $transposed = array(array());
        for ($i = 0; $i < $row; $i++)
            for ($j = 0; $j < $column; $j++)
                $transposed[$j][$i] = $matrix[$i][$j];
        return $transposed;
    }


    /**
     * Detect singular matrices
     * @param $matrix array matrix will be check if it is singular or not
     * @return boolean return true if $A is singular return false otherwise
     * @throws Exception throw exception if determinant of $matrix is zero
     */
    public function isSingular($matrix)
    {
        $n = count($matrix);
        return $this->determinant($matrix, $n) !== 0;
    }


    /**
     * Calculates inverse of a matrix
     * @param $matrix array the matrix will be inverse
     * @return array return inverse of matrix $A
     * @throws Exception throw exception if $matrix is singular
     */
    public function inverse($matrix)
    {
        $inverse = array(array());
        $rows = count($matrix);
        $columns = count(current($matrix));
        for ($i = 0; $i < $rows; $i++)
            for ($j = 0; $j < $columns; $j++)
                $inverse[$i][$j] = $this->math->pow(-1, $i + $j) * $this->determinant($this->minor($matrix, $i, $j), $rows - self::ONE);
        if (!$this->isSingular($matrix))
            throw new Exception("this matrix has no inverse!");
        $det = self::ONE / $this->determinant($matrix, $rows);
        for ($i = 0; $i < count($inverse); $i++)
            for ($j = 0; $j <= $i; $j++) {
                $temp = $inverse[$i][$j];
                $inverse[$i][$j] = $inverse[$j][$i] * $det;
                $inverse[$j][$i] = $temp * $det;
            }
        return $inverse;
    }


    /**
     * Calculates multiplication of two matrices
     * @param $A array first matrix
     * @param $B array second matrix will be multiplied to first one
     * @return array return multiply of $A and $B
     * @throws Exception throw exception if $A and $B are not multiplicable
     */
    public function multiply($A, $B)
    {
        $n = count($A);
        $p = count(current($B));
        $m = count($B);
        if (count(current($A)) !== $m)
            throw new Exception("these two matrices can not be multiplied!");
        $res = array(array());
        for ($i = 0; $i < $n; $i++)
            for ($j = 0; $j < $p; $j++) {
                $res[$i][$j] = 0;
                for ($k = 0; $k < $m; $k++)
                    $res[$i][$j] += ($A[$i][$k] * $B[$k][$j]);
            }
        return $res;
    }


    /**
     * Multiply a number into matrix and creates a new matrix
     * @param $scalar float scalar coefficient
     * @param $matrix array the input matrix
     * @return array return a matrix that each element is multiplied by scalar coefficient ($n)
     */
    public function scalarMul($scalar, $matrix)
    {
        $rows = count($matrix);
        $columns = count(current($matrix));
        for ($i = 0; $i < $rows; $i++)
            for ($j = 0; $j < $columns; $j++)
                $matrix[$i][$j] = $scalar * $matrix[$i][$j];
        return $matrix;
    }


    /**
     * Get number of rows and columns in a matrix and return result as an array or represents the result in an integer
     * @param $array array the input array
     * @return array|integer return an array which indicates number of rows and columns in $array if it's a matrix, return
     * number of elements if it's an 1D array
     */
    public function shape($array)
    {
        if ($this->isMatrix($array)) {
            return [
                "rows" => count($array), "columns" => count(current($array))
            ];
        }
        return count($array);
    }


    /**
     * Calculate size of array
     * @param $array array the input array
     * @return integer return size of $array
     */
    public function size($array)
    {
        if ($this->isMatrix($array))
            return ($this->shape($array)["rows"] * $this->shape($array)["columns"]);
        return $this->shape($array);
    }
}