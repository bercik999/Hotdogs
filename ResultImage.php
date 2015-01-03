<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 03.01.15
 * Time: 14:00
 */

class ResultImage {

  private $scale;
  private $line_count;
  private $width;
  private $height;
  private $black;
  private $blue;
  private $white;

  public function __construct($scale = 10)
  {
    $this->scale = $scale;

    $this->width = FrozenHotdog::length * $scale * img_width_multiplier;
    $this->height = FrozenHotdog::length * lines_count * $scale;

    $this->img = imagecreatetruecolor($this->width, $this->height);
    $this->black = imagecolorallocate($this->img, 0, 0, 0);
    $this->blue = imagecolorallocate($this->img, 0, 0, 255);
    $this->white = imagecolorallocate($this->img, 255, 255, 255);
    $this->red = imagecolorallocate($this->img, 255, 0, 0);

    imagefilledrectangle($this->img,0,0,$this->width,$this->height,$this->white);
    for($x=1;$x*FrozenHotdog::length*$scale < $this->height;$x++)
    {
      $y = FrozenHotdog::length*$x*$this->scale;
      imageline($this->img, 0, $y, $this->width, $y, $this->black);
    }
  }

  public function addHotdog(FrozenHotdog $hotdog)
  {
    $start = $hotdog->getStart();
    $end = $hotdog->getEnd();
    $scale = $this->scale;
    if($hotdog->isCrossed()){
      $color = $this->red;
    }
    else
    {
      $color = $this->blue;
    }
    imageline($this->img,$start['x']*$scale,$start['y']*$scale,$end['x']*$scale,$end['y']*$scale,$color);
  }

  public function save($filename = 'result')
  {
    imagejpeg($this->img,"$filename.jpg",100);
  }

  public function output()
  {
    ob_start();
    imagejpeg($this->img);
    return ob_get_clean();
  }

}