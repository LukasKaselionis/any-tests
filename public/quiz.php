<?php

declare(strict_types = 1);

use AnyTests\Models\Question;
use AnyTests\Models\QuestionChoice;

require_once (__DIR__ . '/../vendor/autoload.php');

include_once __DIR__ . '/partial/menu.php';

$quizSlug = (isset($_GET['quiz']) && !empty($_GET['quiz'])) ? $_GET['quiz'] : null;

if ($quizSlug === null)
{
    echo 'No quiz slug';
    die(404);
}

$questionModel = new Question();
$questions = $questionModel->getByQuizSlug((string)$quizSlug);

$questionChoiceModel = new QuestionChoice();
$questionsChoices = $questionChoiceModel->getChoiceByQuestionId((string)$quizSlug);

?>

<form action="" method="post">
    <?php
    // Loop and display questions
    foreach ($questions as $key => $question) {
        ?>

        <p><?= $key + 1 ?> <?= $question['question'] ?></p>

        <br>
        <?php

        // display each question choices
        foreach ($questionsChoices as $questionsChoice)
        {
            ?>

            <p><?= $questionsChoice['choice'] ?></p>

            <?php

        }


        ?>

    <?php
    }
    ?>
    <input type="submit" name="submit_quiz" value="Submit">
</form>
