-- // create categories table
-- Migration SQL that makes the change goes here.
CREATE TABLE IF NOT EXISTS t_categories
(
    id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(191) UNIQUE,
    slug VARCHAR(191) UNIQUE
);
-- @UNDO
-- SQL to undo the change goes here.
DROP TABLE IF EXISTS t_categories;