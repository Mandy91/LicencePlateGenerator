<?php

namespace LicencePlate\Style;

use LicencePlate\AbstractLicencePlate;

class StyleBE extends AbstractLicencePlate {

    protected $width = 700;
    protected $height = 240;
    protected $countryCode;
    protected $countryCodeSize = 40;

    protected $textWidth = 660;
    protected $textMarginLeft = 10;


    public function render()
    {
        parent::render();
    }

}