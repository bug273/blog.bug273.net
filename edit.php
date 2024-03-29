<?php
  $action = (!empty($_POST['btn_submit']) && 
    ($_POST['btn_submit'] === 'Save')) ? 'save_article' : 'show_form';
$id = $_REQUEST['id'];
try {
  $mongodb = new Mongo();
  $articleCollection = $mongodb->myblogsite->articles;
} catch (MongoConnectionException $e) {
  die('Fallo al conectar con la base de datos '. $e->getMessage());
}
switch($action) {
  case 'save_article':
    $article = array();
    $article['title'] = $_POST['title'];
    $article['content'] = $_POST['content'];
    $article['saved_at'] = new MongoDate();
    $articleCollection->update(array('_id' => new MongoId($id)), $article);
    break;
  case 'show_form':
  default:
    $article = $articleCollection->findOne(array('_id' => new MongoId($id)));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" href="style.css" />
      <link rel="shortcut icon" type="image/x-icon"  href="http://blog.bug273.net/images/favicon.ico" />
      <title>Editor de Posts del Blog</title>
  </head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <div id="logotype">
        <h1>Creador de Post del Blog</h1>
      </div>
      <?php if ($action === 'show_form'): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Titulo</h3>
          <p><input type="text" name="title" id="title" 
          value="<?php echo $article['title']; ?>"/></p>
        <h3>Contenido</h3>
          <textarea name="content" rows="20"><?php echo $article['content']; ?></textarea>
          <input type="hidden" name="id" value="<?php echo $article['_id']; ?>" />
          <p><input type="submit" name="btn_submit" value="Save" /></p>
        </form>
        <?php else: ?>
          <p>Articulo guardado. _id: <?php echo $id; ?> 
          <a href="blog.php?id=<?php echo $id; ?>">Leido</a></p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>


