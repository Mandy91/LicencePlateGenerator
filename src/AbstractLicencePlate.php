<?php

namespace LicencePlate;

abstract class AbstractLicencePlate
{

    /** @var  \Imagick */
    protected $image;

    protected $height;
    protected $width;
    protected $backgroundColor;
    protected $textColor;
    protected $font;
    protected $textKerning = 0;
    protected $textMarginLeft = 0;
    protected $textMarginTop = 0;
    protected $textWidth = 0;
    protected $textHeight = 0;

    protected $borderColor;
    protected $borderSize = 0;


    public function __construct($combination)
    {
        $this->combination = $combination;
        $this->image = new \Imagick();
        $this->width = $this->width - ($this->borderSize * 2);
        $this->height = $this->height - ($this->borderSize * 2);
        $this->image->newImage($this->width, $this->height, new \ImagickPixel($this->backgroundColor));
    }

    public function render()
    {
        // START TEXT
        $fontSize = 100;
        $licencePlateText = new \ImagickDraw();
        $licencePlateText->setFillColor(new \ImagickPixel($this->textColor));
        $licencePlateText->setFont($this->font);
        $licencePlateText->setFontSize($fontSize);
        $licencePlateText->setTextKerning($this->textKerning);

        $fontMetrics = $this->image->queryFontMetrics($licencePlateText, $this->combination);
        while ($fontMetrics['textWidth'] <= $this->textWidth && $fontMetrics['textHeight'] <= $this->textHeight) {
            $fontMetrics = $this->image->queryFontMetrics($licencePlateText, $this->combination);
            $licencePlateText->setFontSize($fontSize);
            $fontSize++;
        }

        $licencePlateText->setGravity(\Imagick::GRAVITY_NORTHWEST);

        // Calculate the vertical starting position
        $posY = $this->textMarginTop + floor(($this->height - $fontMetrics['textHeight']) / 2);
        $this->image->annotateImage($licencePlateText, $this->textMarginLeft, $posY, 0, $this->combination);
        // END TEXT

        $this->image->setImageFormat('png');
        $this->image->setImageUnits(\Imagick::RESOLUTION_PIXELSPERINCH);
        $this->image->setImageResolution(300,300);

//        $this->image->setImageBorderColor($this->borderColor);
        $this->image->borderImage(new \ImagickPixel($this->borderColor), $this->borderSize, $this->borderSize);

        header('Content-type: image/png');
        echo $this->image;
    }

}