<?php
    class Quote {
        private $conn;
        public $id;
        public $quote;
        public $author;
        public $authorId;
        public $categoryId;
        public $category;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getQuotes($limit) {
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id LIMIT :l';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':l', $limit,PDO::PARAM_INT);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes; 
        }

        public function getQuotesbyID($id) {
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }
        public function getQuotesbyAuthor($aid) {
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.authorId = :author';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':author', $aid);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }

        public function getQuotesbyCategory($cid) {
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.categoryId = :category';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':category', $cid);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }

        public function getQuotesMulti($aid, $cid) {
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.categoryId = :category and q.authorId = :author';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':author', $aid);
            $statement->bindValue(':category', $cid);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }

        public function createQuote($quote, $aid, $cid) {
            $query = 'INSERT INTO quotes (quote, authorId, categoryId) VALUES (:quote, :authorid, :categoryid)';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':quote', $quote);
            $statement->bindValue(':authorid', $aid);
            $statement->bindValue(':categoryid', $cid);
            $statement->execute();
            $statement->closeCursor();
        }

        public function getCount() {
            $query = 'SELECT COUNT(*) FROM quotes';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $count = $statement->fetchColumn();
            $statement->closeCursor();
            return $count;
        }

        public function updateQuote($quote, $aid, $cid, $id) {
            $query = 'UPDATE quotes SET quote = :quote, authorId = :authorid, categoryId = :categoryid WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':quote', $quote);
            $statement->bindValue(':authorid', $aid);
            $statement->bindValue(':categoryid', $cid);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }

        public function deleteQuote($id) {
            $query = 'DELETE FROM quotes WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }
        

        



    }