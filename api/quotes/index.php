<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    require '../../config/Database.php';
    require '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    $aid = filter_input(INPUT_GET, 'authorId', FILTER_VALIDATE_INT);
    $cid = filter_input(INPUT_GET, 'categoryId', FILTER_VALIDATE_INT);
    $limit = filter_input(INPUT_GET, 'limit', FILTER_VALIDATE_INT);
    if (!$limit) {
        $limit = 30;
    }

    if ($aid && !$cid) {
        $res = $quote->getQuotesbyAuthor($aid);
    } elseif ($cid && !$aid) {
        $res = $quote->getQuotesbyCategory($cid);
    } elseif ($cid && $aid) {
        $res = $quote->getQuotesMulti($aid, $cid);
    } else {
        $res = $quote->getQuotes($limit);
    }

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
