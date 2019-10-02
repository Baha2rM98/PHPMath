PHPMath
=======
This library contains efficient classes and methods to calculate mathematical things.

Features
--------
Some of this facilities is solving system of equations, linear, quadratic and cubic equation solver,
work with prime numbers and etc.

You can find more information in documentation.

**[Statistics Class] will be add soon**

Installation
------------
Use [Composer] to install the package:

```
$ composer require baha2rmirzazadeh/phpmath:dev-master
```

Example
-------

```php
use PHPMath\Math\Math;
use PHPMath\Algebra\Algebra;
use PHPMath\Algebra\MatrixFactory;

$math = new Math();
print_r($math->ProbablePrimeNumbersList(20000, 185));
print_r($math->dividable(1858));

$algebra = new Algebra();
print_r($algebra->systemOfLinearEquation([[2, -4, 5], [4, -1, 0], [-2, 2, -3]], [[-33], [-5], [19]]));
print_r($algebra->cubicEquation(1, 2, -1, -2));

$matrix = new MatrixFactory();
print_r($matrix->multiply([[2, 4, 6, -4], [3, 4, 5, 0]], [[1, 2], [1, 3], [12, -85], [-69, 21]]));
print_r($matrix->multiply($matrix->inverse([[1, 2], [3, 4]]), [[1, 2], [3, 4]]));
print_r($matrix->transpose([[1, 2], [3, 4], [5, 6]]));
```

### Classes and Methods description
All of classes and methods have documentation, you can read them and figure out how they work

Authors
-------

* [Bahador Mirzazadeh]
* E-Mail: [baha2r.mirzazadeh98@gmail.com]

License
-------

All contents of this package library are licensed under the [MIT license].   