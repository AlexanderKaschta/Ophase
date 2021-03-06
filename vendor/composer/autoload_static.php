<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit87cb2c582dbb4b401cd4ee9923791ab0
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit87cb2c582dbb4b401cd4ee9923791ab0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit87cb2c582dbb4b401cd4ee9923791ab0::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
