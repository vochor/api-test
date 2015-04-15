<?php
ini_set('display_errors','1'); error_reporting(E_ALL);
$news = json_decode(file_get_contents('db.txt'), true);

unset($response);
$response['status'] = 'ok';
$response['msg'] = 'All ok';
if (!isset($_POST['action']) || empty($_POST['action'])) {
    $response['status'] = 'error';
    $response['msg'] = 'No action';
    echo json_encode($response, true);
    exit();
}

if ($_POST['action'] == 'getNews') {
    if (isset($_POST['n']) && !empty($_POST['n'])) {
        if (is_numeric($_POST['n'])) {
            $response['news'] = array_slice($news, 0, $_POST['n']);
            $response['status'] = 'ok';
            echo json_encode($response, true);
            exit();
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'n: \''.  htmlentities($_POST['n']).'\' is not numeric';
            echo json_encode($response, true);
            exit();
        }
    } else {
        $response['status'] = 'error';
        $response['msg'] = 'No N';
        /*
           $response['news'] = $news;
           $response['n'] = sizeof($news);
           $response['status'] = 'ok';*/
        echo json_encode($response, true);
        exit();
    }
} else if ($_POST['action'] == 'addPieceOfNews') {
    if (isset($_POST['text']) && !empty($_POST['text'])) {
        $news[] = $_POST['text'];
        if (file_put_contents('db.txt', json_encode($news, true))) {
            $response['status'] = 'ok';
            echo json_encode($response, true);
            exit();
        } else {
            $response['status'] = 'error';
            $response['msg'] = 'Error on saving news';
            echo json_encode($response, true);
            exit();
        }
    } else {
        $response['status'] = 'error';
        $response['msg'] = 'No text';
        echo json_encode($response, true);
        exit();
    }
}
