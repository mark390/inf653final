<?php
    class Category {
        private $conn;
        public $id;
        public $category;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getCategories() {
            $query = 'SELECT id, category FROM categories';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $categories = $statement->fetchAll();
            $statement->closeCursor();
            return $categories; 
        }

        public function getCategoriesbyID($id) {
            $query = 'SELECT id, category FROM categories WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $categories = $statement->fetchAll();
            $statement->closeCursor();
            return $categories;
        }

        public function createCategory($category) {
            $query = 'INSERT INTO categories (category) VALUES (:category)';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':category', $category);
            $statement->execute();
            $statement->closeCursor();
        }

        public function getCount() {
            $query = 'SELECT COUNT(*) FROM categories';
            $statement = $this->conn->prepare($query);
            $statement->execute();
            $count = $statement->fetchColumn();
            $statement->closeCursor();
            return $count;
        }

        public function updateCategory($category, $id) {
            $query = 'UPDATE categories SET category = :category WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':category', $category);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }

        public function deleteCategory($id) {
            $query = 'DELETE FROM categories WHERE id = :id';
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->execute();
            $statement->closeCursor();
        }
        

        



    }