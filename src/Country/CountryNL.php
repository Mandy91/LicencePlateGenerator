<?php

namespace LicencePlate\Country;

use LicencePlate\Style\StyleEU;

class CountryNL extends StyleEU {

    protected $backgroundColor = 'yellow';
    protected $textColor = 'black';
//    protected $textColor = '#861a22';
    protected $font = __DIR__ . '/../../fonts/lefly-fonts_kenteken/Kenteken.ttf';
    protected $textKerning = -16;
    protected $countryCode = 'NL';

    protected $textWidth = 900;
    protected $textHeight = 280;
    protected $textMarginTop = 5;

}