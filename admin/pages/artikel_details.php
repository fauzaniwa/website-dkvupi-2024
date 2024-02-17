<?php
// Koneksikan ke database
require 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>DKV UPI - Artikel</title>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Include Trumbowyg CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.26.0/dist/ui/trumbowyg.min.css">


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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Artikel</h4>
                  <p>Tambahkan artikel terbaru.</p>
                </div>
              </div>
            </div>
                            
<?php

$tampil = mysqli_query($koneksi, "SELECT * FROM artikel 
    WHERE id_artikel='$_GET[id_artikel]'");

while($data = mysqli_fetch_array($tampil)):
?>
                    <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="Deleteartikel<?= $_GET['id_artikel']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="forms-sample" method="POST" action="admin_data.php">
                                            <input type="hidden" class="form-control" id="idaward" placeholder="" name="id_artikel" value="<?= $data['id_artikel']; ?>">
                                            <input type="hidden" class="form-control" name="status" value="1">
                                            <div class="modal-body">
                                                <h5 class="text-center" id="approveAward">Apakah kamu yakin ingin menghapus data?
                                                    <span class="text-danger"><?= $data['judul_artikel'] ?></span>
                                                </h5>
                                            </div>
                                            <!-- Input hidden untuk menyimpan ID Admin yang akan dihapus -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="hapusartikel">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal Konfirmasi Penghapusan -->      
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <form class="form-sample" enctype="multipart/form-data" method="POST" action="admin_data.php">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Thumbnail</label>
                        <div class="col-sm-9">
                          <img id="preview" src="../../directory/imgartikel/<?= $data['thumb_artikel'] ?>" style="max-width: 100%; max-height: 200px;">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="judulInput" name="judulInput" value="<?= $data['judul_artikel'] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" value="<?= $data['deskripsi_artikel'] ?>" readonly><?= $data['deskripsi_artikel'] ?>"</textarea>
                        </div>
                      </div>
                    </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori</label>
                          <div class="col-sm-9">
                            <input class="form-control" name="kategori" value="<?= $data['kategori_artikel'] ?>" readonly>
                            </input>
                          </div>
                        </div>
                      </div>
                    <h4 class="card-title">
                      Isi Konten
                    </h4>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Konten</label>
                        <div class="col-sm-9">
                          <?= $data['konten_artikel'] ?>

                        </div>
                      </div>
                    </div>
                  <?php endwhile; ?>
                  <div class="col-md-12"> 
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Images</label>
                    <div class="col-sm-9">
                      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                      <div class="col-sm-9">
                      <div class="carousel-inner">
                        <?php
                        $tampi = mysqli_query($koneksi, "SELECT * FROM artikel_img 
                            INNER JOIN artikel ON artikel_img.id_artikel = artikel.id_artikel
                            WHERE artikel.id_artikel='$_GET[id_artikel]'");
                        
                        $firstItem = true; // Flag untuk menentukan item pertama
                        
                        while($data = mysqli_fetch_array($tampi)):
                        ?>
                        <div class="carousel-item <?= $firstItem ? 'active' : '' ?>" data-bs-interval="10000">
                          <img src="../../directory/imgartikel/<?= $data['file_artikel'] ?>" class="d-block w-100" alt="...">
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
                    </div>
                     
                  </div> 
                </div>
                  
                    <div class="row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9 text-right">
                            <div class="modal-footer">
                              <a type="button" class="btn btn-secondary" href="artikel.php">Back</a>
                              &nbsp;
                              <a type="button" class="btn btn-danger" data-bs-toggle='modal' data-bs-target='#Deleteartikel<?= $_GET['id_artikel']; ?>'>Delete</a>
                              &nbsp;
                              <a type="button" class="btn btn-primary" href="artikel_edit.php?id_artikel=<?= $_GET['id_artikel']; ?>">Edit</a>
                            </div>
                          </div>
                    </div>  
          
                  </form>

                </div>
              </div>
            </div>
            
          </div>
        </div>
        <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
  <!-- container-scroller -->

<!-- Include JS -->

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Include Trumbowyg JS -->
<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.26.0/dist/trumbowyg.min.js"></script>

<!-- Your other scripts and styles -->

<script>
  $(document).ready(function() {
    $('#TextEditor').trumbowyg();
  });
</script>

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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

