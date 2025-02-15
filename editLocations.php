<?php
// Include database connection file
include_once("config.php");

// Periksa apakah form dikirim untuk update data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $locations_id = intval($_POST['locations_id']); // Pastikan ID adalah angka
    $locations_name = mysqli_real_escape_string($link, $_POST['locations_name']);
    $locations_status = mysqli_real_escape_string($link, $_POST['locations_status']);
    $locations_type = mysqli_real_escape_string($link, $_POST['locations_type']);

    // Update data ke database
    $query = "UPDATE locations SET 
              locations_type='$locations_type', 
              locations_name='$locations_name', 
              locations_status='$locations_status' 
              WHERE locations_id=$locations_id";

    if (mysqli_query($link, $query)) {
        // Redirect ke index setelah update berhasil
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
}

// Periksa apakah `id` tersedia di URL sebelum mengambil data
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID adalah angka
    $result = mysqli_query($link, "SELECT * FROM locations WHERE locations_id=$id");

    if ($result && mysqli_num_rows($result) > 0) {
        $locations = mysqli_fetch_assoc($result);
        $locations_name = $locations['locations_name'];
        $locations_status = $locations['locations_status'];
        $locations_type = $locations['locations_type'];
    } else {
        die("Data tidak ditemukan!");
    }
} else {
    die("ID tidak ditemukan!");
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Location</title>
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
    <h2 class="text-center">Edit Location</h2>
    <form name="updatelocations" method="post" action="editlocations.php">
        <table border="0">
            <tr>
                <td>Location Name:</td>
                <td><input type="text" name="locations_name" required value="<?php echo htmlspecialchars($locations_name); ?>" class="form-control"></td>
            </tr>
            <tr>
                <td>Location Status:</td>
                <label for="locations_status"></label>
                <td><select name="locations_status" id="locations_status" required class="form-control">
                        <option value="" disabled selected>Select Status</option>
                        <option value="The Demon World" <?php if ($locations_status == "The Demon World") echo "selected"; ?>>The Demon World</option>
                        <option value="The Human World" <?php if ($locations_status == "The Human World") echo "selected"; ?>>The Human World</option>
                        <option value="Other" <?php if ($locations_status == "Other") echo "selected"; ?>>Other</option>
                    </select>
            </tr>
            <tr>
                <td>Location Type:</td>
                <label for="locations_type"></label>
                <td><select name="locations_type" id="locations_type" required class="form-control">
                        <option value="" disabled selected>Select Type</option>
                        <option value="Plantation" <?php if ($locations_type == "Plantation") echo "selected"; ?>>Plantation</option>
                        <option value="Stonehenge" <?php if ($locations_type == "Stonehenge") echo "selected"; ?>>Stonehenge</option>
                        <option value="Hideout" <?php if ($locations_type == "Hideout") echo "selected"; ?>>Hideout</option>
                        <option value="Other" <?php if ($locations_type == "Other") echo "selected"; ?>>Other</option>
                        <option value="-" <?php if ($locations_type == "-") echo "selected"; ?>>-</option>
                    </select>
            </tr>
            <tr>
                <td><input type="hidden" name="locations_id" value="<?php echo $id; ?>"></td>
                <td><input type="submit" name="update" value="Update" class="btn btn-primary"></td>
            </tr>
        </table>
    </form>
</body>

</html>