<?php


require_once(__DIR__ . '/vendor/autoload.php');

$config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c83db0aad3ift3bm7ae0');
$client = new Finnhub\Api\DefaultApi(
    new GuzzleHttp\Client(),
    $config
);
$a = "";
if (isset($_GET["search"])) {
    $a = $client->quote($_GET["search"]);
}


$array = ["TSLA", "AMC", "AMZN", "GME",];


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stocks</title>
</head>
<body>
<form method="get">
    <input name="search" value=""/>
    <button type="submit">Submit</button>
</form>
<?php $count = 0; ?>
<?php if (empty($a)): ?>
<?php foreach ($array as $stock): ?>
    <?php $s = $client->quote($stock); ?>
    <?php if ($count % 2 == 0): ?>
        <div style="background-color: lightblue; font-size: 20px; text-align: center">
            <p><?php echo $stock . " : "; echo $s["c"] . "$"; ?></p>
            <p>Previous Close Price : <?= $s["pc"] . "$"; ?></p>
            <?php if ($s["dp"] > 0): ?>
                <p>Percent change : </p><p style="color: green; font-weight: bold"><?= $s["dp"]; ?></p>
            <?php else: ?>
                <p>Percent change : </p><p style="color: red; font-weight: bold"><?= $s["dp"]; ?></p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div style="background-color: lightpink; font-size: 20px; text-align: center">
            <p><?php echo $stock . " : "; echo $s["c"] . "$"; ?></p>
            <p>Previous Close Price : <?= $s["pc"] . "$"; ?></p>
            <?php if ($s["dp"] > 0): ?>
                <p>Percent change : </p><p style="color: green; font-weight: bold"><?= $s["dp"]; ?></p>
            <?php else: ?>
                <p>Percent change : </p><p style="color: red; font-weight: bold"><?= $s["dp"]; ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php $count += 1; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php if (!empty($a)): ?>
    <div style="background-color: lightblue; font-size: 20px; text-align: center">
        <p><?php echo $_GET["search"] . " : "; echo $a["c"] . "$"; ?></p>
        <p>Previous Close Price : <?= $a["pc"] . "$"; ?></p>
        <?php if ($a["dp"] > 0): ?>
            <p>Percent change : </p><p style="color: green; font-weight: bold"><?= $a["dp"]; ?></p>
        <?php else: ?>
            <p>Percent change : </p><p style="color: red; font-weight: bold"><?= $a["dp"]; ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>
</body>
</html>
