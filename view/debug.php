<?php

namespace Joakim\View;

use function Anax\View\url;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1><?= date("l", $data["dt"]) ?></h1>
<img src="http://openweathermap.org/img/wn/<?= $data["icon"] ?>@2x.png" alt=<?= $data["description"] ?> srcset="">
<ul>Tempratur: <?= $data["temp"] ?>°C</ul>
<ul>Luftfuktighet: <?= $data["humidity"] ?>%</ul>
<ul>Vind: <?= $data["windSpeed"] ?>m/s</ul>
<?= var_dump($data) ?>