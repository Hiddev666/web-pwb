<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit59c2a9bdf2670ddb258d38060ae4580d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit59c2a9bdf2670ddb258d38060ae4580d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit59c2a9bdf2670ddb258d38060ae4580d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit59c2a9bdf2670ddb258d38060ae4580d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
