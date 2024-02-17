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
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            cursor: pointer;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .gallery-item .overlay-content {
            text-align: center;
        }
    </style>








  <title>DKV UPI - gallery</title>

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
  <script>
    var totalFiles = 1;

    function previewImage(input) {
        var fileInput = input;
        var inputIndex = getFileInputIndex(fileInput);
        var previewImage = document.getElementById(`preview_${inputIndex}`);

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
            }

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            previewImage.src = '../../directory/imgartikel/noneimg.png'; // Jika input file kosong, kosongkan pratinjau
        }
    }

    function addImageInput() {
        var imageInputsContainer = document.getElementById('imageInputsContainer');

        if (totalFiles < 5) {
            totalFiles++;
            var newInputContainer = document.createElement('div');
            newInputContainer.className = 'form-group row';

            newInputContainer.innerHTML = `
                <label for="img" class="col-sm-3 col-form-label">Preview</label>
                <img class="mr-2" src="../../directory/imgartikel/noneimg.png" style="max-width: 100%; max-height: auto;" id="preview_${totalFiles}">
                <label for="img" class="col-sm-3 col-form-label">Picture</label>
                <div class="col-sm-9">
                    <input type="file" class="btn btn-primary btn-sm" name="file_artikel[]" id="file_artikel_${totalFiles}" accept="image/jpeg, image/png" onchange="previewImage(this)">
                </div>
                <label for="judulcontent" class="col-sm-3 col-form-label">Kegiatan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="judulcontent_${totalFiles}" placeholder="Judul Kegiatan pada konten" name="judulcontent[]">
                </div>
                <button type="button" class="btn btn-danger mt-2 btn-sm" onclick="removeImageInput(this, ${totalFiles})">Hapus</button>
            `;

            imageInputsContainer.appendChild(newInputContainer);
        } else {
            alert('Maksimal 5 gambar sudah tercapai.');
        }
    }

    function removeImageInput(button, inputIndex) {
        var imageInputsContainer = document.getElementById('imageInputsContainer');
        var inputContainer = button.parentElement;
        imageInputsContainer.removeChild(inputContainer);
        totalFiles--;

        for (var i = inputIndex; i <= totalFiles; i++) {
            var fileInput = document.getElementById(`file_artikel_${i + 1}`);
            var judulInput = document.getElementById(`judulcontent_${i + 1}`);
            var previewImage = document.getElementById(`preview_${i + 1}`);

            if (fileInput && judulInput && previewImage) {
                fileInput.id = `file_artikel_${i}`;
                judulInput.id = `judulcontent_${i}`;
                previewImage.id = `preview_${i}`;
            }
        }
    }

    function getFileInputIndex(fileInput) {
        return parseInt(fileInput.id.split('_')[2]);
    }
</script>

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

<?php
// Fungsi pencarian dan filter
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($koneksi, $_POST['searchTerm']);
    $query = "SELECT * FROM gallery WHERE judul_gallery LIKE '%$searchTerm%' ORDER BY id_gallery DESC";
} elseif (isset($_POST['filterBy']) && $_POST['filterBy'] == 'like_gallery') {
    $query = "SELECT * FROM gallery ORDER BY like_gallery DESC";
} elseif (isset($_POST['filterBy']) && $_POST['filterBy'] == 'date_terlama') {
    $query = "SELECT * FROM gallery ORDER BY date_gallery ASC";
} elseif (isset($_POST['filterBy']) && $_POST['filterBy'] == 'date_terbaru') {
    $query = "SELECT * FROM gallery ORDER BY date_gallery DESC";
} else {
    $query = "SELECT * FROM gallery ORDER BY id_gallery DESC";
}

$no = 1;
$tampil = mysqli_query($koneksi, $query);
?>
        <!-- partial -->
        <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Gallery</h4>
                  <p class="card-description">View atau Delete gallery.</p>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="searchTerm" class="form-control btn-sm-6" placeholder="Cari berdasarkan judul" />
                            </div>
                            <div class="col-md-4">
                                <select name="filterBy" class="form-control btn-primary btn-sm-6">
                                    <option value="like_gallery">Like Terbanyak</option>
                                    <option value="date_terlama">Tanggal Terlama</option>
                                    <option value="date_terbaru">Tanggal Terbaru</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="btn btn-primary btn-sm" name="search" value="Cari" />
                            </div>
                        </div>
                    </form> <br>
                    <button type="button" class="btn btn-outline-primary btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#addgallery">
                              <i class="ti-file btn-icon-prepend"></i>
                              Add New Content
                      </button>
                      <div class="table-responsive">
                      <br> <br>
                            <div class="gallery">
                                <?php
                                while ($data = mysqli_fetch_array($tampil)) :
                                ?>
                                    <div class="gallery-item">
                                        <img src="../../directory/imggallery/<?= $data['file_gallery'] ?>" alt="Image <?= $no ?>">
                                        <div class="overlay">
                                            <div class="overlay-content">
                                                <input type="hidden" class="form-control" id="idgallery" name="id_gallery" value="<?= $data['id_gallery'] ?>">
                                                <h4 class="card-title text-white"><?= $data['judul_gallery'] ?></h4>
                                                <p class="text-info"><?= $data['date_gallery'] ?>, <?= $data['time_gallery'] ?></p>
                                                <button type="button" class="btn btn-outline-primary btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#viewcontent<?= $data['id_gallery'] ?>">
                                                    <i class="ti-eye btn-icon-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#deletecontent<?= $data['id_gallery'] ?>">
                                                    <i class="ti-trash btn-icon-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                          
                           <!-- Modal View -->
                            <div class="modal fade" id="viewcontent<?= $data['id_gallery']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg"> 
                                  <!-- Menambahkan class modal-lg untuk membuat modal lebih besar -->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?= $data['judul_gallery']?></h5>                
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <p><i class="icon-clock"></i> : <?= $data['date_gallery']?> - <?= $data['time_gallery']?>
                                            </p>
                                            <img src="../../directory/imggallery/<?= $data['file_gallery']?>" alt="<?= $data['file_gallery']?>" class="img-fluid"> 
                                            
                                            <!-- Menambahkan class img-fluid untuk membuat gambar responsif -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal View -->

                            <!-- Modal Konfirmasi Hapus -->
                            <div class="modal fade" id="deletecontent<?= $data['id_gallery']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="forms-sample" method="POST" action="admin_data.php">
                                            <input type="hidden" class="form-control" id="idgalerry" placeholder="" name="id_gallery" value="<?= $data['id_gallery']?>">
                                            <input type="hidden" class="form-control" name="status" value="1">
                                            <div class="modal-body">
                                                <h5 class="text-center" id="approveAward">Apakah kamu yakin ingin menghapus foto?
                                                    <span class="text-danger"><?= $data['judul_gallery'] ?></span>
                                                </h5>
                                            </div>
                                            <!-- Input hidden untuk menyimpan ID Admin yang akan dihapus -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger" name="deletegallery">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir Modal Konfirmasi Penghapusan -->
                            <?php endwhile; ?>
                          </div>

                    <!-- Modal Add gallery -->
                    <div class="modal fade" id="addgallery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gallery Baru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form class="forms-sample" method="POST" action="admin_data.php" enctype="multipart/form-data">
                              <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p class="text-danger">Format hanya jpg/png dengan maksimal size 2mb</p>
                                                    <div id="imageInputsContainer">
                                                        <!-- Awal Input Gambar -->
                                                        <div class="form-group row">
                                                            <label for="img" class="col-sm-3 col-form-label">Preview</label>
                                                            <img class="mr-2" src="../../directory/imgartikel/noneimg.png" style="max-width: 100%; max-height: auto;" id="preview_1">
                                                            <label for="img" class="col-sm-3 col-form-label">Picture</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" class="btn btn-primary btn-sm" name="file_artikel[]" id="file_artikel_1" accept="image/jpeg, image/png" onchange="previewImage(this)">
                                                            </div>
                                                            <label for="judulcontent" class="col-sm-3 col-form-label">Kegiatan</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="judulcontent_1" placeholder="Judul Kegiatan pada konten" name="judulcontent[]">
                                                            </div>
                                                            <button type="button" class="btn btn-danger mt-2 btn-sm" onclick="removeImageInput(this, 1)">Hapus</button>
                                                        </div>
                                                        <!-- Akhir Input Gambar -->

                                                    </div>
                                                    <button type="button" class="btn btn-success btn-sm mt-2" onclick="addImageInput()"><i class="icon-image"></i> Tambah Gambar</button>
                                                </div>
                                            </div>
                                </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary mr-2" name="simpancontent">Save</button>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close">Close</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Add gallery End -->

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

