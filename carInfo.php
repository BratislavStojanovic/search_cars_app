<?php
require 'db.php';
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $cars = array_filter($db, function($el)
  {
    global $id;
    return $el['id'] == $id;
  });
} elseif ($_GET['search']) {
  $search = $_GET['search'];
  $cars = array_filter($db,function ($el)
  {

    global $search;
    return $el['brand'] == $search || $el['name'] == $search || $el['price'] == $search;
    
  });
  if (count($cars) == 0) {
    header('Location: index.php?error=1');
  }
 } else {
   header('Location: index.php');
 }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>CarInfo</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <body>
   <nav class="navbar navbar-expand navbar-light bg-light">
   <a href="index.php" class="navbar-brand">Cars</a>
   </nav>
   <div class="jumbotron text-center">
     <h2>
       <?php foreach ($cars as $car) :?>
         <span><?php echo $car['brand']; ?></span>
       <?php endforeach ?>
     </h2>
   </div>
   <div class="container-fluid">
     <div class="row">
       <div class="col-8 offset-2">
         <div class="row">

             <?php foreach ($cars as $car) : ?>
               <div class="col-6" style="outline: 1px solid #ddd">
               <h3 class="display-4"><?php echo $car['name']; ?></h3>
               <hr>
               <p><?php echo $car['info']; ?></p>
                <hr>
               <h4 class="bg-warning"> Price:<?php echo $car['price']."$"; ?> </h4>
               </div>
             <?php endforeach ?>


         </div>
       </div>
     </div>
   </div>
 </body>
 </html>
