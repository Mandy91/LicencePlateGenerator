<?php

namespace LicencePlate\Country;

use LicencePlate\Style\StyleBE;

class NonEUCountryBE extends StyleBE {

    protected $backgroundColor = 'white';
    protected $textColor = '#DA1219';
    protected $font = __DIR__ . '/../../fonts/prismtone_ptf-nordic/PTF-NORDIC-Rnd.ttf';
    protected $textKerning = 0;
    protected $countryCode = 'B';

    protected $textHeight = 280;
    protected $textMarginTop = 14;

    protected $borderColor = '#DA1219';
    protected $borderSize = 4;
}