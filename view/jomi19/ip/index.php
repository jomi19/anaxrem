<?php

namespace Jomi19\View;

use function Anax\View\url;

/**
 * Style chooser.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1>Ip validation</h1>
<p>Here can you check if an ip adress is valid</p>
<form method="post" action=<?= url("ip/") ?>>
    <input type="text" name="ip" value=<?= $client ?>>
    <input type="submit" value="Check">
    <input type="submit" name="ip" value="185.49.132.3">
    <input type="submit" name="ip" value="2001:db8:85a3:8d3:1319:8a2e:370:7348">
    <?php if ($check) : ?>
        <?php if ($valid) : ?>
            <p class="valid">Valid ip (<?= $ipData["type"] ?>)</p>
            <?php if ($ipData["host_name"]) : ?>
                <p><?= $ipData["host_name"] ?></p>
            <?php endif; ?>
            <p>
                <?= $ipData["location"]["flag"] . " " . $ipData["location"]["country"] .  " "  . $ipData["location"]["city"] ?>
            <p>
        <?php else : ?>
            <p class="invalid">Not valid ip</p>
        <?php endif; ?>

    <?php endif; ?>

    
</form>

<h2>Get Json-response</h2>
<form method="post" action=<?= url("jsonip/data") ?>>
    <input type="text" name="ip">
    <input type="submit" value="Check">
    <input type="submit" name="ip" value="185.49.132.3">
    <input type="submit" name="ip" value="2001:db8:85a3:8d3:1319:8a2e:370:7348">
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

