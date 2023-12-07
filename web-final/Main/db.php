<?php
$data = parse_ini_file('usjr.ini');

try {
    $conn = new PDO('mysql:host='.$data['host'].';dbname='.$data['dbname'].';port='.$data['port'],$data['username'],
                    $data['password']);
} catch(PDOException $e){
    echo $e->getMessage();
}

