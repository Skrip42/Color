<?php
namespace Skrip42\Color;

class RGBColor extends Color
{
    protected $type = 'RGBColor';
    private $red;
    private $green;
    private $blue;

    public function __construct(int $red = 0, int $green = 0, int $blue = 0)
    {
        $this->setRed($red)
             ->setGreen($green)
             ->setBlue($blue);
    }

    public function toRGB() : RGBColor
    {
        return $this;
    }

    public function toHex() : HexColor
    {
        return new HexColor(
            '#'
                . str_pad(dechex($this->red), 2, '0', STR_PAD_LEFT)
                . str_pad(dechex($this->green), 2, '0', STR_PAD_LEFT)
                . str_pad(dechex($this->blue), 2, '0', STR_PAD_LEFT)
        );
    }

    public function toCMYK() : CMYKColor
    {
        $r = $this->red / 255;
        $g = $this->green / 255;
        $b = $this->blue / 255;

        $key = 1 - max($r, $g, $b);
        $cyan = (1 - $r - $key) / (1 - $key);
        $magenta = (1 - $g - $key) / (1 - $key);
        $yellow = (1 - $b - $key) / (1 - $key);

        return new CMYKColor(
            round($cyan, 2),
            round($magenta, 2),
            round($yellow, 2),
            round($key, 2)
        );
    }

    public function toHSV() : HSVColor
    {
        $r = $this->red   / 255;
        $g = $this->green / 255;
        $b = $this->blue  / 255;
        $cmax = max($r, $g, $b);
        $cmin = min($r, $g, $b);
        $d = $cmax - $cmin;
        if ($d == 0) {
            $hue = 0;
        } else if ($cmax == $r) {
            $hue = 60 * fmod(($g - $b) / $d, 6);
        } else if ($cmax == $g) {
            $hue = 60 * (($b - $r) / $d + 2);
        } else if ($cmax == $b) {
            $hue = 60 * (($r - $g) / $d + 4);
        }

        //$lig = ($cmax + $cmin) / 2;

        if ($cmax == 0) {
            $sat = 0;
        } else {
            $sat = $d / $cmax;
        }

        $val = $cmax;

        return new HSVColor(
            round($hue),
            round($sat, 2),
            round($val, 2)
        );
    }

    public function toHSL() : HSLColor
    {
        $r = $this->red   / 255;
        $g = $this->green / 255;
        $b = $this->blue  / 255;
        $cmax = max($r, $g, $b);
        $cmin = min($r, $g, $b);
        $d = $cmax - $cmin;
        if ($d == 0) {
            $hue = 0;
        } else if ($cmax == $r) {
            $hue = 60 * fmod(($g - $b) / $d, 6);
        } else if ($cmax == $g) {
            $hue = 60 * (($b - $r) / $d + 2);
        } else if ($cmax == $b) {
            $hue = 60 * (($r - $g) / $d + 4);
        }

        $lig = ($cmax + $cmin) / 2;

        if ($d == 0) {
            $sat = 0;
        } else {
            $sat = $d / (1 - abs(2 * $lig - 1));
        }

        return new HSLColor(
            round($hue),
            round($sat, 2),
            round($lig, 2)
        );
    }

    public function getRed() : int
    {
        return $this->red;
    }

    public function setRed(int $red) : self
    {
        if ($red < 0 || $red > 255) {
            throw new ColorException('unvalid red value');
        }
        $this->red = $red;
        return $this;
    }

    public function getGreen() : int
    {
        return $this->green;
    }

    public function setGreen(int $green) : self
    {
        if ($green < 0 || $green > 255) {
            throw new ColorException('unvalid green value');
        }
        $this->green = $green;
        return $this;
    }

    public function getBlue() : int
    {
        return $this->blue;
    }

    public function setBlue(int $blue) : self
    {
        if ($blue < 0 || $blue > 255) {
            throw new ColorException('unvalid blue value');
        }
        $this->blue = $blue;
        return $this;
    }

    public function __toString() : string
    {
        return "rgb({$this->red}, {$this->green}, {$this->blue})";
    }
}
