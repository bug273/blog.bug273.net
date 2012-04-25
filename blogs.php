<?php
try{
  $connection = new Mongo();
  $database = $connection->selectDB('myblogsite');
  $collection = $database->selectCollection('articles');
} catch(MongoConnectionException $e) {
  die("Fallo al conectar con la base de datos" . $e->getMessage());
}
$cursor = $collection->find();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; chaset=utf-8" />
      <link rel="stylesheet" href="style.css" />
      <title>Mi blog</title>
  </head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <h1>Mis Blogs</h1>
      <?php while ($cursor->hasNext()):
        $article = $cursor->getNext(); ?>
      <h2><?php echo $article['title']; ?></h2>
      <p><?php echo substr($article['content'], 0, 200) . '...'; ?></p>
      <a href="blog.php?id=<?php echo $article['_id']; ?>">Leer mas</a>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
