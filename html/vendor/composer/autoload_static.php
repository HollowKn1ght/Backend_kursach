<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit41d3830fd2520776c8f35586a3efbd87
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit41d3830fd2520776c8f35586a3efbd87::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit41d3830fd2520776c8f35586a3efbd87::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit41d3830fd2520776c8f35586a3efbd87::$classMap;

        }, null, ClassLoader::class);
    }
}
