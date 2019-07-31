-- // Create category quiz pivot table
-- Migration SQL that makes the change goes here.
CREATE TABLE IF NOT EXISTS t_category_quiz_pivot
(
    category_id INT UNSIGNED,
    quiz_id INT UNSIGNED,
    UNIQUE KEY `category_quiz_unique` (category_id, quiz_id),
    FOREIGN KEY `category_quiz_pivot_category_id` (category_id)
    REFERENCES t_categories (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY `category_quiz_pivot_quiz_id` (quiz_id)
    REFERENCES `t_quizes` (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);
-- @UNDO
-- SQL to undo the change goes here.
DROP TABLE IF EXISTS t_category_quiz_pivot;
