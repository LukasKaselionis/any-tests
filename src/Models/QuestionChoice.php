<?php

declare(strict_types = 1);

namespace AnyTests\Models;

use AnyTests\Model;
use PDO;

class QuestionChoice extends Model
{
    protected $table = 't_question_choices';

    public function getByQuestionId (int $questionId) : array
    {
        $sql = 'SELECT * FROM '.$this->table . ' WHERE question_id = :questionId';

        $stmt = $this->getConnection()->prepare($sql);

        $stmt->bindValue(':questionId', $questionId, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function isRightChoice (int $choiceId): int
    {
        $sql = 'SELECT `right` FROM '. $this->table . ' WHERE id = :choiceId';

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':choiceId', $choiceId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn();
    }
}