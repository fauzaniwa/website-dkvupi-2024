<?php
require 'koneksi.php';

$query = "SELECT * FROM gallery ORDER BY id_gallery DESC";
$tampil = mysqli_query($koneksi, $query);

while ($data = mysqli_fetch_array($tampil)) {
    // Output struktur HTML untuk satu item galeri
    echo '<div class="gallery-item">';
    echo '<img src="../../directory/imggallery/<?= $data['file_gallery'] ?>" alt="Image <?= $no ?>">'
                                        echo '<div class="overlay">'
                                            echo '<div class="overlay-content">'
                                                echo '<input type="hidden" class="form-control" id="idgallery" name="id_gallery" value="<?= $data['id_gallery'] ?>">'
                                                echo '<h4 class="card-title text-white"><?= $data['judul_gallery'] ?></h4>'
                                                echo '<p class="text-info"><?= $data['date_gallery'] ?>, <?= $data['time_gallery'] ?></p>'
                                                echo '<button type="button" class="btn btn-outline-primary btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#viewcontent<?= $data['id_gallery'] ?>">
                                                    <i class="ti-eye btn-icon-eye"></i>
                                                </button>'
                                                echo '<button type="button" class="btn btn-outline-danger btn-sm btn-icon-text" data-bs-toggle="modal" data-bs-target="#deletecontent<?= $data['id_gallery'] ?>">
                                                    <i class="ti-trash btn-icon-trash"></i>
                                                </button>'
                                            echo '</div>'
                                        echo '</div>'
    echo '</div>';
}
?>
