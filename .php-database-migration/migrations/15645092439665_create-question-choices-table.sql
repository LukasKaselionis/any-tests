-- // Create question choices table
-- Migration SQL that makes the change goes here.
CREATE TABLE IF NOT EXISTS t_question_choices
(
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `question_id` INT UNSIGNED NOT NULL,
    `choice` VARCHAR(191) NOT NULL,
    `right` TINYINT(1) NOT NULL DEFAULT '0',
    FOREIGN KEY `question_choices_question_id_foreign` (`question_id`)
    REFERENCES `t_questions` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);
-- @UNDO
-- SQL to undo the change goes here.
DROP TABLE IF EXISTS t_question_choices;
