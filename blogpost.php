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
  <link rel="shortcut icon" type="image/x-icon"  href="images/favicon.ico" />
  <title>Blog Post</title>
  <script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
    <script language="javascript" type="text/javascript">
      tinyMCE.init({
        mode: "textareas", 
          /* theme: "simple", */
        theme: "advanced",
        theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image, media",
        theme_advance_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location: "bottom",
        theme_advanced_resizing: true, 

        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",

        skin_variant: "silver",
        width: "450"}); 
    </script>
</head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <div id="logotype">
        <h1>Blog Post<h1>
      </div>
      <?php if ($action === 'show_form'): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- <h4>Titulo</h3> -->
        <p><input type="text" name="title" id="title" /></p>
        <h4>Contenido</h3>
        <textarea name="content" rows="20"></textarea>
        <h5>Tags</h4>
        <p><input type="text" name="tags" id="tags" /></p>
        <div id="botoiak">
          <p><input type="submit" name="btn_submit" value="Salvar" />
          <input type="reset" name="btn_reset" value="Borrar" /> </p>
        </div>
        </form>
      <?php else: ?>
        <p>Articulo guardado. _id:<?php echo $article['_id']; ?>. <br>
          <a href="blogpost.php">Deseas escribir algo mas?</a></p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
