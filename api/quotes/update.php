<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    require '../../config/Database.php';
    require '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();
    $quotes = new Quote($db);
    
    $data = json_decode(file_get_contents('php://input'));
    $quote = $data->quote;
    $id = $data->id;
    $aid = $data->authorId;
    $cid = $data->categoryId;

    $result = $quotes->updateQuote($quote, $aid, $cid, $id);
    echo json_encode(array('message' => 'Quote Updated'));