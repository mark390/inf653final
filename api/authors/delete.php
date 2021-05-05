<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require '../../config/Database.php';
    require '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();
    $authors = new Author($db);
    
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $before = $authors->getCount();
    $result = $authors->deleteAuthor($id);
    $after = $authors->getCount();

    if ($after - $before != -1) {
        echo json_encode(array('message' => 'Author Not Deleted'));
    } else {
        echo json_encode(array('message' => 'Author Deleted'));
    }