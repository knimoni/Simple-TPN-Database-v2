<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add children</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        table {
            table-layout: fixed;
            max-width: 100%;
            border-collapse: collapse;
            margin: .25rem auto .5rem auto;
        }

        td {
            padding: 1rem;
        }

        tr td:nth-child(1) {
            font-weight: bold;
        }
    </style>
    <style>
        .btn-custom {
            display: inline-block;
            width: 100px;
            text-align: center;
            padding: 8px 14px;
            font-size: 14px;
            font-weight: bold;
            color: #f8f9fa;
            /* Warna teks lebih lembut */
            background: linear-gradient(135deg, #2C3E50, #4A6274);
            /* Navy ke abu-abu */
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #4A6274, #2C3E50);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .btn-custom:active {
            transform: scale(0.95);
        }
    </style>

</head>

<body>
    <div id="button-container" class=" d-flex ml-2 mt-2">
        <a href="#" id="home-button" class="btn-custom" onclick="history.back(); return false;">🔙 Home</a>
    </div>

    <br>
    <h2 class="text-center mb-4">Add Children</h2>
    <form action="addChild.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Children ID: </td>
                <td><input type="number" name="child_id" id="child_id" required min="1" class="form-control"></td>
            </tr>
            <tr>
                <td>Name: </td>
                <td><input type="text" name="child_name" id="child_name" required class="form-control"></td>
            </tr>
            <tr>
                <td>Image: </td>
                <td><input type="file" name="images" class="form-control"></td>
            </tr>
            <tr>
                <td>Identifier: </td>
                <td><input type="text" name="child_identifier" class="form-control"></td>
            </tr>
            <tr>
                <td>Gender: </td>
                <label for="child_gender"></label>
                <td><select name="child_gender" required class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
            </tr>
            <tr>
                <td>Height: </td>
                <td><input type="number" name="child_height" min="50" max="999" class="form-control"></td>
            </tr>
            <tr>
                <td>Birthday: </td>
                <td><input type="date" name="child_birthday" class="form-control" placeholder="Optional"></td>
            </tr>
            <tr>
                <td>Blood Type: </td>
                <label for="child_bloodtype"></label>
                <td><select name="child_bloodtype" required class="form-control">
                        <option value="">Select Blood Type</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                        <option value="-">-</option>
                    </select>
            </tr>
            <tr>;
                <td></td>
                <td>
                    <input type="submit" name="submit" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['submit'])) {
            // Ambil data dari form
            $child_id = $_POST['child_id'];
            $child_name = $_POST['child_name'];
            $child_identifier = $_POST['child_identifier'];
            $child_gender = $_POST['child_gender'];
            $child_height = $_POST['child_height'];
            $child_birthday = $_POST['child_birthday'];
            $child_bloodtype = $_POST['child_bloodtype'];

            $images = null; // Default jika tidak ada gambar

            // Periksa apakah ada file yang diunggah
            if (isset($_FILES['images']) && $_FILES['images']['error'] == UPLOAD_ERR_OK) {
                $fileName = $_FILES["images"]["name"];
                $fileSize = $_FILES["images"]["size"];
                $tempName = $_FILES["images"]["tmp_name"];

                // Validasi ekstensi file
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $imgExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($imgExt, $allowedExtensions)) {
                    echo "<script>alert('Please upload a valid image file (jpg, jpeg, or png).');</script>";
                    exit();
                }

                // Validasi ukuran file
                if ($fileSize > 1000000) {
                    echo "<script>alert('File size is too big!');</script>";
                    exit();
                }

                // Generate nama unik untuk file
                $newFileName = uniqid() . "." . $imgExt;

                // Pastikan folder 'Assets' ada
                if (!is_dir('Assets')) {
                    mkdir('Assets', 0777, true);
                }

                // Pindahkan file ke folder 'Assets'
                if (move_uploaded_file($tempName, 'Assets/' . $newFileName)) {
                    $images = $newFileName;
                }
            }

            // Koneksi ke database
            include_once("config.php");

            // Perbaiki query untuk menyertakan semua kolom
            $query = "INSERT INTO child (child_id, child_name, images, child_identifier, child_gender, child_height, child_birthday, child_bloodtype) 
                  VALUES ('$child_id', '$child_name', '$images', '$child_identifier', '$child_gender', '$child_height', '$child_birthday', '$child_bloodtype')";

            if (mysqli_query($link, $query)) {
                echo "<script>
            document.getElementById('button-container').innerHTML = 
            \"<a href='index.php' class='btn-custom'>🔙 Home</a><br>Successfully added Children.\";
          </script>";
            } else {
                echo "Error: " . mysqli_error($link);
            }
        }
    }
    ?>


</body>

</html>