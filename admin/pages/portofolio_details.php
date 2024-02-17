<?php 
include "koneksi.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DKV UPI - portos</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="../text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php
        require '../partials/_navbar.html';
        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
       <?php
        require '../partials/_settings-panel.html';
        require '../partials/_sidebar.html';
        ?>
        <!-- partial -->
       <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">


<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="col-sm-12">
  <div class="carousel-inner">
    <?php
    $tampil = mysqli_query($koneksi, "SELECT * FROM porto_img 
        INNER JOIN porto ON porto_img.id_porto = porto.id_porto
        WHERE porto.id_porto='$_GET[id_porto]'");
    
    $firstItem = true; // Flag untuk menentukan item pertama
    
    while($data = mysqli_fetch_array($tampil)):
    ?>
    <div class="carousel-item <?= $firstItem ? 'active' : '' ?>" data-bs-interval="10000">
      <img src="../../directory/imgporto/<?= $data['file_porto'] ?>" class="d-block w-100" alt="...">
    </div>
    <?php
      $firstItem = false; // Setel flag menjadi false setelah iterasi pertama
    endwhile;
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Sebelumnya</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Berikutnya</span>
  </button>
  </div>
</div>

                              
<?php

$tampil = mysqli_query($koneksi, "SELECT * FROM porto 
    INNER JOIN mahasiswa ON porto.id_mahasiswa = mahasiswa.id_mahasiswa
    WHERE id_porto='$_GET[id_porto]'");

while($data = mysqli_fetch_array($tampil)):
?>
                  <br>
                  
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group row">
                        <img src="../../directory/imgporto/<?= $data['thumb_porto'] ?>" alt="Thumbnail Image <?= $data['nim_mahasiswa'] ?>"
                            style="max-width: 213px; max-height: 120px; width: 100%; height: auto; border-radius: 0;">
                      </div>
                    </div>
                    <div class="col-md-10">
                      <h2><?= $data['judul_porto'] ?> </h2>
                    <p>
                    <i class="ti-user mx-0"></i> : <?= $data['name_mahasiswa'] ?>
                    <br>
                    <i class="icon-clock"></i> : <?= $data['upload_porto'] ?>
                    </p>
                    </div>
                  </div>
                  
                  <br>
                  <form class="form-sample" method="POST" action="admin_data.php">
                    <div class="row">
                      <input type="hidden" class="form-control" id="idadmin" placeholder="idporto" name="id_porto" value="<?= $data['id_porto']?>">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"><i class="icon-heart"></i> Like</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" value="<?= $data['like_porto'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label"><i class="icon-eye"></i> View</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" value="<?= $data['view_porto'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['kategori_porto'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tag</label>
                            <div class="col-sm-9">
                                <?php
                                // Ambil data tag_porto dari tabel porto_tag
                                $id_porto = $data['id_porto'];
                                $tag_query = mysqli_query($koneksi, "SELECT tag_porto FROM porto_tag WHERE id_porto = '$id_porto'");
                                
                                // Array untuk menyimpan tag_porto
                                $tags = array();
                                
                                // Loop untuk menambahkan tag_porto ke dalam array
                                while ($tag_data = mysqli_fetch_assoc($tag_query)) {
                                    $tags[] = $tag_data['tag_porto'];
                                }
                                
                                // Gabungkan tag_porto dengan pemisahan koma
                                echo '<input type="text" class="form-control" value="' . implode(', ', $tags) . '" readonly>';
                                ?>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Caption</label>
                          <div class="col-sm-9">
                            <textarea type="text" class="form-control" value="<?= $data['caption_porto'] ?>" readonly><?= $data['caption_porto'] ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Link</label>
                          <div class="col-sm-9">
                            <a type="button" class="btn btn-primary" href="<?= $data['link_porto'] ?>" placeholder="Klik Link">Klik Disini</a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                </div>
                <?php endwhile; ?>
              </div>
            </div>
        <!-- page-body-wrapper ends -->
            </div>
            </div>
        </div>
        </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    var radio1 = document.getElementById('membershipRadios1');
    var radio2 = document.getElementById('membershipRadios2');

    radio1.addEventListener('change', function () {
      radio2.value = (this.checked) ? '0' : '1';
    });

    radio2.addEventListener('change', function () {
      radio1.value = (this.checked) ? '1' : '0';
    });
  });
  </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="../js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/dashboard.js"></script>
  <script src="../js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

