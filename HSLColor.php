<?php
namespace Skrip42\Color;

class HSLColor extends Color
{
    protected $type = 'HSL';
    private $hue;
    private $saturation;
    private $lightness;

    public function __construct(int $hue = 0, float $saturation = 1, float $lightness = 0)
    {
        $this->setHue($hue)
             ->setSaturation($saturation)
             ->setLightness($lightness);
    }

    public function toHSL() : HSLColor
    {
        return $this;
    }

    public function toRGB() : RGBColor
    {
        $hue_range = (int) ($this->hue / 60);
        $c = (1 - abs(2 * $this->lightness - 1)) * $this->saturation;
        $x = $c * (1 - abs(fmod(($this->hue/ 60), 2) - 1));
        $m = ($this->lightness - $c/2);
        $rgb = [0, 0, 0];
        switch ($hue_range) {
            case 0: //hue < 60
                $rgb = [$c, $x, 0];
                break;
            case 1: //hue < 120
                $rgb = [$x, $c, 0];
                break;
            case 2: //hue < 180
                $rgb = [0, $c, $x];
                break;
            case 3: //hue < 240
                $rgb = [0, $x, $c];
                break;
            case 4: //hue < 300
                $rgb = [$x, 0, $c];
                break;
            case 5: //hue < 360
                $rgb = [$c, 0, $x];
                break;
        }
        foreach ($rgb as &$a) {
            $a = (int) round((($a + $m) * 255));
        }
        return new RGBColor($rgb[0], $rgb[1], $rgb[2]);
    }

    public function getHue() : int
    {
        return $this->hue;
    }

    public function setHue(int $hue) : self
    {
        if ($hue < 0 || $hue > 359) {
            throw new ColorException('unvalid hue value');
        }
        $this->hue = $hue;
        return $this;
    }

    public function getSaturation() : float
    {
        return $this->saturation;
    }

    public function setSaturation(float $saturation) : self
    {
        if ($saturation < 0 || $saturation > 1) {
            throw new ColorException('unvalid saturation value');
        }
        $this->saturation = $saturation;
        return $this;
    }

    public function getLightness() : float
    {
        return $this->lightness;
    }

    public function setLightness(float $lightness) : self
    {
        if ($lightness < 0 || $lightness > 1) {
            throw new ColorException('unvalid lightness value');
        }
        $this->lightness = $lightness;
        return $this;
    }

    public function __toString() : string
    {
        return "hsl({$this->hue}, {$this->saturation}, {$this->lightness})";
    }
}
