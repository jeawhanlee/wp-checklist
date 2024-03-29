<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite96417c769a1ad08359890edeb09951c
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WP_Checklist\\' => 13,
        ),
        'D' => 
        array (
            'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 55,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WP_Checklist\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
        'Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\' => 
        array (
            0 => __DIR__ . '/..' . '/dealerdirect/phpcodesniffer-composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite96417c769a1ad08359890edeb09951c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite96417c769a1ad08359890edeb09951c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite96417c769a1ad08359890edeb09951c::$classMap;

        }, null, ClassLoader::class);
    }
}
