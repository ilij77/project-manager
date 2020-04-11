<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita680bba65dde1e59686cbcc53cfb94b3
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita680bba65dde1e59686cbcc53cfb94b3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita680bba65dde1e59686cbcc53cfb94b3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
