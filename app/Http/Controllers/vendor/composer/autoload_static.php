<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite24609f1b8279b04fec0db3158c74378
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite24609f1b8279b04fec0db3158c74378::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite24609f1b8279b04fec0db3158c74378::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
