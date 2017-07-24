<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

$actions = [
  'say-hello' => 'sayHello',
  'get-page-content' => 'getPageContent',
  'php-debug' => 'phpDebug'
];

if (isset($_POST['action'])) {
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);

    if (array_key_exists($action, $actions)) {
        $responseArray = [
          'status' => 'error',
          'message' => 'An error has occured',
          'data' => '',
          'debug' => '',
        ];
        call_user_func_array($actions[$action], array(&$responseArray));
        $responseArray['debug'] = ob_get_clean();
        header('Content-Type: application/json');
        echo json_encode($responseArray);
    } else {
        http_response_code(400);
    }
} else {
    http_response_code(400);
}

function sayHello(&$responseArray) {
    $responseArray['status'] = 'success';
    $responseArray['message'] = 'You talkin\' to me?';
    $responseArray['data'] = 'Hello guy !';
}

function getPageContent(&$responseArray) {
    $responseArray['message'] = 'The page URL is incorrect or missing';
    if (isset($_POST['page-url'])) {
        $pageUrl = filter_input(INPUT_POST, 'page-url', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        if (!empty($pageUrl)) {
            $pageContent = file_get_contents($pageUrl);
            if ($pageContent !== false) {
                $responseArray['status'] = 'success';
                $responseArray['message'] = 'The content of <a href="' . $pageUrl . '" target="_blank">' . $pageUrl . '</a> have successfully been retrieved.';
                $responseArray['data'] = $pageContent;
            }
        }
    }
}

function phpDebug(&$responseArray) {
    $responseArray['status'] = 'success';
    $responseArray['message'] = 'What the fuck !';
    $responseArray['data'] = '§:&£$^';
    $var = 2 * $undef;
    $var /= 0;
}
