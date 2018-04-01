<?php

require __DIR__ . '/vendor/autoload.php';

if (isset($_GET['text'])) {
    $licencePlateCombination = $_GET['text'];
} else {
    $licencePlateCombination = "2-ABC-735";
}


$fonts = [
    "PTF-NORDIC-Rnd" => __DIR__ . '/fonts/prismtone_ptf-nordic/PTF-NORDIC-Rnd-Lt.ttf',
    'kenteken' => __DIR__ . '/fonts/lefly-fonts_kenteken/Kenteken.ttf'
];

if (isset($_GET['font']) && isset ($fonts[$_GET['font']])) {
    $font = $fonts[$_GET['font']];
} else {
    $font = $fonts['PTF-NORDIC-Rnd'];
}



$image = new Imagick();
$image->newImage(1040, 240, new ImagickPixel('white'));

// START TEXT
$licencePlateText = new \ImagickDraw();
$licencePlateText->setFillColor(new ImagickPixel('#861a22'));
$licencePlateText->setFont($font);
$licencePlateText->setFontSize(210);
$licencePlateText->setTextKerning(0);

$image->annotateImage($licencePlateText, 120, 195, 0, $licencePlateCombination);
// END TEXT


// START BLUE BAR
$blueBar = new \ImagickDraw();
$blueBar->setFillColor(new ImagickPixel('#0000ff'));
$blueBar->rectangle(0, 0, 100, 240);

$blueBar->setFillColor(new ImagickPixel('#ffffff'));
$blueBar->setFontSize(80);
$licencePlateText->setFont('ArialNarrow');
$blueBar->setFontWeight(800);
$blueBar->annotation(20, 220, 'B');
//$blueBar->composite(100, 20, 30, 40, 50, $image);
//$image->drawImage($blueBar);

$image->drawImage($blueBar);

// END BLUE BAR


$image->setImageFormat('png');
$image->setImageUnits(imagick::RESOLUTION_PIXELSPERINCH);
$image->setImageResolution(300,300);
//$image->
header('Content-type: image/png');
echo $image;