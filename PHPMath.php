<?php

/**
 * @author Baha2r
 * @license MIT
 * Date: 9/9/2019
 **/

namespace PHPMath;

class PHPMath
{
    public const PI = M_PI;
    public const E = M_E;
    public const ZERO = 0.0;
    public const ONE = 1.0;
    private const _180 = 180.0;
    private const HALF_PI = M_PI_2;


    /**
     * constructor
     **/
    public function __construct()
    {
    }


    /**
     * @param float $value in radian
     * @param boolean $radian (true if arg is radian and false if arg is degree)
     * @return float (sin) of value in float
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
     * @return float (cos) of value in float
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
     * @return float (tan) of value in float
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
     * @return float (cot) of value in float
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
     * @return float (sinh) of value in float
     */
    public function sinh($value)
    {
        return sinh($value);
    }


    /**
     * @param float $value in radian
     * @return float (cosh) of value in float
     */
    public function cosh($value)
    {
        return cosh($value);
    }


    /**
     * @param float $value in radian
     * @return float (tanh) of value in float
     */
    public function tanh($value)
    {
        return tanh($value);
    }


    /**
     * @param float $value in radian
     * @return float (coth) of value in float
     */
    public function coth($value)
    {
        return (self::ONE / tanh($value));
    }


    /**
     * @param float $value
     * @param boolean $radian (true if returned angle is degree, false if returned angle is radian)
     * @return float arcsin of value
     */
    public function arcsin($value, $radian = true)
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
     * @return float arccos of value
     */
    public function arccos($value, $radian = true)
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
     * @return float arctan of value
     */
    public function arctan($value, $radian = true)
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
     * @return float arccot of value
     */
    public function arccot($value, $radian = true)
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
     * @return float arcsinh of value in float
     */
    public function arcsinh($value)
    {
        return asinh($value);
    }


    /**
     * @param float $value
     * @return float arccosh of value in float
     */
    public function arccosh($value)
    {
        return acosh($value);
    }


    /**
     * @param float $value
     * @return float arctanh of value in float
     */
    public function arctanh($value)
    {
        return atanh($value);
    }


    /**
     * @param float $value
     * @return float arctanh of value in float
     */
    public function arccoth($value)
    {
        return (self::ONE / atanh($value));
    }
}