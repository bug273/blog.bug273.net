<?php 
$id = $_GET['id'];
try{
  $mongodb = new Mongo();
  $articleCollection = $mongodb->myblogsite->articles;
} catch(MongoConnectionException $e) {
  die('Fallo al conectar con la base de datos '. $e->getMessage);
}
$articleCollection->remove(array('_id' => new MongoId($id)));
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
  <head>  
    <meta charset="UTF-8"> 
    <link rel="stylesheet" href="style.css">
    <title>Post del Blog</title>
  </head>
<body>
  <div id="contentarea">
    <div id="innercontentarea">
      <h1>Post del Blog</h1>
      <p>Articulo Borrado. _id: <?php echo $id; ?>.<a href="dashboard.php">Volver al Dashboard</a> 
      </p>
    </div>
  </div>
</body>
</html>
   

