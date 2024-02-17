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

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <form class="form-sample" enctype="multipart/form-data" method="POST" action="admin_data.php">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                          <img id="preview" src="../../directory/imgartikel/noneimg.png" style="max-width: 100%; max-height: 200px;">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Thumbnail</label>
                        <div class="col-sm-9">
                          <input type="file" class="btn btn-primary btn-sm" id="gambarInput" accept="image/jpeg, image/png" name="gambarInput" onchange="previewImage()">
                          <p class="text-danger">Format hanya jpg/png dengan maksimal size 2mb</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="judulInput" name="judulInput" placeholder="Judul max. 15 kata.">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                          <p class="text-danger">Berisi deskripsi singkat untuk ditampilkan dalam preview.</p>
                        </div>
                      </div>
                    </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Kategori</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="kategori">
                                <option>None</option>
                                <option>Seputar DKV</option>
                                <option>Prestasi DKV</option>
                                <option>Agenda DKV</option>
                                <option>Info DKV</option>
                                <option>Seputar DKV</option>
                                <option>DKV Greeting</option>
                                <option>DKV Berduka</option>
                            </select>
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
                          <textarea class="form-control" id="TextEditor" name="TextEditor" rows="4"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Images</label>
                          <div class="col-sm-9">
                              <div id="imageInputsContainer">
                                  <!-- Container untuk input file -->
                                  <div class="input-group mb-3">
                                      
                                  </div>
                              </div>
                              <button type="button" class="btn btn-success btn-sm mt-2" onclick="addImageInput()"><i class="icon-image"></i> Tambah Gambar</button>
                              <p class="text-danger">Format hanya jpg/png dengan maksimal size 2mb</p>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9 text-right">
                            <div class="modal-footer">
                              <a type="button" class="btn btn-secondary" href="artikel.php">Back</a>
                              &nbsp;
                              <button type="submit" class="btn btn-primary" name="simpanartikel">Simpan</button>
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
  <script>
  function previewImage() {
    var gambarInput = document.getElementById('gambarInput');
    var preview = document.getElementById('preview');

    // Memeriksa apakah input file tidak kosong
    if (gambarInput.files && gambarInput.files[0]) {
      // Verifikasi ukuran file (maksimum 2MB)
      if (gambarInput.files[0].size > 2 * 1024 * 1024) {
        alert('Ukuran file melebihi batas maksimum (2MB). Silakan pilih file lain.');
        gambarInput.value = ''; // Menghapus nilai input file
        return;
      }

      var reader = new FileReader();

      reader.onload = function (e) {
        preview.src = e.target.result;
      }

      reader.readAsDataURL(gambarInput.files[0]);
    } else {
      // Jika input file kosong, beri nilai default
      preview.src = '../../directory/imgartikel/noneimg.png';
    }
  }

  </script>

  <script>
        function previewImageContent(input) {
            // Fungsi untuk menampilkan pratinjau gambar

            var imageInput = input;
            var imageContainer = imageInput.parentElement; // Container input file
            var previewImage = imageContainer.querySelector('img');

            if (imageInput.files && imageInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                }

                reader.readAsDataURL(imageInput.files[0]);
            } else {
                previewImage.src = ''; // Jika input file kosong, kosongkan pratinjau
            }
        }

var totalFiles = 0;

function addImageInput() {
    // Fungsi untuk menambahkan input file baru
    var imageInputsContainer = document.getElementById('imageInputsContainer');

    // Batasi jumlah maksimal input file
    if (totalFiles < 5) {
        var newInputContainer = document.createElement('div');
        newInputContainer.className = 'input-group mb-3';

        var inputIndex = totalFiles + 1;

        newInputContainer.innerHTML = `
            <img class="mr-2" src="#" style="max-width: 100px; max-height: 100px;">
            <input type="file" class="btn btn-primary btn-sm" accept="image/jpeg, image/png" name="file_artikel[]" id="file_artikel_${inputIndex}" onchange="previewImageContent(this)">
            <button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeImageInput(this, ${inputIndex})">Hapus</button>
        `;

        imageInputsContainer.appendChild(newInputContainer);
        totalFiles++;
    } else {
        alert('Maksimal 5 gambar sudah tercapai.');
    }
}

function removeImageInput(button, inputIndex) {
    // Fungsi untuk menghapus input file
    var imageInputsContainer = document.getElementById('imageInputsContainer');
    var inputContainer = button.parentElement; // Container input file

    // Hapus input file dari container
    imageInputsContainer.removeChild(inputContainer);
    totalFiles--;

    // Mengganti nama file yang dihapus dengan yang masih ada
    for (var i = inputIndex; i <= totalFiles; i++) {
        var fileInput = document.getElementById(`file_artikel_${i}`);
        if (fileInput) {
            fileInput.name = `file_artikel_${i}`;
        }
    }
}

    </script>

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

