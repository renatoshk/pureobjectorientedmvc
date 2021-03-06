<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1589510307e9d2ba7a8cc54dbd93ce54
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
        'App\\Controllers\\AdminController' => __DIR__ . '/../..' . '/app/controllers/AdminController.php',
        'App\\Controllers\\CategoriesController' => __DIR__ . '/../..' . '/app/controllers/CategoriesController.php',
        'App\\Controllers\\PagesController' => __DIR__ . '/../..' . '/app/controllers/PagesController.php',
        'App\\Controllers\\PostsController' => __DIR__ . '/../..' . '/app/controllers/PostsController.php',
        'App\\Controllers\\RolesController' => __DIR__ . '/../..' . '/app/controllers/RolesController.php',
        'App\\Controllers\\UsersController' => __DIR__ . '/../..' . '/app/controllers/UsersController.php',
        'App\\Libraries\\BaseController' => __DIR__ . '/../..' . '/app/libraries/BaseController.php',
        'App\\Libraries\\Core' => __DIR__ . '/../..' . '/app/libraries/Core.php',
        'App\\Libraries\\Database' => __DIR__ . '/../..' . '/app/libraries/Database.php',
        'App\\Models\\Category' => __DIR__ . '/../..' . '/app/models/Category.php',
        'App\\Models\\Post' => __DIR__ . '/../..' . '/app/models/Post.php',
        'App\\Models\\User' => __DIR__ . '/../..' . '/app/models/User.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1589510307e9d2ba7a8cc54dbd93ce54::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1589510307e9d2ba7a8cc54dbd93ce54::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1589510307e9d2ba7a8cc54dbd93ce54::$classMap;

        }, null, ClassLoader::class);
    }
}
