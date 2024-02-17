<?php  
include "koneksi.php";



// Fungsi SimpanAdmin
if(isset($_POST['saveadmin'])) {

    // Simpan Data Baru
    $tambahadmin = mysqli_query($koneksi, "INSERT INTO admin (nama_admin, username_admin, email_admin, password_admin)VALUES ('$_POST[tname]',
                '$_POST[tusername]',
                '$_POST[temail]',
                '$_POST[tpassword]') ");

    // Jika berhasil insert
    if ($tambahadmin) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location='admin.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location='admin.php';
            </script>";
    }

}

// Fungsi EditAdmin
if(isset($_POST['editadmin'])) {

    // Ubah Data
    $editadmin = mysqli_query($koneksi, "UPDATE admin SET 
                                nama_admin = '$_POST[tname]',
                                username_admin = '$_POST[tusername]',
                                email_admin = '$_POST[temail]',
                                password_admin = '$_POST[tpassword]' 
                                WHERE id_admin = '$_POST[id_admin]'
                                ");

    // Jika berhasil ubah
    if ($editadmin) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location='admin.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location='admin.php';
            </script>";
    }

}

// Fungsi DeleteAdmin
if(isset($_POST['deleteadmin'])) {

    // Hapus Data
    $deleteadmin = mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin = '$_POST[id_admin]'");

    // Jika berhasil hapus
    if ($deleteadmin) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location='admin.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                document.location='admin.php';
            </script>";
    }

}


// Fungsi SimpanDosen
if(isset($_POST['savedosen'])) {
    // Folder tempat menyimpan file gambar
    $uploadDir = '../../directory/profile/';

    // Ambil nama file
    $fileName = $_FILES['timg']['name'];

    // Dapatkan timestamp saat ini
    $timestamp = time();

    // Gabungkan nama file dengan timestamp
    $newFileName = $timestamp . '_' . $fileName;

    // Tentukan path file baru untuk disimpan
    $uploadFile = $uploadDir . basename($newFileName);

    // Simpan data baru ke database
    $tambahdosen = mysqli_query($koneksi, "INSERT INTO dosen (nama_dosen, nip_dosen, email_dosen, password_dosen, phone_dosen, instagram_dosen, bio_dosen, img_dosen) VALUES (
        '$_POST[tname]',
        '$_POST[tnip]',
        '$_POST[temail]',
        '$_POST[tpassword]',
        '$_POST[tphone]',
        '$_POST[tinstagram]',
        '$_POST[tbio]',
        '$newFileName'
    ) ");

    // Jika berhasil insert, pindahkan file ke folder yang ditentukan
    if ($tambahdosen) {
        if (move_uploaded_file($_FILES['timg']['tmp_name'], $uploadFile)) {
            echo "<script>
                    alert('Data berhasil ditambahkan!');
                    document.location='dosen.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal menyimpan file gambar!');
                    document.location='dosen.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location='dosen.php';
            </script>";
    }
}

// Fungsi Edit Dosen
if (isset($_POST['editdosen'])) {
    // Folder tempat menyimpan file gambar
    $uploadDir = '../../directory/profile/';

    // Ambil id_dosen
    $idDosen = $_POST['id_dosen'];

    // Ambil nama file lama dari database
    $result = mysqli_query($koneksi, "SELECT img_dosen FROM dosen WHERE id_dosen = '$idDosen'");
    $row = mysqli_fetch_assoc($result);
    $oldFileName = $row['img_dosen'];

    // Ambil nama file baru
    $newFileName = '';

    if (!empty($_FILES['timg']['name'])) {
        // Jika ada gambar baru diunggah
        // Dapatkan timestamp saat ini
        $timestamp = time();

        // Ambil nama file
        $fileName = $_FILES['timg']['name'];

        // Gabungkan nama file dengan timestamp
        $newFileName = $timestamp . '_' . $fileName;

        // Tentukan path file baru untuk disimpan
        $uploadFile = $uploadDir . basename($newFileName);

        // Pindahkan file ke folder yang ditentukan
        if (!move_uploaded_file($_FILES['timg']['tmp_name'], $uploadFile)) {
            echo "<script>
                    alert('Gagal menyimpan file gambar!');
                    document.location='dosen.php';
                </script>";
            exit(); // Keluar dari skrip jika upload gagal
        }

        // Hapus file lama jika file baru diupload
        if (!empty($newFileName) && file_exists($uploadDir . $oldFileName)) {
            unlink($uploadDir . $oldFileName);
        }
    } else {
        // Jika tidak ada gambar baru diunggah
        // Gunakan nama file lama
        $newFileName = $oldFileName;
    }

    // Update data di database
    $editdosen = mysqli_query($koneksi, "UPDATE dosen SET 
                            nama_dosen = '$_POST[tname]',
                            nip_dosen = '$_POST[tnip]',
                            email_dosen = '$_POST[temail]',
                            password_dosen = '$_POST[tpassword]',
                            phone_dosen = '$_POST[tphone]',
                            instagram_dosen = '$_POST[tinstagram]',
                            bio_dosen = '$_POST[tbio]',
                            img_dosen = '$newFileName'
                            WHERE id_dosen = '$idDosen'
                        ");

    // Jika berhasil update
    if ($editdosen) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location='dosen.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location='dosen.php';
            </script>";
    }
}

// Fungsi Delete Dosen
if(isset($_POST['deletedosen'])) {

    // Ambil nama file gambar dari database
    $result = mysqli_query($koneksi, "SELECT img_dosen FROM dosen WHERE id_dosen = '$_POST[id_dosen]'");
    $data = mysqli_fetch_assoc($result);
    $imgFileName = $data['img_dosen'];

    // Hapus file gambar dari folder
    $uploadDir = '../../directory/profile/';
    $imgPath = $uploadDir . $imgFileName;

    if (file_exists($imgPath)) {
        unlink($imgPath); // Hapus file gambar dari folder
    }

    // Hapus data dosen dari database
    $deletedosen = mysqli_query($koneksi, "DELETE FROM dosen WHERE id_dosen = '$_POST[id_dosen]'");

    // Jika berhasil hapus
    if ($deletedosen) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location='dosen.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                document.location='dosen.php';
            </script>";
    }
}

// Fungsi Delete Mahasiswa
if(isset($_POST['deletemahasiswa'])) {

    // Ambil nama file gambar dari database
    $result = mysqli_query($koneksi, "SELECT img_mahasiswa FROM mahasiswa WHERE id_mahasiswa = '$_POST[id_mahasiswa]'");
    $data = mysqli_fetch_assoc($result);
    $imgFileName = $data['img_mahasiswa'];

    // Hapus file gambar dari folder
    $uploadDir = '../../directory/profile/';
    $imgPath = $uploadDir . $imgFileName;

    if (file_exists($imgPath)) {
        unlink($imgPath); // Hapus file gambar dari folder
    }

    // Hapus data mahasiswa dari database
    $deletemahasiswa = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mahasiswa = '$_POST[id_mahasiswa]'");

    // Jika berhasil hapus
    if ($deletemahasiswa) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location='mahasiswa.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                document.location='mahasiswa.php';
            </script>";
    }
}

// Fungsi Approve Award
if(isset($_POST['simpanaward'])) {

    // Ubah Data
    $editadmin = mysqli_query($koneksi, "UPDATE award SET 
                                status_award = '$_POST[status]' 
                                WHERE id_award = '$_POST[id_award]'
                                ");

    // Jika berhasil ubah
    if ($editadmin) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location='awards.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location='awards.php';
            </script>";
    }

}

// Fungsi Delete Award
if(isset($_POST['deleteaward'])) {
    $id_award = $_POST['id_award'];

    // Ambil semua file_award yang memiliki id_award yang sama
    $result = mysqli_query($koneksi, "SELECT file_award FROM award_img WHERE id_award = '$id_award'");
    $filesToDelete = [];

    while ($data = mysqli_fetch_assoc($result)) {
        $filesToDelete[] = $data['file_award'];
    }

    // Hapus file-file tersebut dari folder
    $uploadDir = '../../directory/imgawards/';
    foreach ($filesToDelete as $file) {
        $imgPath = $uploadDir . $file;
        if (file_exists($imgPath)) {
            unlink($imgPath); // Hapus file gambar dari folder
        }
    }

    // Hapus semua data yang memiliki id_award yang sama dari tabel img_award
    $deleteImgAward = mysqli_query($koneksi, "DELETE FROM award_img WHERE id_award = '$id_award'");

    // Hapus data awards dari database
    $deleteAward = mysqli_query($koneksi, "DELETE FROM award WHERE id_award = '$id_award'");

    // Jika berhasil hapus
    if ($deleteAward && $deleteImgAward) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location='awards.php';
            </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menghapus data!');
                document.location='awards.php';
            </script>";
    }
}

// Fungsi Delete Portofolio
if(isset($_POST['deleteporto'])) {
    $id_porto = $_POST['id_porto'];

    // Ambil file thumb_porto
    $resultThumb = mysqli_query($koneksi, "SELECT thumb_porto FROM porto WHERE id_porto = '$id_porto'");
    $dataThumb = mysqli_fetch_assoc($resultThumb);
    $thumbToDelete = $dataThumb['thumb_porto'];

    // Hapus file thumb_porto dari folder
    $uploadDir = '../../directory/imgporto/';
    $thumbPath = $uploadDir . $thumbToDelete;
    if (file_exists($thumbPath)) {
        unlink($thumbPath); // Hapus file gambar dari folder
    }

    // Ambil semua file_porto yang memiliki id_porto yang sama
    $resultImg = mysqli_query($koneksi, "SELECT file_porto FROM porto_img WHERE id_porto = '$id_porto'");
    $filesToDelete = [];

    while ($dataImg = mysqli_fetch_assoc($resultImg)) {
        $filesToDelete[] = $dataImg['file_porto'];
    }

    // Hapus file-file tersebut dari folder
    foreach ($filesToDelete as $file) {
        $imgPath = $uploadDir . $file;
        if (file_exists($imgPath)) {
            unlink($imgPath); // Hapus file gambar dari folder
        }
    }

    // Hapus semua data yang memiliki id_porto yang sama dari tabel porto_img
    $deleteImgPorto = mysqli_query($koneksi, "DELETE FROM porto_img WHERE id_porto = '$id_porto'");

    // Hapus semua data yang memiliki id_porto yang sama dari tabel porto_tag
    $deleteTagPorto = mysqli_query($koneksi, "DELETE FROM porto_tag WHERE id_porto = '$id_porto'");

    // Hapus data porto dari database
    $deletePorto = mysqli_query($koneksi, "DELETE FROM porto WHERE id_porto = '$id_porto'");

    // Jika berhasil hapus
    if ($deletePorto && $deleteImgPorto && $deleteTagPorto) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location='portofolio.php';
            </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menghapus data!');
                document.location='portofolio.php';
            </script>";
    }
}


// Fungsi SimpanArtikel
if(isset($_POST['simpanartikel'])) {
    // Folder tempat menyimpan file gambar artikel
    $uploadDir = '../../directory/imgartikel/';

    // Ambil nama file thumbnail
    $thumbnailFileName = $_FILES['gambarInput']['name'];

    // Dapatkan timestamp saat ini untuk thumbnail
    $thumbnailTimestamp = time();

    // Gabungkan nama file thumbnail dengan timestamp
    $newThumbnailFileName = $thumbnailTimestamp . '_' . $thumbnailFileName;

    // Tentukan path file thumbnail baru untuk disimpan
    $thumbnailUploadFile = $uploadDir . basename($newThumbnailFileName);

    // Simpan data baru ke tabel artikel
    $query_artikel = "INSERT INTO artikel (judul_artikel, deskripsi_artikel, kategori_artikel, konten_artikel, thumb_artikel) VALUES (?, ?, ?, ?, ?)";
    $stmt_artikel = mysqli_prepare($koneksi, $query_artikel);
    mysqli_stmt_bind_param($stmt_artikel, "sssss", $_POST['judulInput'], $_POST['deskripsi'], $_POST['kategori'], $_POST['TextEditor'], $newThumbnailFileName);
    $tambahartikel = mysqli_stmt_execute($stmt_artikel);

    if ($tambahartikel) {
        // Pindahkan file thumbnail ke folder yang ditentukan
        if (move_uploaded_file($_FILES['gambarInput']['tmp_name'], $thumbnailUploadFile)) {
            // Dapatkan ID artikel yang baru saja dimasukkan
            $id_artikel = mysqli_insert_id($koneksi);

            // Proses gambar tambahan
            for ($index = 0; $index < count($_FILES['file_artikel']['name']); $index++) {
                $fileInputName = "file_artikel";

                // Periksa apakah file diinput
                if (!empty($_FILES[$fileInputName]['name'][$index])) {
                    $file_name = $_FILES[$fileInputName]['name'][$index];
                    $file_tmp = $_FILES[$fileInputName]['tmp_name'][$index];

                    // Dapatkan timestamp saat ini untuk gambar tambahan
                    $imgTimestamp = time();

                    // Gabungkan nama file dengan timestamp
                    $newImgFileName = $imgTimestamp . '_' . $file_name;

                    // Tentukan path file baru untuk disimpan
                    $uploadFile = $uploadDir . basename($newImgFileName);

                    // Simpan data ke tabel artikel_img
                    $query_img = "INSERT INTO artikel_img (id_artikel, file_artikel) VALUES (?, ?)";
                    $stmt_img = mysqli_prepare($koneksi, $query_img);
                    mysqli_stmt_bind_param($stmt_img, "is", $id_artikel, $newImgFileName);
                    $result_img = mysqli_stmt_execute($stmt_img);

                    // Pindahkan file gambar tambahan ke folder yang ditentukan
                    if ($result_img && move_uploaded_file($file_tmp, $uploadFile)) {
                        // Lakukan sesuatu jika perlu
                    } else {
                        // Handle jika gagal menyimpan file gambar tambahan
                        throw new Exception("Gagal menyimpan file gambar tambahan");
                    }
                }
            }

            echo "<script>
                    alert('Data berhasil ditambahkan!');
                    document.location='artikel.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal menyimpan file thumbnail!');
                    document.location='artikel.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location='artikel.php';
            </script>";
    }
}


// Fungsi Delete Artikel
if(isset($_POST['hapusartikel'])) {
    $id_artikel_to_delete = $_POST['id_artikel'];

    // Hapus file thumbnail dari direktori
    $query_thumbnail = "SELECT thumb_artikel FROM artikel WHERE id_artikel = ?";
    $stmt_thumbnail = mysqli_prepare($koneksi, $query_thumbnail);
    mysqli_stmt_bind_param($stmt_thumbnail, "i", $id_artikel_to_delete);
    mysqli_stmt_execute($stmt_thumbnail);
    mysqli_stmt_bind_result($stmt_thumbnail, $thumb_artikel);

    if (mysqli_stmt_fetch($stmt_thumbnail)) {
        $thumbnailFilePath = '../../directory/imgartikel/' . $thumb_artikel;
        if (file_exists($thumbnailFilePath)) {
            unlink($thumbnailFilePath); // Hapus file thumbnail
        }
    }

    mysqli_stmt_close($stmt_thumbnail);

    // Hapus file gambar tambahan dari direktori
    $query_img = "SELECT file_artikel FROM artikel_img WHERE id_artikel = ?";
    $stmt_img = mysqli_prepare($koneksi, $query_img);
    mysqli_stmt_bind_param($stmt_img, "i", $id_artikel_to_delete);
    mysqli_stmt_execute($stmt_img);
    mysqli_stmt_bind_result($stmt_img, $file_artikel);

    while (mysqli_stmt_fetch($stmt_img)) {
        $imgFilePath = '../../directory/imgartikel/' . $file_artikel;
        if (file_exists($imgFilePath)) {
            unlink($imgFilePath); // Hapus file gambar tambahan
        }
    }

    mysqli_stmt_close($stmt_img);

    // Hapus entri-entri dari tabel artikel dan artikel_img
    $query_delete_artikel = "DELETE FROM artikel WHERE id_artikel = ?";
    $stmt_delete_artikel = mysqli_prepare($koneksi, $query_delete_artikel);
    mysqli_stmt_bind_param($stmt_delete_artikel, "i", $id_artikel_to_delete);
    $result_delete_artikel = mysqli_stmt_execute($stmt_delete_artikel);

    $query_delete_artikel_img = "DELETE FROM artikel_img WHERE id_artikel = ?";
    $stmt_delete_artikel_img = mysqli_prepare($koneksi, $query_delete_artikel_img);
    mysqli_stmt_bind_param($stmt_delete_artikel_img, "i", $id_artikel_to_delete);
    $result_delete_artikel_img = mysqli_stmt_execute($stmt_delete_artikel_img);

    if ($result_delete_artikel && $result_delete_artikel_img) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location='artikel.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                document.location='artikel.php';
            </script>";
    }

    mysqli_stmt_close($stmt_delete_artikel);
    mysqli_stmt_close($stmt_delete_artikel_img);
}

// Fungsi Edit Artikel
if(isset($_POST['editartikel'])) {
    // Ubah Data
    $query = "UPDATE artikel SET 
               judul_artikel = ?,
               deskripsi_artikel = ?,
               kategori_artikel = ?,
               konten_artikel = ? 
               WHERE id_artikel = ?";

    $stmt = mysqli_prepare($koneksi, $query);

    // Binding parameter
    mysqli_stmt_bind_param($stmt, "ssssi", $_POST['judulInput'], $_POST['deskripsi'], $_POST['kategori'], $_POST['TextEditor'], $_POST['id_artikel']);

    // Eksekusi kueri
    $editartikel = mysqli_stmt_execute($stmt);

    // Jika berhasil ubah
    if ($editartikel) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location='artikel.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location='artikel.php';
            </script>";
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Fungsi Simpan Course
if(isset($_POST['simpancourse'])) {
    // Folder tempat menyimpan file gambar course
    $uploadDir = '../../directory/imgcourse/';

    // Ambil nama file thumbnail
    $thumbnailFileName = $_FILES['gambarInput']['name'];

    // Dapatkan timestamp saat ini untuk thumbnail
    $thumbnailTimestamp = time();

    // Gabungkan nama file thumbnail dengan timestamp
    $newThumbnailFileName = $thumbnailTimestamp . '_' . $thumbnailFileName;

    // Tentukan path file thumbnail baru untuk disimpan
    $thumbnailUploadFile = $uploadDir . basename($newThumbnailFileName);

    // Simpan data baru ke tabel course
    $query_course = "INSERT INTO course (judul_course, kode_course, deskripsi_course, pengantar_course, semester_course, link_course, sks_course, thumb_course) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_course = mysqli_prepare($koneksi, $query_course);
    mysqli_stmt_bind_param($stmt_course, "ssssssss", $_POST['matakuliah'], $_POST['kode'], $_POST['deskripsi'], $_POST['pengantar'], $_POST['semester'], $_POST['linkutama'], $_POST['sks'], $newThumbnailFileName);
    $tambahcourse = mysqli_stmt_execute($stmt_course);

    if ($tambahcourse) {
        // Pindahkan file thumbnail ke folder yang ditentukan
        if (move_uploaded_file($_FILES['gambarInput']['tmp_name'], $thumbnailUploadFile)) {
            // Dapatkan ID course yang baru saja dimasukkan
            $id_course = mysqli_insert_id($koneksi);

            // Proses file tambahan
            for ($index = 0; $index < count($_POST['file_course']); $index++) {
                // Periksa apakah file diinput
                if (!empty($_POST['file_course'][$index])) {
                    // Mengambil nilai dari inputan form
                    $file_kategori = $_POST['kategorimedia'][$index];
                    $file_course = $_POST['file_course'][$index];
                    $file_namacourse = $_POST['file_namacourse'][$index];

                    // Simpan data ke tabel course_file
                    $query_file = "INSERT INTO course_file (id_course, file_kategori, file_course, file_namacourse) VALUES (?, ?, ?, ?)";
                    $stmt_file = mysqli_prepare($koneksi, $query_file);
                    mysqli_stmt_bind_param($stmt_file, "isss", $id_course, $file_kategori, $file_course, $file_namacourse);
                    $result_file = mysqli_stmt_execute($stmt_file);

                    // Lakukan sesuatu jika perlu
                    if (!$result_file) {
                        // Handle jika gagal menyimpan data file
                        throw new Exception("Gagal menyimpan data file tambahan");
                    }
                }
            }

            echo "<script>
                    alert('Data berhasil ditambahkan!');
                    document.location='course.php';
                </script>";
        } else {
            echo "<script>
                    alert('Gagal menyimpan file thumbnail!');
                    document.location='course.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location='course.php';
            </script>";
    }
}

// Fungsi Hapus Course
if(isset($_POST['hapuscourse'])) {
    // Ambil ID course yang akan dihapus
    $id_course = $_POST['id_course'];

    // Hapus data dari tabel course
    $query_get_thumb_filename = "SELECT thumb_course FROM course WHERE id_course = ?";
    $stmt_get_thumb_filename = mysqli_prepare($koneksi, $query_get_thumb_filename);
    mysqli_stmt_bind_param($stmt_get_thumb_filename, "i", $id_course);
    mysqli_stmt_execute($stmt_get_thumb_filename);
    mysqli_stmt_bind_result($stmt_get_thumb_filename, $thumb_filename);

    if (mysqli_stmt_fetch($stmt_get_thumb_filename)) {
        $thumb_file_path = '../../directory/imgcourse/' . $thumb_filename;

        // Hapus file thumbnail dari folder imgcourse
        if (unlink($thumb_file_path)) {
            // Tutup statement sebelumnya
            mysqli_stmt_close($stmt_get_thumb_filename);

            // Hapus seluruh data file tambahan yang terkait dengan course yang dihapus
            $query_delete_files = "DELETE FROM course_file WHERE id_course = ?";
            $stmt_delete_files = mysqli_prepare($koneksi, $query_delete_files);
            mysqli_stmt_bind_param($stmt_delete_files, "i", $id_course);
            $delete_files_result = mysqli_stmt_execute($stmt_delete_files);

            if ($delete_files_result) {
                // Tutup statement sebelumnya
                mysqli_stmt_close($stmt_delete_files);

                // Hapus data dari tabel course setelah menghapus file
                $query_delete_course = "DELETE FROM course WHERE id_course = ?";
                $stmt_delete_course = mysqli_prepare($koneksi, $query_delete_course);
                mysqli_stmt_bind_param($stmt_delete_course, "i", $id_course);
                $delete_course_result = mysqli_stmt_execute($stmt_delete_course);

                if ($delete_course_result) {
                    echo "<script>
                            alert('Data berhasil dihapus!');
                            document.location='course.php';
                        </script>";
                } else {
                    echo "<script>
                            alert('Gagal menghapus data course!');
                            document.location='course.php';
                        </script>";
                }
            } else {
                echo "<script>
                        alert('Gagal menghapus data file tambahan!');
                        document.location='course.php';
                    </script>";
            }
        } else {
            echo "<script>
                    alert('Gagal menghapus file thumbnail!');
                    document.location='course.php';
                </script>";
        }
    }
}



// Fungsi Edit Course
if(isset($_POST['editcourse'])) {
    // Ubah Data
    $query = "UPDATE course SET 
               judul_course = ?,
               kode_course = ?,
               deskripsi_course = ?,
               pengantar_course = ?,
               semester_course = ?,
               link_course = ?,
               sks_course = ?
               WHERE id_course = ?";

    $stmt = mysqli_prepare($koneksi, $query);

    // Binding parameter
    mysqli_stmt_bind_param($stmt, "sssssssi", $_POST['matakuliah'], $_POST['kode'], $_POST['deskripsi'], $_POST['pengantar'], $_POST['semester'], $_POST['linkutama'], $_POST['sks'], $_POST['id_course']);

    // Eksekusi kueri
    $editcourse = mysqli_stmt_execute($stmt);

    // Jika berhasil ubah
    if ($editcourse) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location='course.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location='course.php';
            </script>";
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Fungsi Simpan Content
if(isset($_POST['simpancontent'])) {
    // Folder tempat menyimpan file gambar
    $uploadDir = '../../directory/imggallery/';

    // Menghitung jumlah file yang diunggah
    $totalFiles = count($_FILES['file_artikel']['name']);

    // Loop untuk setiap file yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        // Ambil nama file
        $fileName = $_FILES['file_artikel']['name'][$i];

        // Dapatkan timestamp saat ini
        $timestamp = time();

        // Gabungkan nama file dengan timestamp
        $newFileName = $timestamp . '_' . $fileName;

        // Tentukan path file baru untuk disimpan
        $uploadFile = $uploadDir . basename($newFileName);

        // Simpan data baru ke database
        $tambahdosen = mysqli_prepare($koneksi, "INSERT INTO gallery (judul_gallery, file_gallery) VALUES (?, ?)");
        mysqli_stmt_bind_param($tambahdosen, "ss", $_POST['judulcontent'][$i], $newFileName);

        // Eksekusi kueri
        $tambahdosen_result = mysqli_stmt_execute($tambahdosen);

        // Jika berhasil insert, pindahkan file ke folder yang ditentukan
        if ($tambahdosen_result) {
            if (move_uploaded_file($_FILES['file_artikel']['tmp_name'][$i], $uploadFile)) {
                echo "<script>
                        alert('Data berhasil ditambahkan!');
                        document.location='gallery.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Gagal menyimpan file gambar!');
                        document.location='gallery.php';
                    </script>";
            }
        } else {
            // Tampilkan pesan error SQL jika terjadi kesalahan
            echo "<script>
                    alert('Gagal menyimpan data ke database! " . mysqli_error($koneksi) . "');
                    document.location='gallery.php';
                </script>";
        }

        // Tutup statement
        mysqli_stmt_close($tambahdosen);
    }
}

?>