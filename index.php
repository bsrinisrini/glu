<?php
    include 'Tasks.php';

    $url = explode("/", $_REQUEST['q']);
    
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === "GET") {
        // GET Method processing
        if ($url[0] === 'task') {
            if (count($url) === 1) {
                // Endpoint /task
                $task = new GluMobile\Tasks();
                $task->getNextTask();
            } elseif(ctype_digit($url[1])) {
                // Endpoint /task/$id
                $task = new GluMobile\Tasks();
                $task->getTask($url[1]);
            }
        }
    } elseif ($method === "POST"){
        // POST Method processing
        if ($url[0] === 'task') {
            if (count($url) === 1) {
                // Endpoint /task
                $task = new GluMobile\Tasks();
                $task->addTask();
            } elseif($url[1] === "process" && ctype_digit($url[2])) {
                // Endpoint /task/process/$id
                $task = new GluMobile\Tasks();
                $task->startTask($url[2]);
            }
        }
    }
?>