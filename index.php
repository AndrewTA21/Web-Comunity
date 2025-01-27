<?php 
session_start();
require('functions.php');
$postingan = query("SELECT * FROM postingan");

if(isset($_POST['send_comment'])){
  $idpostingan = $_POST['id_postingan'];
  $iduser = $_POST['id_user'];
  $comment = $_POST['comment'];
  $date = $dateNow = date("Y-m-d");

  $query = "INSERT INTO comment(id_postingan,id_user,comment,tanggal_comment)
            VALUES ('$idpostingan','$iduser','$comment','$date')";
  mysqli_query($conn,$query);
}

function getValue($id,$name){
  $query = "SELECT $name FROM user WHERE id = $id";
  $res = getData($query,"$name");
  return $res;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>Komunitas Pemrog</title>
  </head>
  <style>
    body{
      background-color: #eeee;
    }
  </style>
  <body>
    <?php include('navbar.php') ?>
    <div class="container col-md-6 mt-5">
      <?php foreach($postingan as $val) : ?>
        <div class="card shadow-sm col-md-8  mt-4">
          <div class="border-bottom">
            <div class="dflex m-2">
              <img class="border border-dark rounded-circle" width="40px" height="40px" src="img/profil/<?= getValue($val['id_user'],'foto_profil'); ?>" alt="">
              <a class="text-decoration-none text-dark fw-bold mx-2" href=""><?= getValue($val['id_user'],'username'); ?></a>
            </div>
          </div>
          <div class="card-body">
          <p class="card-text"><?= $val['postingan_text']; ?></p>
          </div>
          <?php if($val['postingan_gambar'] !== '-1') : ?>
            <img src="img/posting/<?= $val['postingan_gambar']; ?>" class="card-img-top border-bottom" alt="...">
          <?php endif ?>
            <!-- <h5><?= $val['jml_like']; ?></h5>
            <div class="d-flex border-bottom">
              <h3 class="mx-2"><i class="bi bi-hand-thumbs-up-fill"></i></h3>
              <h3 class="mx-2"><i class="bi bi-chat-dots-fill"></i></h3>
            </div> -->
            <div class="container_comment"></div>
            <form action="index.php" method="post" class="d-flex my-2">
              <input type="hidden" name="id_postingan" value="<?= $val['id']; ?>"> 
              <input type="hidden" name="id_user" value="<?= $_SESSION['id_user']; ?>"> 
                <?php if(isset($_SESSION['foto_profil'])): ?>
                  <img width="25px" height="25px" class="rounded-circle border border-secondary m-2" src="img/profil/<?= $_SESSION['foto_profil']; ?>" alt="">
                <?php endif ?>
              <input class="form-control rounded-pill" type="text" placeholder="Comment..." aria-label="Comment" name="comment">
              <button class="btn btn-info rounded-circle mx-2" type="submit" name="send_comment"><i class="bi bi-send-fill"></i></button>
            </form>
        </div>
        <?php endforeach ?>
      </div>
      <footer class="fixed-bottom d-xxl-none ">
      <?php include('footer.php') ?>
    </footer>
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>