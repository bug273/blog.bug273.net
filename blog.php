<?php
  $id = $_GET['id'];
  try{
    $connection = new Mongo();
    $database = $connection->selectDB('myblogsite');
    $collection = $database->selectCollection('articles');
  } catch(MongoConnectionException $e) {
    die("Fallo al conectar con la base de datos ".$e->getMessage());
  }
  $article = $collection->findOne(array('_id' => new MongoId($id)));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>Mi Blog</title>
  <head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <h1>Mis Blogs</h1>
      <h2><?php echo $article['title']; ?></h2>
      <p><?php echo $article['content']; ?></p>
    </div>
  </div>
</body>
</html>

  
