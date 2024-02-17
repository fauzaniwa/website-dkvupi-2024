<?php 
include "koneksi.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DKV UPI - Awards</title>
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
  <div class="col-sm-9">
  <div class="carousel-inner">
    <?php
    $tampi = mysqli_query($koneksi, "SELECT * FROM award_img 
        INNER JOIN award ON award_img.id_award = award.id_award
        WHERE award.id_award='$_GET[id_award]'");
    
    $firstItem = true; // Flag untuk menentukan item pertama
    
    while($data = mysqli_fetch_array($tampi)):
    ?>
    <div class="carousel-item <?= $firstItem ? 'active' : '' ?>" data-bs-interval="10000">
      <img src="../../directory/imgawards/<?= $data['file_award'] ?>" class="d-block w-100" alt="...">
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

$tampil = mysqli_query($koneksi, "SELECT * FROM award 
    INNER JOIN mahasiswa ON award.id_mahasiswa = mahasiswa.id_mahasiswa
    WHERE id_award='$_GET[id_award]'");

while($data = mysqli_fetch_array($tampil)):
?>
                            <br>
                  <h2><?= $data['judul_award'] ?> </h2>
                  <p>
                    <i class="ti-user mx-0"></i> : <?= $data['name_mahasiswa'] ?>
                    <br>
                  <i class="icon-clock"></i> : <?= $data['date_award'] ?>
                  </p>

                  <br>
                  <form class="form-sample" method="POST" action="admin_data.php">
                    <div class="row">
                      <input type="hidden" class="form-control" id="idadmin" placeholder="Nama Lengkap" name="id_award" value="<?= $data['id_award']?>">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Dosen Pembimbing</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['dospen_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tanggal Kegiatan</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" value="<?= $data['date_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Media Award</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['media_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori Award</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['kategori_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Tingkat Award</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['tingkat_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Juara</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['juara_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Total Universitas Terlibat</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['univ_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Total Peserta Terlibat</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['peserta_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">File Undangan/Rekomendasi</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="<?= $data['undangan_award'] ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Link Pendukung</label>
                          <div class="col-sm-9">
                            <a type="button" class="btn btn-primary" href="<?= $data['link_award'] ?>" placeholder="Klik Link">Klik Disini</a>
                          </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Aksi</label>
                            <div class="col-sm-4">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="0" <?php echo ($data['status_award'] == 0) ? 'checked' : ''; ?>>
                                  Tolak
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-5">
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="1" <?php echo ($data['status_award'] == 1) ? 'checked' : ''; ?>>
                                  Setujui
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9 text-right">
                            <div class="modal-footer">
                              <a type="button" class="btn btn-secondary" href="awards.php">Back</a>
                              &nbsp;
                              <button type="submit" class="btn btn-primary" name="simpanaward">Simpan</button>
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

