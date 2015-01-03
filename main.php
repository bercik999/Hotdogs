<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 03.01.15
 * Time: 14:18
 */
include 'FrozenHotdog.php';
include 'RandomGenerator.php';
include 'ResultImage.php';

//How many hotdogs we will throw
define('throws_count', 1000);
//How big result image will be
define('img_scale', 2);
//how wide image will be compared to single hotdog
define('img_width_multiplier', 10);
//how many steps will be in final image
define('lines_count', 30);
//use random numbers from random.org - requires cUrl
define('use_random_org', false);


$image = new ResultImage(img_scale);
$crossed = 0;
for($i=1;$i<=throws_count; $i++)
{
  $frozen_hotdog = new FrozenHotdog();
  $frozen_hotdog->toss();
  $image->addHotdog($frozen_hotdog);
  if($frozen_hotdog->isCrossed())
  {
    $crossed++;
  }
}
$pi = (2/$crossed)*$i;
echo "Counted π: $pi based on ".throws_count." throws.";