<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd61cd6c4fe18179062f4e62a11f2ec81
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd61cd6c4fe18179062f4e62a11f2ec81::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd61cd6c4fe18179062f4e62a11f2ec81::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
