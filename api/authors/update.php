<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require '../../config/Database.php';
    require '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();
    $authors = new Author($db);
    
    $data = json_decode(file_get_contents('php://input'));
    $id = $data->id;
    $author = $data->author;

    $result = $authors->updateAuthor($author, $id);
    echo json_encode(array('message' => 'Author Updated'));