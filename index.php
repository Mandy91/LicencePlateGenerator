<?php

require __DIR__ . '/vendor/autoload.php';

if (isset($_GET['text'])) {
    $licencePlateCombination = $_GET['text'];
} else {
    $licencePlateCombination = null;
}


$country = isset($_GET['country']) ? $_GET['country'] : '';
if (class_exists("\\LicencePlate\\Country\\$country")) {
    $class = "\\LicencePlate\\Country\\$country";
    $style = new $class($licencePlateCombination);
} else {
    $style = new \LicencePlate\Country\CountryNL($licencePlateCombination);
}


$style->render();
