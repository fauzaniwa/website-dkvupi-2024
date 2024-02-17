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
  <title>DKV UPI - Dosen</title>
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
                  <h4 class="card-title">Data dosen</h4>
                  <p class="card-description">Tambah atau edit data dosen.</p>
                      <button type="button" class="btn btn-outline-primary btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#Adddosen">
                              <i class="ti-file btn-icon-prepend"></i>
                              Add New dosen
                      </button>
                  <div class="table-responsive">
                    <table class="table table-hover" id="data-table">
                        <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama</th>
                          <th>NIP</th>
                          <th>Email</th>
                          <th>Created</th>
                          <th>Settings</th>
                        </tr>

                            <?php 

                            //tampilkan data
                            $no = 1;
                            $tampil = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY id_dosen DESC");
                            while($data = mysqli_fetch_array($tampil)) :

                            ?>

                            <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_dosen'] ?></td>
                            <td><?= $data['nip_dosen'] ?></td>
                            <td><?= $data['email_dosen'] ?></td>
                            <td><?= $data['created_dosen'] ?></td>
                            <td>
                              <div class="dropdown">
                              <button type="button" class="btn btn-danger btn-sm dropdown-toggle" id="dropdownMenuIconButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-settings"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7">
                                <h6 class="dropdown-header">Settings</h6>
                                <a type="button" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#Editdosen<?= $no; ?>'>Edit</a>
                                <a type="button" class="dropdown-item" data-bs-toggle='modal' data-bs-target='#Deletedosen<?= $no; ?>'>Delete</a>
                              </div>
                              </div>
                            </td>
                            </tr>
                    <!-- Modal Ubah dosen -->
                    <div class="modal fade" id="Editdosen<?= $no; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Dosen Baru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form class="forms-sample" method="POST" action="admin_data.php" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="iddosen" placeholder="Nama Lengkap" name="id_dosen" value="<?= $data['id_dosen']?>" >
                                <div class="modal-body">
                                            <div>
                                              <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                      <label for="img" class="col-sm-3 col-form-label">Profile Picture</label>
                                                      <div class="col-sm-9 text-center">
                                                          <?php if (!empty($data['img_dosen'])): ?>
                                                              <div style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; margin: 0 auto;">
                                                              <img src="../../directory/profile/<?= $data['img_dosen'] ?>" alt="Current Profile Image" style="width: 100%; height: 100%; object-fit: cover;">  
                                                              </div>
                                                            <?php endif; ?>
                                                              <input type="file" class="form-control" id="img" name="timg">
                                                              <p class="text-danger"><?= $data['img_dosen']?></p>
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
                                                      <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="tname" value="<?= $data['nama_dosen']?>">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                                      <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="nip" placeholder="NIP" name="tnip" value="<?= $data['nip_dosen']?>">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                      <div class="col-sm-9">
                                                        <input type="email" class="form-control" id="email" placeholder="Email" name="temail" value="<?= $data['email_dosen']?>">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                                      <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="phone" placeholder="Phone" name="tphone" value="<?= $data['phone_dosen']?>">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
                                                      <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="instagram" placeholder="Instagram" name="tinstagram" value="<?= $data['instagram_dosen']?>">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="bio" class="col-sm-3 col-form-label">Bio</label>
                                                      <div class="col-sm-9">
                                                        <textarea class="form-control" id="bio" placeholder="Bio" name="tbio" value="<?= $data['bio_dosen']?>"><?= $data['bio_dosen']?></textarea>
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                      <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="password" placeholder="Password" name="tpassword" value="<?= $data['password_dosen']?>">
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>

                                </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mr-2" name="editdosen">Save</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Close</button>
                              </div>
                          
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Ubah dosen End -->

                            <!-- Modal Konfirmasi Penghapusan -->
                            <div class="modal fade" id="Deletedosen<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="forms-sample" method="POST" action="admin_data.php">
                                            <input type="hidden" class="form-control" id="iddosen" placeholder="Nama Lengkap" name="id_dosen" value="<?= $data['id_dosen']?>">
                                            <div class="modal-body">
                                                <h5 class="text-center" id="deletedosenInfo">Apakah kamu yakin ingin menghapus data?
                                                    <span class="text-danger"><?= $data['nama_dosen'] ?></span>
                                                </h5>
                                            </div>
                                            <!-- Input hidden untuk menyimpan ID dosen yang akan dihapus -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="deletedosen">Hapus</button>
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

                    <!-- Modal Add dosen -->
                    <div class="modal fade" id="Adddosen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Dosen Baru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form class="forms-sample" method="POST" action="admin_data.php" enctype="multipart/form-data">
                              <div class="modal-body">
                                            <div>
                                              <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                      <label for="img" class="col-sm-3 col-form-label">Profile Picture</label>
                                                      <div class="col-sm-9">
                                                        <input type="file" class="form-control" id="img" placeholder="IMG Profile" name="timg">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
                                                      <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="tname">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                                      <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="nip" placeholder="NIP" name="tnip">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                      <div class="col-sm-9">
                                                        <input type="email" class="form-control" id="email" placeholder="Email" name="temail">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                                      <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="phone" placeholder="Phone" name="tphone">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="instagram" class="col-sm-3 col-form-label">Instagram</label>
                                                      <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="instagram" placeholder="Instagram" name="tinstagram">
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="bio" class="col-sm-3 col-form-label">Bio</label>
                                                      <div class="col-sm-9">
                                                        <textarea class="form-control" id="bio" placeholder="Bio" name="tbio"></textarea>
                                                      </div>
                                                    </div>
                                                    <div class="form-group row">
                                                      <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                      <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="password" placeholder="Password" name="tpassword">
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>

                                </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mr-2" name="savedosen">Save</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Close</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Add dosen End -->


                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
                    

        </div>
        <!-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dosen template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        -->
        <!-- partial -->
        
        </div>
        </div>

        <!-- page-body-wrapper ends -->
    </div>
  <!-- container-scroller -->

  <script src="../js/script.js"></script>
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


        
