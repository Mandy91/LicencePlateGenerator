<?php

namespace LicencePlate\Style;

use LicencePlate\AbstractLicencePlate;

class StyleEU extends AbstractLicencePlate {

    protected $width = 1040;
    protected $height = 240;
    protected $countryCode;
    protected $countryCodeSize = 40;

    protected $textWidth = 900;
    protected $textMarginLeft = 110;



    public function render()
    {
        $blueBarWidth = 100;
        // START BLUE BAR
        $blueBar = new \ImagickDraw();
        $blueBar->setFillColor(new \ImagickPixel('#0000ff'));
        $blueBar->rectangle(0, 0, $blueBarWidth, $this->height);

        $blueBar->setFillColor(new \ImagickPixel('#ffffff'));
        $blueBar->setFontSize($this->countryCodeSize);
        $blueBar->setFont('Arial');
        $blueBar->setFontWeight(800);

        $fontMetrics = $this->image->queryFontMetrics($blueBar, $this->countryCode);

        $posX = floor(($blueBarWidth - $fontMetrics['textWidth']) / 2);

        $blueBar->annotation($posX, $this->height - 20, $this->countryCode);
        $blueBar->setGravity(\Imagick::GRAVITY_CENTER);
        //$blueBar->composite(100, 20, 30, 40, 50, $image);
        //$image->drawImage($blueBar);

        $this->image->drawImage($blueBar);

        parent::render();
    }

}