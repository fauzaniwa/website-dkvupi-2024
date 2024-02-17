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
                  <h4 class="card-title">Data Awards Mahasiswa</h4>
                  <p class="card-description">Approve atau Delete data Awards.
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>NIM</th>
                          <th>Nama Kegiatan</th>
                          <th>Tingkat Kegiatan</th>
                          <th>Upload</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>

<?php 
$no = 1;
$tampil = mysqli_query($koneksi, "SELECT * FROM award 
      INNER JOIN mahasiswa ON award.id_mahasiswa = mahasiswa.id_mahasiswa
      ORDER BY award.id_award DESC");

while($data = mysqli_fetch_array($tampil)):
?>

                          <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $data['name_mahasiswa'] ?></td>
                          <td><?= $data['nim_mahasiswa'] ?></td>
                          <td><?= $data['judul_award'] ?></td>
                          <td><?= $data['tingkat_award'] ?></td>
                          <td><?= $data['date_award'] ?></td>
                          <td>
                            <?php if ($data['status_award'] == 0): ?>
                              <label class="badge badge-warning">Pending</label>
                            <?php else: ?>
                              <label class="badge badge-success">Approved</label>
                            <?php endif; ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn btn-danger btn-sm dropdown-toggle" id="dropdownMenuIconButton<?= $no; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-user"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton<?= $no; ?>">
                                <h6 class="dropdown-header">Action</h6>
                                <a class="dropdown-item" href="awards_details.php?id_award=<?= $data['id_award']?>">Details</a>
                                
                                <?php if ($data['status_award'] == 0): ?>
                                  <!-- Tampilkan tombol Approve jika status_award == 0 -->
                                  <a type="button" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#ApproveAward<?= $no; ?>'>Approve</a>
                                <?php endif; ?>
                                
                                <a type="button" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#DeleteAward<?= $no; ?>'>Delete</a>
                              </div>
                            </div>
                          </td>

                        </tr>

                          <!-- Modal Konfirmasi Approve -->
                            <div class="modal fade" id="ApproveAward<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Approve</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="forms-sample" method="POST" action="admin_data.php">
                                            <input type="hidden" class="form-control" id="idaward" placeholder="" name="id_award" value="<?= $data['id_award']?>">
                                            <input type="hidden" class="form-control" name="status" value="1">
                                            <div class="modal-body">
                                                <h5 class="text-center" id="approveAward">Kamu akan menyetujui <span class="text-danger"><?= $data['judul_award'] ?></span> untuk dapat di publish?
                                                </h5>
                                            </div>
                                            <!-- Input hidden untuk menyimpan ID Admin yang akan dihapus -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary" name="simpanaward">Setuju</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal Konfirmasi Penghapusan -->

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="DeleteAward<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="forms-sample" method="POST" action="admin_data.php">
                                            <input type="hidden" class="form-control" id="idaward" placeholder="" name="id_award" value="<?= $data['id_award']?>">
                                            <input type="hidden" class="form-control" name="status" value="1">
                                            <div class="modal-body">
                                                <h5 class="text-center" id="approveAward">Apakah kamu yakin ingin menghapus data?
                                                    <span class="text-danger"><?= $data['judul_award'] ?></span>
                                                </h5>
                                            </div>
                                            <!-- Input hidden untuk menyimpan ID Admin yang akan dihapus -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="deleteaward">Hapus</button>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

