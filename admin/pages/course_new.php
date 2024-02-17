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
  <title>DKV UPI - Course</title>
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
                  <h4 class="card-title">Data Mata Kuliah</h4>
                  <p>Tambahkan mata kuliah terbaru.</p>
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
                        <label class="col-sm-3 col-form-label">Kode</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode Mata Kuliah">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Mata Kuliah</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="matakuliah" name="matakuliah" placeholder="Mata Kuliah">
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
                          <label class="col-sm-3 col-form-label">Semester</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="semester">
                                <option>None</option>
                                <option>Semester 1</option>
                                <option>Semester 2</option>
                                <option>Semester 3</option>
                                <option>Semester 4</option>
                                <option>Semester 5</option>
                                <option>Semester 6</option>
                                <option>Semester 7</option>
                                <option>Semester 8</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">SKS</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="sks">
                                <option>None</option>
                                <option>1 SKS, 45 Menit</option>
                                <option>2 SKS, 90 Menit</option>
                                <option>3 SKS, 135 Menit</option>
                                <option>4 SKS, 175 Menit</option>
                                <option>5 SKS, 225 Menit</option>
                                <option>6 SKS, 270 Menit</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    <h4 class="card-title">
                      Isi Pengantar
                    </h4>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pengantar</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id="TextEditor" name="pengantar" rows="4"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Link Utama</label>
                        <div class="col-sm-9">
                          <input type="url" class="form-control" id="linkutama" name="linkutama" placeholder="Link Lengkap">
                          <p class="text-danger">Jika kamu memiliki satu link media.</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Media</label>
                          <div class="col-md-9">
                              <div id="imageInputsContainer">
                                  <!-- Container untuk input file -->
                                  <div class="input-group mb-3">
                                      
                                  </div>
                              </div>
                              <button type="button" class="btn btn-success btn-sm mt-2" onclick="addImageInput()"><i class="icon-image"></i> Tambah Media</button>
                              <p class="text-danger">Format hanya berupa link</p>
                          </div>
                      </div>
                  </div>

                    <div class="row">
                          <label class="col-sm-3 col-form-label"></label>
                          <div class="col-sm-9 text-right">
                            <div class="modal-footer">
                              <a type="button" class="btn btn-secondary" href="course.php">Back</a>
                              &nbsp;
                              <button type="submit" class="btn btn-primary" name="simpancourse">Simpan</button>
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
    if (totalFiles < 10) {
        var newInputContainer = document.createElement('div');
        newInputContainer.className = 'input-group mb-3';

        var inputIndex = totalFiles + 1;

        newInputContainer.innerHTML = `
                                      <select class="form-control btn-primary" name="kategorimedia[]">
                                          <option value="Kategori">Kategori</option>
                                          <option value="Drive">Drive</option>
                                          <option value="Youtube">Youtube</option>
                                          <option value="Ms.Word">Ms.Word</option>
                                          <option value="PDF">PDF</option>
                                          <option value="Lainnya">Lainnya</option>
                                      </select>
                                      <input type="text" class="form-control col-md-4" placeholder="Nama File" accept="image/jpeg, image/png" name="file_namacourse[]" id="file_namacourse_${inputIndex}"> <br>
                                      <input type="url" class="form-control col-md-4" placeholder="Link File" accept="image/jpeg, image/png" name="file_course[]" id="file_media_${inputIndex}">
                                      <button type="button" class="btn btn-danger btn-md" onclick="removeImageInput(this, ${inputIndex})">Hapus</button>

                                    
                                    
        `;

        imageInputsContainer.appendChild(newInputContainer);
        totalFiles++;
    } else {
        alert('Maksimal 10 media sudah tercapai.');
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

