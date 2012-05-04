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
       <link rel="shortcut icon" type="image/x-icon"  href="images/favicon.ico" />
      <title>Blog</title>
  </head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <div id="logotype">
        <h1>Posts</h1>
      </div>
      <?php while ($cursor->hasNext()):
        $article = $cursor->getNext(); ?>
      <h2><?php echo $article['title']; ?></h2>
      <p><?php echo substr($article['content'], 0, 200) . '...'; ?></p>
      <a href="blog.php?id=<?php echo $article['_id']; ?>">Leer m&aacute;s</a>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
