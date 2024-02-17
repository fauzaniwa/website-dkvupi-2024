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
  <style>
  .judul-artikel {
    max-width: 200px; /* Atur lebar maksimal yang diinginkan */
    white-space: nowrap; /* Hentikan teks untuk tidak memotong baris */
    overflow: hidden; /* Sembunyikan teks yang keluar dari lebar maksimal */
    text-overflow: ellipsis; /* Tambahkan titik elipsis (...) untuk menunjukkan teks yang terpotong */
  }
</style>

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
                  <p class="card-description">Edit atau Delete data artikelfolio.</p>
                    <a type="button" class="btn btn-outline-primary btn-sm btn-icon-text" href="artikel_new.php">
                              <i class="ti-file btn-icon-prepend"></i>
                              Add New
                      </a>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Thumbnail</th>
                          <th>Judul</th>
                          <th>Kategori</th>
                          <th>Like</th>
                          <th>View</th>
                          <th>Upload</th>
                          <th>Action</th>
                        </tr>

                            <?php 

                            //tampilkan data
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id_artikel DESC");
                            while($data = mysqli_fetch_array($tampil)) :

                            ?>

                          <tr>
                          <td><?= $no++ ?></td>
                          <td>
                          <img src="../../directory/imgartikel/<?= $data['thumb_artikel'] ?>" class="img-thumbnail" alt="Thumbnail Image <?= $data['thumb_artikel'] ?>"
                            style="max-width: 213px; max-height: 120px; width: 100%; height: auto; border-radius: 0;">
                          </td>

                          <td class="judul-artikel"><?= $data['judul_artikel'] ?></td>
                          <td><?= $data['kategori_artikel'] ?></td>
                          <td><?= $data['like_artikel'] ?></td>
                          <td><?= $data['view_artikel'] ?></td>
                          <td><?= $data['date_artikel'] ?> (<?= $data['time_artikel'] ?>)</td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn btn-danger btn-sm dropdown-toggle" id="dropdownMenuIconButton<?= $no; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-user"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton<?= $no; ?>">
                                <h6 class="dropdown-header">Action</h6>
                                <a class="dropdown-item" href="artikel_details.php?id_artikel=<?= $data['id_artikel']?>">Details</a>
                                <a class="dropdown-item" href="artikel_edit.php?id_artikel=<?= $data['id_artikel']?>">Edit</a>
                                <a type="button" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#Deleteartikel<?= $no; ?>'>Delete</a>
                              </div>
                            </div>
                          </td>

                        </tr>
                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="Deleteartikel<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="forms-sample" method="POST" action="admin_data.php">
                                            <input type="hidden" class="form-control" id="idaward" placeholder="" name="id_artikel" value="<?= $data['id_artikel']?>">
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
                        <?php endwhile; ?>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
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

  <!-- plugins:js -->
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

