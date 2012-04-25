<?php
  $action = (!empty($_POST['btn_submit']) &&
    ($_POST['btn_submit'] === 'Salvar')) ? 'save_article' : 'show_form';
  switch($action) {
    case 'save_article':
      try{
        $connection = new Mongo();
        $database = $connection->selectDB('myblogsite');
        $collection = $database->selectCollection('articles');
        $article = array(
          'title' => $_POST['title'],
          'content' => $_POST['content'],
          'tags' => $_POST['tags'],
          'saved_at' => new MongoDate()
        );
        $collection->insert($article);
      } catch(MongoConnectionException $e) {
        die("Fallo al conectar con la base de datos" .
        $e->getMessage());
      } catch(MongoException $e) {
        die("Fallo al insertar los datos " . $e->getMessage());
      }
      break;
    case 'show_form':
    default:
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xmlns" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="style.css"/>
  <title>Blog Post</title>
</head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <h1>Blog Post<h1>
      <?php if ($action === 'show_form'): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h4>Titulo</h3>
        <p><input type="text" name="title" id="title" /></p>
        <h4>Contenido</h3>
        <textarea name="content" rows="20"></textarea>
        <h5>Tags</h4>
        <p><input type="text" name="tags" id="tags" /></p>
        <p><input type="submit" name="btn_submit" value="Salvar" /></p>
        </form>
      <?php else: ?>
        <p>Articulo guardado. _id:<?php echo $article['_id']; ?>. <br>
          <a href="blogpost.php">Deseas escribir algo mas?</a></p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
