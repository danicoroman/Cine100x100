<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb6c0acb34c3ef7335ba1b5e99cd7b319
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Cine100x100\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Cine100x100\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb6c0acb34c3ef7335ba1b5e99cd7b319::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb6c0acb34c3ef7335ba1b5e99cd7b319::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb6c0acb34c3ef7335ba1b5e99cd7b319::$classMap;

        }, null, ClassLoader::class);
    }
}