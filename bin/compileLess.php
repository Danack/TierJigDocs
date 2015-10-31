<?php


require __DIR__.'/../vendor/autoload.php';

$parser = new Less_Parser();

$cacheDir = __DIR__.'/../var/cache/less';

@mkdir($cacheDir, 0755, true);

$codeThemes = [
    "code_highlight_danack",
    "code_highlight_solarized_light",
    "code_highlight_solarized_dark",
];




$compileItems = [
    __DIR__."/../data/less/bootstrap/bootstrap.less" => __DIR__.'/../public/css/bootstrap.css',
    __DIR__."/../data/less/bootstrap/theme.less" => __DIR__.'/../public/css/bootstrap-theme.css',
];

foreach ($codeThemes as $codeTheme) {
    $key = __DIR__."/../data/less/code/$codeTheme.less";
    $value = __DIR__."/../public/css/$codeTheme.css";
    $compileItems[$key] = $value;
}


foreach ($compileItems as $input => $output) {
    $cacheSetting = array( $input => './mysite/' );
    Less_Cache::$cache_dir = $cacheDir;
    $cssFileName = Less_Cache::Get( $cacheSetting );    
    echo "$cssFileName \n";
    $compiled = file_get_contents( $cacheDir.'/'.$cssFileName );
    file_put_contents($output, $compiled);
}
