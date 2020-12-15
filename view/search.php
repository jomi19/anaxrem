<?php

namespace Joakim\View;

use function Anax\View\url;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1>Väder</h1>
<p>Kolla väder nuvarande väder</p>
<form method="post" action=<?= url("weather/current") ?>>
    <input type="text" name="ip" >
    <input type="text" name="city" placeholder="Ortsnamn">
    <input type="submit" value="Check">
    <input type="submit" name="ip" value="185.49.132.3">
</form>

<p>Kolla väder historik</p>
<form method="post" action=<?= url("weather/history") ?>>
    <input type="text" name="ip" >
    <input type="submit" value="Check">
    <input type="submit" name="ip" value="185.49.132.3">
</form>
<?= var_dump($data); ?>
<h2>Get Json-response</h2>
<p>Kolla väder nuvarande väder</p>
<form method="post" action=<?= url("jsonweather/current") ?>>
    <input type="text" name="ip" >
    <input type="text" name="city" placeholder="Ortsnamn">
    <input type="submit" value="Check">
    <input type="submit" name="ip" value="185.49.132.3">
</form>

<p>Kolla väder historik</p>
<form method="post" action=<?= url("jsonweather/history") ?>>
    <input type="text" name="ip" >
    <input type="submit" value="Check">
    <input type="submit" name="ip" value="185.49.132.3">
</form>
<h3>
       POST <?= url("jsonip/data")  ?>
</h3>
<p>
       Body ip: The ip you want to check up
</p>
<h4>Response</h4>
<p>Type: IPv4, IPv6 or error</p>
<p>hostName: Domain if found else ip you searched for</p>

