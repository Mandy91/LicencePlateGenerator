<?php

require __DIR__ . '/vendor/autoload.php';

if (isset($_GET['text'])) {
    $licencePlateCombination = $_GET['text'];
} else {
    $licencePlateCombination = null;
}

if (isset($_GET['country']) && class_exists("\\LicencePlate\\Country\\Country{$_GET['country']}")) {
    $class = "\\LicencePlate\\Country\\Country{$_GET['country']}";
    $style = new $class($licencePlateCombination);
} else {
    $style = new \LicencePlate\Country\CountryNL($licencePlateCombination);
}


$image = new Imagick();
$image->newImage(1040, 240, new ImagickPixel('white'));




// START TEXT
$fontSize = 100;
$licencePlateText = new \ImagickDraw();
$licencePlateText->setFillColor(new ImagickPixel($style->getFont()->getColor())); // be color ral3003 '#861a22'
$licencePlateText->setFont($style->getFont()->getFont());
$licencePlateText->setFontSize($fontSize);
$licencePlateText->setTextKerning(0);

$fontMetrics = $image->queryFontMetrics($licencePlateText, $style->getFont()->getLicencePlateCombination());
while ($fontMetrics['textWidth'] <= 900 && $fontMetrics['textHeight'] <= 280) {
    $fontMetrics = $image->queryFontMetrics($licencePlateText, $style->getFont()->getLicencePlateCombination());
    $licencePlateText->setFontSize($fontSize);
    $fontSize++;
}

//echo "<pre>";
//var_dump($fontMetrics);
//echo "<pre>";
//die;

$licencePlateText->setGravity( Imagick::GRAVITY_NORTHWEST);

// Calculate the vertical starting position
$posY = floor( (240 - $fontMetrics['textHeight']) / 2 );
$image->annotateImage($licencePlateText,110, $posY, 0, $style->getFont()->getLicencePlateCombination());
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