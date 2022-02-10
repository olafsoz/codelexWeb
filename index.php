<?php

$search = $_GET["search"] ?? "";
$limit = 20;
$offset = $_GET["offset"] ?? 0;
$q = json_decode(file_get_contents(
    "https://data.gov.lv/dati/lv/api/3/action/datastore_search?q=$search&offset=$offset&resource_id=25e80bf3-f107-4ab4-89ef-251b5b9374e9&"));

?>
<form method = "get" action = "/">
    <input name = "search"/>
    <button type = "submit">Submit</button>
</form>

<table>
    <thead>
        <th>Name</th>
        <th>Reg. Nr.</th>
    </thead>
    <tbody>
        <?php foreach ($q->result->records as $record): ?>
            <tr>
                <td><?= $record->name; ?></td>
                <td><?= $record->regcode; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form method = "get" action = "/">
    <?php if ($offset > 0): ?>
    <button type = "submit" name = "offset" value = "<?= $offset-$limit; ?>"> << </button>
    <?php endif; ?>
    <?php if (count($q->result->records) >= $limit): ?>
    <button type = "submit" name = "offset" value = "<?= $offset+$limit; ?>"> >> </button>
    <?php endif; ?>
</form>
