<?php
try{
  $mongo = new Mongo();
  $databases = $mongo->listDBs();
  echo '<pre>';
  print_r($databases);
  $mongo->close();
} catch (MongoConnectionException $e) {
  die($e->getMessage());
}

