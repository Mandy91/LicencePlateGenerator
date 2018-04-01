<?php

namespace LicencePlate\Country;

use LicencePlate\Style\StyleEU;

class CountryBE extends StyleEU {

    protected $backgroundColor = 'white';
    protected $textColor = '#861a22';
    protected $font = __DIR__ . '/../../fonts/prismtone_ptf-nordic/PTF-NORDIC-Rnd.ttf';
    protected $textKerning = 0;
    protected $countryCode = 'B';

    protected $textWidth = 900;
    protected $textHeight = 280;
    protected $textMarginTop = 20;

    protected $borderColor = '#861a22';
    protected $borderSize = 4;
}