<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 9/9/2019
 **/

namespace PHPMath;


use Exception;

//TODO: add inner php functions
class Math
{
    public const PI = M_PI;
    public const E = M_E;
    public const ZERO = 0;
    public const ONE = 1;


    /*
     * private fields for inner usage
     */
    private const _180 = 180;
    private const ACCURACY = 1000;
    private const HALF_PI = M_PI_2;


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
     * @return float Nth root of this $value
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
        if ($x % 2 === 0)
            return true;
        return false;
    }


    /**
     * @param integer $x
     * @return boolean return true if &x is odd, return false if is even
     */
    public function isOdd($x)
    {
        if (!$this->isEven($x))
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
     * @return boolean return true if $n is probably prime, false if $n is composite
     * @throws Exception
     * @uses Miller-Robin algorithm
     */
    public function isPrime($n, $accuracy)
    {
        if (strlen($n) > 34)
            throw new Exception("the number is too big!");
        if ($n <= 1 || $n === 4)
            return false;
        if ($n <= 3)
            return true;
        $d = $n - 1;
        while ($d % 2 === 0)
            $d /= 2;
        for ($i = 0; $i < $accuracy; $i++)
            if (!$this->millerRabinTest($d, $n))
                return false;
        return true;
    }


    /**
     * @param integer $end starts from $start to end and detects prime numbers
     * @param null $start if start is null it it will be consider 2
     * @return array return an array includes prime numbers from start to end
     * @throws Exception
     */
    public function primeNumbersList($end, $start = null)
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
            if ($this->isPrime($i, self::ACCURACY))
                $primes[] = $i;
        }
        return $primes;
    }
}