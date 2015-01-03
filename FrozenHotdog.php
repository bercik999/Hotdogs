<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 03.01.15
 * Time: 14:00
 */

class FrozenHotdog {

  private $start;
  private $end;

  /**
   * @return mixed
   */
  public function getStart()
  {
    return $this->start;
  }

  /**
   * @return mixed
   */
  public function getEnd()
  {
    return $this->end;
  }

  private $use_random_org;
  const length = 10;

  public function __construct($use_random_org = false)
  {
    $this->use_random_org = $use_random_org;
  }

  public function toss()
  {
    $random_generator = new RandomGenerator();
    $angle = $random_generator->getRandom(36000)/100;

    $this->start['y'] = $random_generator->getRandom(self::length * lines_count *100)/100;
    $this->end['y'] = $this->start['y'] + self::length * cos(deg2rad($angle));

    $this->start['x'] = $random_generator->getRandom(self::length * (img_width_multiplier - 1));
    $this->end['x'] = $this->start['x'] + self::length * sin(deg2rad($angle));
  }

  public function isCrossed()
  {
    $start_line = floor($this->start['y'] / self::length);
    $end_line = floor($this->end['y'] / self::length);
    if($start_line - $end_line != 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}