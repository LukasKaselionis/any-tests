<?php

declare(strict_types = 1);

namespace AnyTests\Models;

use AnyTests\Model;
use PDO;

class Quiz extends Model

{
    protected $table = 't_quizes';

    public function getByCategory(?string $categorySlug = null)
    {
        $sql = 'SELECT * FROM '.$this->table . ' q';

        if ($categorySlug !== null)
        {
            $sql .= ' INNER JOIN t_category_quiz_pivot cqp ON q.id = cqp.quiz_id';
            $sql .= ' INNER JOIN t_categories c ON (cqp.category_id = c.id AND c.slug = :categorySlug)';
        }

        $stmt = $this->getConnection()->prepare($sql);

        if($categorySlug !== null)
        {
            $stmt->bindValue(':categorySlug', $categorySlug, PDO::PARAM_STR);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }
}