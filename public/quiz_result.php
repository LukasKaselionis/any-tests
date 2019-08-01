<?php

declare(strict_types = 1);

require_once (__DIR__ . '/../vendor/autoload.php');

include_once __DIR__ . '/partial/menu.php';

$postData = $_POST;

use AnyTests\Helpers\ArrayHelper;
use AnyTests\Models\QuestionChoice;
use AnyTests\Models\QuizResult;

?>

<pre>
    <?= print_r($postData); ?>
    <?php
    $filteredArray = ArrayHelper::getElementsIndexStart($postData, 'choice_');

    print_r($filteredArray);

    $choiceModel = new QuestionChoice();

    $saveData = [
        'quiz_slug' => $postData['quiz_slug'],
        'first_name' => $postData['name'],
        'last_name' => $postData['last_name'],
        'email' => $postData['email'],
        'result' => [],
    ];

    $rightCount = 0;

    foreach ($filteredArray as $choiceKey => $choiceId)
    {
        list(, $questionId) = explode('_', $choiceKey);

        $rightChoice = $choiceModel->isRightChoice((int)$choiceId);

        if($rightChoice > 0)
        {
            $rightCount++;
        }

        $saveData['results']['result_data'][] = [
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
</pre>

<p><?= $postData['name'] ?> <?= $postData['last_name'] ?>, your result is: <?= $resultPercent ?> </p>