<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6a1bde025e4607c2be90de3f36a668b1
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'J' => 
        array (
            'Jotad\\Lamadriguera\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'Jotad\\Lamadriguera\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6a1bde025e4607c2be90de3f36a668b1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6a1bde025e4607c2be90de3f36a668b1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6a1bde025e4607c2be90de3f36a668b1::$classMap;

        }, null, ClassLoader::class);
    }
}
