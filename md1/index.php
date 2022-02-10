<?php

$from = $_GET["from"] ?? "";
$to = $_GET["to"] ?? "";
$cov = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit=1000"));
echo "<pre>";
?>

<form method="get" action="/">
    <input type="date" name="from"/>
    <input type="date" name="to"/>
    <button type="submit">Submit</button>
</form>

<table>
    <thead style="text-align: center; background-color:lightblue;">
    <th>Datums</th>
    <th>Testu sk</th>
    <th>Apstiprinātie</th>
    </thead>
    <tbody>
    <?php foreach ($cov->result->records as $record): ?>
        <tr style="text-align: center;">
            <?php if ($from == "" && $to == ""): ?>
                <td><?= $record->Datums; ?></td>
                <td><?= $record->TestuSkaits; ?></td>
                <td><?= $record->ApstiprinataCOVID19InfekcijaSkaits; ?></td>
            <?php elseif (str_replace("-", "", explode("T", $record->Datums)[0]) >= str_replace("-", "", $from) && str_replace("-", "", explode("T", $record->Datums)[0]) <= str_replace("-", "", $to)): ?>
                <td><?= $record->Datums; ?></td>
                <td><?= $record->TestuSkaits; ?></td>
                <td><?= $record->ApstiprinataCOVID19InfekcijaSkaits; ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>