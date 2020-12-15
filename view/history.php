<?php

namespace Joakim\View;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<?= var_dump($data); ?>
<h1><?= date("l", $data[0]["dt"]) ?></h1>
<img src="http://openweathermap.org/img/wn/<?= $data[0]["icon"] ?>@2x.png" alt=<?= $data[0]["description"] ?> srcset="">
<ul>Tempratur: <?= $data[0]["temp"] ?>°C</ul>
<ul>Luftfuktighet: <?= $data[0]["humidity"] ?>%</ul>
<ul>Vind: <?= $data[0]["windSpeed"] ?>m/s</ul>

<h1><?= date("l", $data[1]["dt"]) ?></h1>
<img src="http://openweathermap.org/img/wn/<?= $data[1]["icon"] ?>@2x.png" alt=<?= $data[1]["description"] ?> srcset="">
<ul>Tempratur: <?= $data[1]["temp"] ?>°C</ul>
<ul>Luftfuktighet: <?= $data[1]["humidity"] ?>%</ul>
<ul>Vind: <?= $data[1]["windSpeed"] ?>m/s</ul>


<h1><?= date("l", $data[2]["dt"]) ?></h1>
<img src="http://openweathermap.org/img/wn/<?= $data[2]["icon"] ?>@2x.png" alt=<?= $data[2]["description"] ?> srcset="">
<ul>Tempratur: <?= $data[2]["temp"] ?>°C</ul>
<ul>Luftfuktighet: <?= $data[2]["humidity"] ?>%</ul>
<ul>Vind: <?= $data[2]["windSpeed"] ?>m/s</ul>


<h1><?= date("l", $data[3]["dt"]) ?></h1>
<img src="http://openweathermap.org/img/wn/<?= $data[3]["icon"] ?>@2x.png" alt=<?= $data[3]["description"] ?> srcset="">
<ul>Tempratur: <?= $data[3]["temp"] ?>°C</ul>
<ul>Luftfuktighet: <?= $data[3]["humidity"] ?>%</ul>
<ul>Vind: <?= $data[3]["windSpeed"] ?>m/s</ul>

<h1><?= date("l", $data[4]["dt"]) ?></h1>
<img src="http://openweathermap.org/img/wn/<?= $data[4]["icon"] ?>@2x.png" alt=<?= $data[4]["description"] ?> srcset="">
<ul>Tempratur: <?= $data[4]["temp"] ?>°C</ul>
<ul>Luftfuktighet: <?= $data[4]["humidity"] ?>%</ul>
<ul>Vind: <?= $data[4]["windSpeed"] ?>m/s</ul>
