<?php

declare(strict_types = 1);

namespace AnyTests\Models;

use AnyTests\Model;
use PDO;

class Question extends Model
{
    protected $table = 't_questions';

    public function getByQuizSlug (string $quizSlug) : array
    {
        $sql = 'SELECT q.* FROM '.$this->table . ' q';
        $sql .=' INNER JOIN t_quizes tq ON (q.quiz_id = tq.id AND tq.slug = :quizSlug)';

        $stmt = $this->getConnection()->prepare($sql);

        $stmt->bindValue(':quizSlug', $quizSlug, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchAll();
    }

}