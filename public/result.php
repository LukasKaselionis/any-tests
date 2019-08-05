<?php

declare(strict_types = 1);

use AnyTests\Models\QuizResult;

require_once (__DIR__ . '/../vendor/autoload.php');

include_once __DIR__ . '/partial/menu.php';

$resultModel = new QuizResult();

$saveData = $resultModel->get();

function getPercentageResult(string $resultJson): string {
    $saveData = json_decode($resultJson, true);

    return sprintf('%s %%', $saveData['result_percentage']);
}

var_dump($saveData);

?>

<table border="1">
    <tr>
        <th>Name</th>
        <th>LastName</th>
        <th>Email</th>
        <th>Result</th>
    </tr>
        <?php

        foreach ($saveData as $item) {
            ?>
            <tr>
            <td><?= $item['first_name'] ?></td>
            <td><?= $item['last_name'] ?></td>
            <td><?= $item['email'] ?></td>
            <td><?= getPercentageResult($item['result']) ?></td>
            </tr>
            <?php
        }
        ?>
</table>
