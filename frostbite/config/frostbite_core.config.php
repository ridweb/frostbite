<?php
ini_set('date.timezone', 'Europe/London');
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'ZfcBase',
        'ZfcUser',
        'MdgMultiUser',
        'Frostbite',
//        'CustomModule',
        'CustomTheme',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './frostbite/core',
            './frostbite/vendor',
            './user_modules',
            './themes',
        ),
        'config_glob_paths' => array(
            './frostbite/config/{,*.}{global,local}.php',
            './user_config/{,*.}{global,local}.php'
        ),

        // Whether or not to enable a configuration cache.
        // If enabled, the merged configuration will be cached and used in
        // subsequent requests.
        //'config_cache_enabled' => $booleanValue,

        // The key used to create the configuration cache file name.
        //'config_cache_key' => $stringKey,

        // Whether or not to enable a module class map cache.
        // If enabled, creates a module class map cache which will be used
        // by in future requests, to reduce the autoloading process.
        //'module_map_cache_enabled' => $booleanValue,

        // The key used to create the class map cache file name.
        //'module_map_cache_key' => $stringKey,

        // The path fin which to cache merged configuration.
        //'cache_dir' => $stringPath,

        // Whether or not to enable modules dependency checking.
        // Enabled by default, prevents usage of modules that depend on other modules
        // that weren't loaded.
        // 'check_dependencies' => true,
    ),
);