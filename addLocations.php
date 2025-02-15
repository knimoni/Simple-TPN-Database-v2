<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
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
    <div id="button-container" class=" d-flex ml-2 mt-2">
        <a href="#" id="home-button" class="btn-custom" onclick="history.back(); return false;">🔙 Home</a>
    </div>

    <br>
    <h2 class="text-center mb-4">Add location</h2>
    <form action="addLocations.php" method="post" name="form1">
        <table>
            <tr>
                <td>location ID: </td>
                <td><input type="number" name="locations_id" required min="1" class="form-control"></td>
            </tr>
            <tr>
                <td>location Name: </td>
                <td><input type="text" name="locations_name" required class="form-control"></td>
            </tr>
            <tr>
                <td>location Status: </td>
                <label for="locations_status"></label>
                <td><select name="locations_status" required class="form-control">
                        <option value="">Select Location Status</option>
                        <option value="The Demon World">The Demon World</option>
                        <option value="The Human World">The Human World</option>
                        <option value="Other">Other</option>
                    </select>
            </tr>
            <tr>
                <td>location Type: </td>
                <label for="locations_type"></label>
                <td><select name="locations_type" required class="form-control">
                        <option value="">Select Location Type</option>
                        <option value="Plantation">Plantation</option>
                        <option value="Stonehenge">Stonehenge</option>
                        <option value="Hideout">Hideout</option>
                        <option value="Other">Other</option>
                        <option value="-">-</option>
                    </select>
            </tr>
            <tr>
                <td>Location Observer ID: </td>
                <td><input type="number" name="observer_id" required min="1" class="form-control"></td>
            </tr>
            <tr>
                <td>Location Children ID: </td>
                <td><input type="number" name="child_id" required min="1" class="form-control"></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>

    <?php
    // Check If form submitted, insert form data into users table. 
    if (isset($_POST['submit'])) {
        $locations_id = $_POST['locations_id'];
        $locations_name = $_POST['locations_name'];
        $locations_status = $_POST['locations_status'];
        $locations_type = $_POST['locations_type'];
        $observer_id = $_POST['observer_id'];
        $child_id = $_POST['child_id'];

        // include database connection file 
        include_once("config.php");

        // Insert user data into table
        $query = "INSERT INTO locations (locations_id, locations_name, locations_status, locations_type, observer_id, child_id) VALUES('$locations_id','$locations_name','$locations_status','$locations_type','$observer_id', '$child_id')";

        if (mysqli_query($link, $query)) {
            echo "<script>
            document.getElementById('button-container').innerHTML = 
            \"<a href='index.php' class='btn-custom'>🔙 Home</a><br>Successfully added Location.\";
          </script>";
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    ?>
</body>

</html>