<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8c904eb4b44c8b9c559c755248d48826
{
    public static $prefixesPsr0 = array (
        'M' => 
        array (
            'Math' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
        'A' => 
        array (
            'Algebra' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit8c904eb4b44c8b9c559c755248d48826::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}