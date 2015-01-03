<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 03.01.15
 * Time: 14:00
 */

class RandomGenerator {

  public function getRandom($max)
  {
    if(use_random_org) {
      $this->getRandomFromRandomOrg($max);
    }
    else
    {
      return mt_rand(0,$max);
    }
  }

  public function getRandomFromRandomOrg($max)
  {
    if (!function_exists('curl_init')){
      die('Sorry cURL is not installed!');
    }
    $url = 'https://www.random.org/integers/?num=1&min=0&max=' . $max . '&col=1&base=10&format=plain&rnd=new';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $random_number = curl_exec($ch);
    curl_close($ch);
    return $random_number;
  }

}