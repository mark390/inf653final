<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $res = $quote->getQuotesbyID($id);

    if (count($res) > 0) {
        $p_array = array();
        $p_array['data'] = array();

        foreach ($res as $r) {
            $post_item = array(
                'id' => $r['id'],
                'quote' => $r['quote'],
                'author' => $r['author'],
                'category' => $r['category']
            );
            array_push($p_array['data'], $post_item);
        }

        echo json_encode($p_array);

    } else {
        echo json_encode(array('message' => 'No Post Found'));
    }