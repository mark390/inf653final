<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $id = isset($_GET['id']) ? $_GET['id'] : die();

    $res = Quote::getQuotesbyID($id);

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