<?php

namespace AnyTests\Models;

use AnyTests\Model;
use PDO;

class QuizResult extends Model
{
    protected $table = 't_quiz_results';

    public function insert(array $data)
    {
        $sql = "INSERT INTO " . $this->table . " SET quiz_slug = :quizSlug,
            first_name = :firstName,
            last_name = :lastName,
            email = :email,
            result = :result";

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':quizSlug', $data['quiz_slug'], PDO::PARAM_STR);
        $stmt->bindValue(':firstName', $data['first_name'], PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $data['last_name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':result', $data['result'], PDO::PARAM_STR);
        $stmt->execute();

    }
}