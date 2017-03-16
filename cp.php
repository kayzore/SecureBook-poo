<?php
$files = array(
    'font-awesome.css' => array(
        'css',
        'vendor/external/libs/font-awesome/css/font-awesome.css'
    ),
    'FontAwesome.otf' => array(
        'fonts',
        'vendor/external/libs/font-awesome/fonts/FontAwesome.otf'
    ),
    'fontawesome-webfont.eot' => array(
        'fonts',
        'vendor/external/libs/font-awesome/fonts/fontawesome-webfont.eot'
    ),
    'fontawesome-webfont.ttf' => array(
        'fonts',
        'vendor/external/libs/font-awesome/fonts/fontawesome-webfont.ttf'
    ),
    'fontawesome-webfont.svg' => array(
        'fonts',
        'vendor/external/libs/font-awesome/fonts/fontawesome-webfont.svg'
    ),
    'fontawesome-webfont.woff' => array(
        'fonts',
        'vendor/external/libs/font-awesome/fonts/fontawesome-webfont.woff'
    ),
    'fontawesome-webfont.woff2' => array(
        'fonts',
        'vendor/external/libs/font-awesome/fonts/fontawesome-webfont.woff2'
    ),
    'jquery.min.js' => array(
        'js',
        'vendor/external/libs/jquery/dist/jquery.min.js'
    ),
    'bootstrap.min.css' => array(
        'css',
        'vendor/external/libs/bootstrap/dist/css/bootstrap.min.css'
    ),
    'bootstrap-theme.min.css' => array(
        'css',
        'vendor/external/libs/bootstrap/dist/css/bootstrap-theme.min.css'
    ),
    'bootstrap.min.js' => array(
        'js',
        'vendor/external/libs/bootstrap/dist/js/bootstrap.min.js'
    ),
    'glyphicons-halfings-regular.eot' => array(
        'fonts',
        'vendor/external/libs/bootstrap/dist/fonts/glyphicons-halflings-regular.eot'
    ),
    'glyphicons-halfings-regular.svg' => array(
        'fonts',
        'vendor/external/libs/bootstrap/dist/fonts/glyphicons-halflings-regular.svg'
    ),
    'glyphicons-halfings-regular.ttf' => array(
        'fonts',
        'vendor/external/libs/bootstrap/dist/fonts/glyphicons-halflings-regular.ttf'
    ),
    'glyphicons-halfings-regular.woff' => array(
        'fonts',
        'vendor/external/libs/bootstrap/dist/fonts/glyphicons-halflings-regular.woff'
    ),
    'glyphicons-halfings-regular.woff2' => array(
        'fonts',
        'vendor/external/libs/bootstrap/dist/fonts/glyphicons-halflings-regular.woff2'
    ),
    'jquery.autogrowtextarea.min.js' => array(
        'js',
        'vendor/external/libs/autogrow-textarea/jquery.autogrowtextarea.min.js'
    ),
);

if (!is_dir('web/assets/')) {
    createDir('web/assets/');
}
if (!is_dir('web/assets/external/')) {
    createDir('web/assets/external/');
}

if (is_dir('web/assets/external/')) {
    foreach ($files as $name => $file) {
        if (!is_dir('web/assets/external/' . $file[0] . '/')) {
            createDir('web/assets/external/' . $file[0] . '/');
        }
        copyFile($file[1], $file[0], $name);
    }
}

function copyFile($old_file, $type, $new_file) {
    if (copy($old_file, 'web/assets/external/' . $type . '/' . $new_file)) {
        echo "Copy => '$old_file' to 'web/assets/external/$type/$new_file'\n";
    } else {
        echo "[ERROR] Failed Copy => '$old_file' to 'web/assets/external/$type/$new_file'\n";
    }
}
function createDir($path) {
    if (mkdir($path)) {
        echo "Create directory => '$path'\n";
    } else {
        echo "[ERROR] Failed Create directory => '$path'\n";
    }
}