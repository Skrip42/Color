<?php
namespace Skrip42\Color;

class HexColor extends Color
{
    protected $type = 'Hex';
    private $hex;

    public function __construct(string $hex)
    {
        $this->setHex($hex);
    }

    public function toHex() : HexColor
    {
        return $this;
    }

    public function toRGB() : RGBColor
    {
        $r = hexdec(substr($this->hex, 0, 2));
        $g = hexdec(substr($this->hex, 2, 2));
        $b = hexdec(substr($this->hex, 4, 2));
        return new RGBColor($r, $g, $b);
    }

    public function getHex() : string
    {
        return '#' . $this->hex;
    }

    public function getBase() : string
    {
        return $this->hex;
    }

    public function setHex(string $hex) : self
    {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) !== 6) {
            throw new ColorException('unvalid hex value');
        }
        if (preg_match('~[^\dabcdef]~', $hex)) {
            throw new ColorException('unvalid hex value');
        }
        $this->hex = $hex;
        return $this;
    }

    public function __toString() : string
    {
        return "#{$this->hex}";
    }
}
