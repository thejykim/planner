<?php
    $file = $_POST["file"];
    $id = hash('sha256', $_POST["id"]);
    if( is_dir($id) === false )
    {
        mkdir($id);
    }
    $dataFile = fopen("{$id}/{$file}.txt", "a");
    $date = date("Y-m-d");
    $message = $_POST["message"];
    fwrite($dataFile, "\n{$date};{$message}$");
    // post back to planner.php
    $url = 'https://thejyk.com/projects/planner/planner.php';
    
    $fields = [
        'id'      => $_POST["id"]
    ];
    
    $fields_string = http_build_query($fields);
    
    $ch = curl_init();
    
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    $result = curl_exec($ch);
    echo $result;
?>