<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../vendor/autoload.php');
include_once __DIR__ . '/partial/menu.php';

/**
 * get data from $_POST
 * sutvarkyti duomenis
 * juos issaugoti
 * ir atvaizduoti surinkta rezultata
 */

$postData = $_POST;

use AnyTests\Helpers\ArrayHelper;
use AnyTests\Models\QuestionChoice;
use AnyTests\Models\QuizResult;

$filteredArray = ArrayHelper::getElementsIndexStart($postData, 'choice_');

$choiceModel = new QuestionChoice();

$saveData = [
    'quiz_slug' => $postData['quiz_slug'],
    'first_name' => $postData['name'],
    'last_name' => $postData['last_name'],
    'email' => $postData['email'],
    'result' => [],
];

$rightCount = 0;

foreach ($filteredArray as $choiceKey => $choiceId) {

    list($string, $questionId) = explode('_', $choiceKey);
    $rightChoice = $choiceModel->isRightChoice((int)$choiceId);

    if ($rightChoice > 0) {
        $rightCount++;
    }

    $saveData['result']['result_data'][] = [
        'question_id' => $questionId,
        'choice_id' => $choiceId,
        'right' => $rightChoice,
    ];
}
$resultPercent = $rightCount * 100 / count($filteredArray);
$saveData['result']['result_percentage'] = $resultPercent;
$saveData['result'] = json_encode($saveData['result']);

$resultModel = new QuizResult();
$resultModel->insert($saveData);

?>

<p><?= $postData['name'] ?> <?= $postData['last_name'] ?>, your result is: <?= $resultPercent ?></p>