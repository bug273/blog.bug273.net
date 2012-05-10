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
    <link rel="shortcut icon" type="images/x-icon"  href="images/favicon.ico" />

    <title>Blog</title>
  <head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <div id="logotype">
        <h1>Posts</h1>
      </div>
      <h2><?php echo $article['title']; ?></h2>
      <p><?php echo $article['content']; ?></p>
    </div>
    <div class="volver">
      <a href="http://blog.bug273.net/blogs.php">Volver</a>
    </div>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
      var disqus_shortname='bug273';
      (function() {
          var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
          dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
          (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
    </script>
      <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments.</a></noscript>
  </div>
  <div id="footer">
    <ul id="footer-logos">
      <p><h4>Hecho con:&nbsp;</h4></p>
      <li><a href="http://www.mongodb.org/"><img src="images/mongodb-logo.png" alt="Mongodb" width="80" height="50" /></a></li>
      <li><a href="http://php.net/"><img src="images/php-logo.jpg" alt="PHP" width="80" height="50"  /></a></li>
    </ul>
</body>
</html>

  
