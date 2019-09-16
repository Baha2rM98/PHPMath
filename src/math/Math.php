<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 9/9/2019
 **/

namespace Math;


use Exception;


class Math
{
    public const PI = M_PI;
    public const E = M_E;
    public const ZERO = 0;
    public const ONE = 1;


    /*
     * private fields for inner usage
     */
    private const TWO = 2;
    private const _180 = 180;
    private const ACCURACY = 100;
    private const HALF_PI = M_PI_2;
    private const MAX_INT = PHP_INT_MAX;


    /*
     * private functions for inner usage
     */

    // Utility function to do
    // modular exponentiation.
    // It returns (x^y) % p
    private function power($x, $y, $p)
    {
        $res = 1;
        $x = $x % $p;
        while ($y > 0) {
            if ($y & 1)
                $res = ($res * $x) % $p;
            $y = $y >> 1; // $y = $y/2
            $x = ($x * $x) % $p;
        }
        return $res;
    }


    // This function is called
    // for all k trials. It returns
    // false if n is composite and
    // returns true if n is
    // probably prime. d is an odd
    // number such that d*2<sup>r</sup> = n-1
    // for some r >= 1
    private function millerRabinTest($d, $n)
    {
        $a = 2 + rand() % ($n - 4);
        $x = $this->power($a, $d, $n);
        if ($x === 1 || $x === $n - 1)
            return true;
        while ($d != $n - 1) {
            $x = ($x * $x) % $n;
            $d *= 2;
            if ($x === 1)
                return false;
            if ($x === $n - 1)
                return true;
        }
        return false;
    }


    /**
     * @param float $radian angle in radian
     * @return float return angle in degree
     */
    public function radToDeg($radian)
    {
        return ((self::_180 / self::PI) * $radian);
    }


    /**
     * @param float $degree angle in degree
     * @return float return angle in radian
     */
    public function degToRad($degree)
    {
        return ((self::PI / self::_180) * $degree);
    }


    /**
     * @param float $value in radian
     * @param boolean $radian (true if arg is radian and false if arg is degree)
     * @return float sin of value in float
     */
    public function sin($value, $radian = true)
    {
        if ($radian === false) {
            $value = ((self::PI / self::_180)) * $value;
            return sin($value);
        }
        return sin($value);
    }


    /**
     * @param float $value in radian
     * @param boolean $radian (true if arg is radian and false if arg is degree)
     * @return float cos of value in float
     */
    public function cos($value, $radian = true)
    {
        if ($radian === false) {
            $value = ((self::PI / self::_180)) * $value;
            return cos($value);
        }
        return cos($value);
    }


    /**
     * @param float $value in radian
     * @param boolean $radian (true if arg is radian and false if arg is degree)
     * @return float tan of value in float
     */
    public function tan($value, $radian = true)
    {
        if ($radian === false) {
            $value = ((self::PI / self::_180)) * $value;
            return tan($value);
        }
        return tan($value);
    }


    /**
     * @param float $value in radian
     * @param boolean $radian (true if arg is radian and false if arg is degree)
     * @return float cot of value in float
     */
    public function cot($value, $radian = true)
    {
        if ($radian === false) {
            $value = ((self::PI / self::_180)) * $value;
            return (self::ONE / tan($value));
        }
        return (self::ONE / tan($value));
    }


    /**
     * @param float $value in radian
     * @return float sinh of value in float
     */
    public function sinh($value)
    {
        return sinh($value);
    }


    /**
     * @param float $value in radian
     * @return float cosh of value in float
     */
    public function cosh($value)
    {
        return cosh($value);
    }


    /**
     * @param float $value in radian
     * @return float tanh of value in float
     */
    public function tanh($value)
    {
        return tanh($value);
    }


    /**
     * @param float $value in radian
     * @return float coth of value in float
     */
    public function coth($value)
    {
        return (self::ONE / tanh($value));
    }


    /**
     * @param float $value
     * @param boolean $radian (true if returned angle is degree, false if returned angle is radian)
     * @return float arc sin of value
     */
    public function arcSin($value, $radian = true)
    {
        $angle = asin($value);
        if ($radian === false) {
            $angle = ((self::_180 / self::PI)) * $angle;
            return $angle;
        }
        return $angle;
    }


    /**
     * @param float $value
     * @param boolean $radian (true if returned angle is degree, false if returned angle is radian)
     * @return float arc cos of value
     */
    public function arcCos($value, $radian = true)
    {
        $angle = acos($value);
        if ($radian === false) {
            $angle = ((self::_180 / self::PI)) * $angle;
            return $angle;
        }
        return $angle;
    }


    /**
     * @param float $value
     * @param boolean $radian (true if returned angle is degree, false if returned angle is radian)
     * @return float arc tan of value
     */
    public function arcTan($value, $radian = true)
    {
        $angle = atan($value);
        if ($radian === false) {
            $angle = ((self::_180 / self::PI)) * $angle;
            return $angle;
        }
        return $angle;
    }


    /**
     * @param float $x
     * @param float $y
     * @param boolean $radian if true return angle in radian, else return angle in degree
     * @return float return atan of $x/$y
     */
    public function arcTan2($x, $y, $radian = true)
    {
        $z = $x / $y;
        return $this->arcTan($z, $radian);
    }


    /**
     * @param float $value
     * @param boolean $radian (true if returned angle is degree, false if returned angle is radian)
     * @return float arc cot of value
     */
    public function arcCot($value, $radian = true)
    {
        $angle = atan($value);
        $angle = self::HALF_PI - $angle;
        if ($radian === false) {
            $angle = ((self::_180 / self::PI)) * $angle;
            return $angle;
        }
        return $angle;
    }


    /**
     * @param float $value
     * @return float arc sinh of value in float
     */
    public function arcSinh($value)
    {
        return asinh($value);
    }


    /**
     * @param float $value
     * @return float arc cosh of value in float
     */
    public function arcCosh($value)
    {
        return acosh($value);
    }


    /**
     * @param float $value
     * @return float arc tanh of value in float
     */
    public function arcTanh($value)
    {
        return atanh($value);
    }


    /**
     * @param float $value
     * @return float arc coth of value in float
     */
    public function arcCoth($value)
    {
        return (self::ONE / atanh($value));
    }


    /**
     * @param float $arg
     * @param integer $base
     * @return float logarithm $arg in this $base
     * @throws Exception throw exception if &base is 0 or 1
     */
    public function log($arg, $base)
    {
        if ($base === 0 || $base === 1) {
            throw new Exception("base can not be zero or one!");
        }
        return (log10($arg) / log10($base));
    }


    /**
     * @param float $value
     * @param integer $root
     * @return float return Nth root of this $value
     */
    public function nThRoot($value, $root)
    {
        if ($root & 1 && $value < 0) {
            $ans = pow(-$value, (self::ONE / $root));
            $ans *= -1;
            return $ans;
        }
        return pow($value, (self::ONE / $root));
    }


    /**
     * @param integer $a
     * @param integer $b
     * @return integer return greatest common divisor of $a and $b
     */
    public function gcd($a, $b)
    {
        if ($b === 0) {
            return $a;
        }
        return $this->gcd($b, ($a % $b));
    }


    /**
     * @param integer $a
     * @param integer $b
     * @return integer return least common multiple of $a and $b
     */
    public function lcm($a, $b)
    {
        return (($a * $b) / $this->gcd($a, $b));
    }


    /**
     * @param integer $x
     * @return boolean return true if &x is even, return false if is odd
     */
    public function isEven($x)
    {
        if ($x & 1)
            return false;
        return true;
    }


    /**
     * @param integer $x
     * @return boolean return true if &x is odd, return false if is even
     */
    public function isOdd($x)
    {
        if ($x & 1)
            return true;
        return false;
    }


    /**
     * @param float $x
     * @return float return reverse of $x
     */
    public function reverse($x)
    {
        return (self::ONE / $x);
    }


    /**
     * @param integer $n
     * @return integer return factorial of $n
     */
    public function factorial($n)
    {
        if ($n === self::ONE || $n === self::ZERO)
            return self::ONE;
        return ($n * $this->factorial($n - 1));
    }


    /**
     * @param string $n the number will be checked if it is prime or not
     * @param integer $accuracy accuracy of calculation
     * @return integer return 2 if $n is surly prime, 1 if $n is probably prime, 0 if $n is composite
     * @uses Miller-Robin algorithm
     */
    public function isProbablePrime($n, $accuracy = self::ACCURACY)
    {
        if (strlen($n) > 34)
            return gmp_prob_prime($n);
        if ($n <= 1 || $n === 4)
            return 0;
        if ($n <= 3)
            return 1;
        $d = $n - 1;
        while ($d % 2 === 0)
            $d /= 2;
        for ($i = 0; $i < $accuracy; $i++)
            if (!$this->millerRabinTest($d, $n))
                return 0;
        return 1;
    }


    /**
     * @param integer $end starts from $start to end and detects prime numbers
     * @param null $start if start is null it it will be consider 2
     * @return array return an array includes prime numbers from start to end
     * @uses Sieve of Eratosthenes
     */
    public function ProbablePrimeNumbersList($end, $start = null)
    {
        if (is_null($start)) {
            $e = $end;
            $primes = array_fill(0, null, null);
            $all = array_fill(0, $e, false);
            for ($i = 2; $i <= sqrt($e); $i++) {
                for ($j = 2 * $i; $j <= $e; $j += $i) {
                    $all[$j] = true;
                }
            }
            for ($i = 2; $i <= $e; $i++) {
                if (!$all[$i])
                    $primes[] = $i;
            }
            return $primes;
        }
        $primes = array_fill(0, null, null);
        for ($i = $start; $i <= $end; $i++) {
            if (gmp_prob_prime($i) === self::ONE || gmp_prob_prime($i) === self::TWO)
                $primes[] = $i;
        }
        return $primes;
    }


    /**
     * @param integer $number
     * @return boolean return true if $number is complete, false if is not
     **/
    public function isComplete($number)
    {
        if ($this->isOdd($number))
            return false;
        $sum = 0;
        for ($i = 1; $i < $number; $i++) {
            if ($number % $i === 0)
                $sum += $i;
        }
        if ($sum === $number)
            return true;
        return false;
    }


    /**
     * @param integer $number
     * @return boolean return true if $number is complete square, false if is not
     **/
    public function isCompleteSquare($number)
    {
        if (($number > 1 && $this->isOdd($number)) || $number === 0)
            return false;
        if ($number === 1)
            return true;
        if (floor(sqrt($number)) === sqrt($number))
            return true;
        return false;
    }


    /**
     * @param float $number
     * @return float|integer return true abs of $number
     **/
    public function abs($number)
    {
        return abs($number);
    }


    /**
     * @param string $number
     * @param integer $to
     * @param integer $from
     * @return string return converted number from base $from to base $to
     */
    public function baseConvert($number, $from, $to)
    {
        return base_convert($number, $from, $to);
    }


    /**
     * @param string $number binary number will be convert to decimal format
     * @return string return decimal number
     */
    public function binToDec($number)
    {
        return bindec($number);
    }


    /**
     * @param integer $number decimal number will be convert to octal format
     * @return string return octal number
     */
    public function decToOct($number)
    {
        return decoct($number);
    }


    /**
     * @param string $number octal number will be convert to decimal format
     * @return integer|float return decimal number
     */
    public function octToDec($number)
    {
        return octdec($number);
    }


    /**
     * @param string $number decimal number will be convert to binary format
     * @return string return binary number
     */
    public function decToBin($number)
    {
        return decbin($number);
    }


    /**
     * @param integer $number decimal number will be convert to hexadecimal format
     * @return string return hexadecimal number
     */
    public function decToHex($number)
    {
        return dechex($number);
    }


    /**
     * @param string $number hexadecimal number will be convert to decimal format
     * @return integer|float return decimal number
     */
    public function hexToDec($number)
    {
        return hexdec($number);
    }


    /**
     * @param float $number float number
     * @return float return rounded float number
     */
    public function round($number)
    {
        return round($number);
    }


    /**
     * @param float $number float number
     * @return float return rounded up to the next highest integer
     */
    public function ceil($number)
    {
        return ceil($number);
    }


    /**
     * @param float $number float number
     * @return float return rounded down to the previous highest integer
     */
    public function floor($number)
    {
        return floor($number);
    }


    /**
     * @param integer|float $number the number will be exp by
     * @param integer|float $exp exponent
     * @return integer|float return the number exponents to $exp
     */
    public function pow($number, $exp)
    {
        return pow($number, $exp);
    }


    /**
     * @param array $arr the array will be search for the maximum item
     * @return float return maximum number in array
     */
    public function findMax($arr)
    {
        $max = $arr[0];
        foreach ($arr as $item)
            if ($item > $max)
                $max = $item;
        return $max;
    }


    /**
     * @param array $arr the array will be search for the minimum item
     * @return float return minimum number in array
     */
    public function findMin($arr)
    {
        $min = $arr[0];
        foreach ($arr as $item)
            if ($item < $min)
                $min = $item;
        return $min;
    }

    /**
     * @param int $min the minimum range
     * @param int $max the maximum range
     * @return string return a random number between $min and $max
     * @throws Exception
     */
    public function generateRandom($min = 0, $max = self::MAX_INT)
    {
        return random_int($min, $max);
    }
}