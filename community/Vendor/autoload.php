<?php
spl_autoload_register(function ($class) {
    $mappings = [
        'Connection\\Get\\'               => __DIR__ . '/../Connection/',
        'Usermodels\\V1\\Usercontrollers\\'       => __DIR__. '/../Usermodels/V1/Usercontrollers/',
        'Helper\\' => __DIR__.'/../Helper/',
        'Response\\' => __DIR__.'/../Response/',
        'Token\\' => __DIR__.'/../Token/'
    ];

    foreach ($mappings as $prefix => $base_dir) {
        $len = strlen($prefix);
        if (strncmp($class, $prefix, $len) === 0) {
            $relative_class = substr($class, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            if (file_exists($file)) {
                require $file;
            } else {
                error_log("Autoload failed: $file not found");
            }
        }
    }
});
?>
