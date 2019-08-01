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

$questionChoiceModel = new QuestionChoice();

$questions = $questionModel->getByQuizSlug((string)$quizSlug);

?>

<form action="quiz_result.php" method="post">
    <input type="hidden" name="quiz_slug" value="<?= $quizSlug ?>">

    <label for="name">First name</label>
        <input type="text" name="name" value="" required>
    <br>
    <label for="last_name">Last name</label>
    <input type="text" name="last_name" value="" required>
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" value="" required>


    <?php
    // Loop and display questions
    foreach ($questions as $key => $question) {
        ?>
        <p><?= $key + 1 ?> <?= $question['question'] ?></p>
        <?php
        // display each question choices
        $choices = $questionChoiceModel->getByQuestionId($question['id']);
        // print_r($choices);
        ?>
        <ul style="list-style-type: lower-alpha;">
        <?php
        foreach ($choices as $choice) {
            ?>
                <li>
                    <label>
                    <input type="radio" name="choice_<?= $question['id'] ?>" value="<?= $choice['id'] ?>"> <?= $choice['choice'] ?>
                    </label>
                </li>
            <?php
        }
        ?>
        </ul>
    <?php
    }
    ?>
    <input type="submit" name="submit_quiz" value="Submit">
</form>
