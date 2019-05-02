<?php 
$servername = "us-cdbr-iron-east-02.cleardb.net";
$dbname = "heroku_88ad8453f8bac06";
$username = "bb982c65d583a5";
$password = "8c39acfb";
// $myfile = fopen("file.txt", "w")  or die("Unable to open file!");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, imageUrl FROM articles");
    $stmt->execute();
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach ($stmt->fetchAll() as $v) {
    	// var_dump($v);
    	// echo ($v['id'] . "\t" . $v['imageUrl'] . "\r\n");
    	if (substr($v['imageUrl'], 0, 5) == 'http:') {
    	 	$nUrl = str_replace('http:', 'https:', $v['imageUrl']);
    	 	// echo $nUrl;
    	 	$q = $conn->prepare("UPDATE articles SET imageUrl='$nUrl' WHERE id=" . $v['id']);
    	 	$q->execute();
    	 } 
    	// fwrite($myfile, $value . "\n");
    }
    $conn = null;
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
