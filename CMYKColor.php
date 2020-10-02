<?php
namespace Skrip42\Color;

class CMYKColor extends Color
{
    protected $type = 'CMYK';
    private $cyan;
    private $magenta;
    private $yellow;
    private $key;

    public function __construct(
        float $cyan,
        float $magenta,
        float $yellow,
        float $key
    ) {
        $this->setCyan($cyan)
            ->setMagenta($magenta)
            ->setYellow($yellow)
            ->setKey($key);
    }

    public function toCMYK() : CMYKColor
    {
        return $this;
    }

    public function toRGB() : RGBColor
    {
        $r = 255 * (1 - $this->cyan) * (1 - $this->key);
        $g = 255 * (1 - $this->magenta) * (1 - $this->key);
        $b = 255 * (1 - $this->yellow) * (1 - $this->key);

        return new RGBColor(
            round($r),
            round($g),
            round($b)
        );
    }

    public function getCyan() : float
    {
        return $this->cyan;
    }

    public function setCyan(float $cyan) : self
    {
        if ($cyan > 1 || $cyan < 0) {
            throw new ColorException('unvalid cyan value');
        }
        $this->cyan = $cyan;
        return $this;
    }

    public function getMagenta() : float
    {
        return $this->magenta;
    }

    public function setMagenta(float $magenta) : self
    {
        if ($magenta > 1 || $magenta < 0) {
            throw new ColorException('unvalid magenta value');
        }
        $this->magenta = $magenta;
        return $this;
    }

    public function getYellow() : float
    {
        return $this->yellow;
    }

    public function setYellow(float $yellow) : self
    {
        if ($yellow > 1 || $yellow < 0) {
            throw new ColorException('unvalid yellow value');
        }
        $this->yellow = $yellow;
        return $this;
    }

    public function getKey() : float
    {
        return $this->key;
    }

    public function setKey(float $key) : self
    {
        if ($key > 1 || $key < 0) {
            throw new ColorException('unvalid key value');
        }
        $this->key = $key;
        return $this;
    }

    public function __toString() : string
    {
        return "cmyk({$this->cyan}, {$this->magenta}, {$this->yellow}, {$this->key})";
    }
}
