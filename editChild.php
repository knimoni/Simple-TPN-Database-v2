<?php
// include database connection file
include_once("config.php");

// Check if form is submitted for data update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $child_id = $_POST['child_id'];
    $child_name = $_POST['child_name'];
    $child_identifier = $_POST['child_identifier'];
    $child_gender = $_POST['child_gender'];
    $child_height = $_POST['child_height'];
    $child_birthday = $_POST['child_birthday'];
    $child_bloodtype = $_POST['child_bloodtype'];
    $images = $_POST['images'];
    // update data
    $result = mysqli_query($link, "UPDATE child SET images = '$images', child_gender='$child_gender',  child_name='$child_name', child_identifier='$child_identifier', child_height = '$child_height', child_birthday = '$child_birthday', child_bloodtype = '$child_bloodtype' WHERE child_id=$child_id");
    // Redirect to homepage to display updated data in list
    header("Location: index.php");
}
// Display selected coffee based on id
// Getting id from url
$id = $_GET['id'];
// Fetch data based on id
$result = mysqli_query($link, "SELECT * FROM child WHERE child_id=$id");
while ($child = mysqli_fetch_array($result)) {
    $child_name = $child['child_name'];
    $child_identifier = $child['child_identifier'];
    $child_gender = $child['child_gender'];
    $child_height = $child['child_height'];
    $child_birthday = $child['child_birthday'];
    $child_bloodtype = $child['child_bloodtype'];
    $images = $child['images'];
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit child</title>
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
    <a href="#" class="btn-custom ml-2 mt-2" onclick="history.back(); return false;">🔙 Home</a>
    <h2 class="text-center">Edit child</h2>
    <form name="updatechild" method="post" action="editchild.php">
        <table border="0">

            <tr>
                <td>Children Name:</td>
                <td><input type="text" name="child_name" required value="<?php echo $child_name; ?>" class="form-control"></td>
            </tr>
            <tr>
                <td>Children Identifier:</td>
                <td><input type="text" name="child_identifier" value="<?php echo isset($child_identifier) ? $child_identifier : ''; ?>" class="form-control"></td>
            </tr>
            <tr>
                <td>Image:</td>
                <td>
                    <!-- Input file untuk unggah gambar -->
                    <input type="file" name="images" class="form-control" id="imageInput" onchange="updateFileName()">

                    <!-- Menampilkan nama file lama jika tidak memilih file baru -->
                    <input type="text" id="fileNameDisplay" class="form-control" value="<?php echo $images; ?>" readonly>

                    <!-- Pratinjau gambar yang ada -->
                    <br>
                    <img src="Assets/<?php echo $images; ?>" width="170" alt="Child Image">
                </td>
            </tr>

            <script>
                function updateFileName() {
                    var input = document.getElementById('imageInput');
                    var display = document.getElementById('fileNameDisplay');

                    if (input.files.length > 0) {
                        display.value = input.files[0].name; // Menampilkan nama file yang dipilih
                    }
                }
            </script>

            <td>Children Gender:</td>
            <label for="child_gender"></label>
            <td><select name="child_gender" id="child_gender" required class="form-control">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male" <?php if ($child_gender == "Male") echo "selected"; ?>>Male</option>
                    <option value="Female" <?php if ($child_gender == "Female") echo "selected"; ?>>Female</option>
                </select>
                <tr>
                    <td>Children Height:</td>
                    <td><input type="number" name="child_height" id="child_height" min="50" max="999"
                            value="<?php echo isset($child_height) ? $child_height : ''; ?>"
                            class="form-control"></td>
                </tr>
                <tr>
                    <td>Children Birthday:</td>
                    <td><input type="date" name="child_birthday" id="child_birthday"
                            value="<?php echo isset($child_birthday) ? $child_birthday : ''; ?>"
                            class="form-control"></td>
                </tr>
                <tr>
                    <td>Children Blood Type:</td>
                    <td>
                        <select name="child_bloodtype" id="child_bloodtype" class="form-control">
                            <option value="" disabled selected>Select Blood Type</option>
                            <option value="A" <?php if ($child_bloodtype == 'A') echo 'selected'; ?>>A</option>
                            <option value="B" <?php if ($child_bloodtype == 'B') echo 'selected'; ?>>B</option>
                            <option value="AB" <?php if ($child_bloodtype == 'AB') echo 'selected'; ?>>AB</option>
                            <option value="O" <?php if ($child_bloodtype == 'O') echo 'selected'; ?>>O</option>
                            <option value="-" <?php if ($child_bloodtype == '-') echo 'selected'; ?>>-</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="hidden" name="child_id" value=<?php echo $_GET['id']; ?>></td>
                    <td><input type="submit" name="update" value="Update" class="btn btn-primary"></td>

                </tr>
        </table>
    </form>

</body>

</html>