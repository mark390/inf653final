<?php
    class Author {
        private $conn;
        public $id;
        public $author;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getAuthors() {
            $query = 'SELECT id, author FROM authors';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes; 
        }

        public function getAuthorsbyID($id) {
            $query = 'SELECT id, author FROM authors WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }

        public function createAuthor($author) {
            $query = 'INSERT INTO authors (author) VALUES (:author)';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':author', $author);
            $statement->execute();
            $statement->closeCursor();
        }

        public function getCount() {
            $query = 'SELECT COUNT(*) FROM authors';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $count = $statement->fetchColumn();
            $statement->closeCursor();
            return $count;
        }

        public function updateAuthor($author, $id) {
            $query = 'UPDATE authors SET author = :author WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':author', $author);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }

        public function deleteAuthor($id) {
            $query = 'DELETE FROM authors WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }
        

        



    }