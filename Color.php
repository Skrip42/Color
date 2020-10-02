<?php
namespace Skrip42\Color;

abstract class Color
{
    protected $type = '';

    public function getType()
    {
        return $type;
    }
    public function toCMYK() : CMYKColor
    {
        return $this->toRGB()->toCMYK();
    }

    public function toHex() : HexColor
    {
        return $this->toRGB()->toHex();
    }

    public function toHSL() : HSLColor
    {
        return $this->toRGB()->toHSL();
    }

    public function toHSV() : HSVColor
    {
        return $this->toRGB()->toHSV();
    }

    abstract public function toRGB() : RGBColor;
}
