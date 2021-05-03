<?php
    class Quote {
        private $conn;
        private $table = 'quotes';

        public $id;
        public $quoteid;
        public $author;
        public $authorid;
        public $categoryid;
        public $category;

        public function __construct() {}

        public static function getQuotes() {
            $db = Database::getDB();
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id';
            $statement = $db->prepare($query);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes; 
        }

        public static function getQuotesbyID($id) {
            $db = Database::getDB();
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.id = :id';
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }
        public static function getQuotesbyAuthor($id) {
            $db = Database::getDB();
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.authorId = :author';
            $statement = $db->prepare($query);
            $statement->bindValue(':author', $id);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }

        public static function getQuotesbyCategory($id) {
            $db = Database::getDB();
            $query = 'SELECT c.category as category, a.author as author, q.id, q.quote FROM quotes q
            LEFT JOIN authors a on q.authorId = a.id
            LEFT JOIN categories c on q.categoryId = c.id WHERE q.categoryId = :category';
            $statement = $db->prepare($query);
            $statement->bindValue(':category', $id);
            $statement->execute();
            $quotes = $statement->fetchAll();
            $statement->closeCursor();
            return $quotes;
        }

        public static function createQuote($quote, $aid, $cid) {
            $db = Database::getDB();
            $query = 'INSERT INTO quotes (quote, authorId, categoryId) VALUES (:quote, :authorid, :categoryid)';
            $statement = $db->prepare($query);
            $statement->bindValue(':quote', $quote);
            $statement->bindValue(':authorid', $aid);
            $statement->bindValue(':categoryid', $cid);
            $statement->execute();
            $statement->closeCursor();
        }

        



    }