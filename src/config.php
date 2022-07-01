<?php

$host = 'mysql';
$user = 'root';
$password = 'root';
$dbname = 'test';


$tables = ['authors' =>
    'CREATE TABLE authors(
        author_id   INT AUTO_INCREMENT,
        first_name  VARCHAR(100) NOT NULL,
        middle_name VARCHAR(50) NULL,
        last_name   VARCHAR(100) NULL,
        PRIMARY KEY(author_id)
    );',
    'books' => 'CREATE TABLE books(
        book_id   INT AUTO_INCREMENT,
        book_title  VARCHAR(100) NOT NULL,
        book_description VARCHAR(300) NULL,
        PRIMARY KEY(book_id)
    );',
    'book_authors' =>
    'CREATE TABLE book_authors (
        book_id   INT NOT NULL,
        author_id INT NOT NULL,
        PRIMARY KEY(book_id, author_id),
        CONSTRAINT fk_book
            FOREIGN KEY(book_id)
            REFERENCES books(book_id)
            ON DELETE CASCADE,
            CONSTRAINT fk_author
                FOREIGN KEY(author_id)
                REFERENCES authors(author_id)
                ON DELETE CASCADE
    )'];
