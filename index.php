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

function get_or_default($key, $default)
{
  if(isset($_GET[$key]) && $_GET[$key])
  {
    define($key, $_GET[$key]);
  }
  else
  {
    define($key, $default);
  }
}

//How many hotdogs we will throw
get_or_default('throws_count', 100);
//How big result image will be
get_or_default('img_scale', 2);
//how wide image will be compared to single hotdog
get_or_default('img_width_multiplier', 10);
//how many steps will be in final image
get_or_default('lines_count', 30);
//use random numbers from random.org - requires cUrl
get_or_default('use_random_org', false);


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
$result = "Counted π: $pi based on ".throws_count." throws.";

?>

<!doctype html>
<html lang="en">
<head>
  <link media="all" type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <meta charset="UTF-8">
  <title>Calculate π by throwing hotdogs</title>
</head>
<body>
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 column">
        <form method="GET" action="index.php" accept-charset="UTF-8" class="form-horizontal" id="comment-form">
          <div class="form-group">
            <label for="throws_count" class="col-sm-2 control-label">Throws count</label>
            <div class="col-sm-10">
              <input class="form-control" name="throws_count" type="text" id="throws_count">
            </div>
          </div>

          <div class="form-group">
            <label for="img_scale" class="col-sm-2 control-label">Image scale</label>
            <div class="col-sm-10">
              <input class="form-control" name="img_scale" type="text" id="img_scale">
            </div>
          </div>

          <div class="form-group">
            <label for="img_width_multiplier" class="col-sm-2 control-label">Image width multiplier</label>
            <div class="col-sm-10">
              <input class="form-control" name="img_width_multiplier" type="text" id="img_width_multiplier">
            </div>
          </div>

          <div class="form-group">
            <label for="lines_count" class="col-sm-2 control-label">Lines count</label>
            <div class="col-sm-10">
              <input class="form-control" name="lines_count" type="text" id="lines_count">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input class="btn btn-default" type="submit" value="Throw!">
            </div>
          </div>
        </form>
        <p><?php echo $result ?></p>
        <img class="img-responsive" src="data:image/x-icon;base64,<?php echo base64_encode($image->output()); ?>"/>
      </div>
    </div>
  </div>
</body>
</html>