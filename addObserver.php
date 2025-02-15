<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Observer</title>
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
    <h2 class="text-center mb-4">Add Observer</h2>
    <form action="addObserver.php" method="post" name="form1">
        <table>
            <tr>
                <td>Observer ID: </td>
                <td><input type="number" name="observer_id" required min="1" class="form-control"></td>
            </tr>
            <tr>
                <td>Observer Name: </td>
                <td><input type="text" name="observer_name" required class="form-control"></td>
            </tr>
            <tr>
                <td>Observer Species: </td>
                <td><select name="observer_species" required class="form-control">
                        <option value="">Select Species</option>
                        <option value="Human">Human</option>
                        <option value="Demon">Demon</option>
                        <option value="Other">Other</option>
                    </select>
            </tr>
            <tr>
                <td>Observer Gender: </td>
                <td><select name="observer_gender" required class="form-control">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
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
        $observer_id = $_POST['observer_id'];
        $observer_name = $_POST['observer_name'];
        $observer_species = $_POST['observer_species'];
        $observer_gender = $_POST['observer_gender'];

        // include database connection file 
        include_once("config.php");

        // Insert user data into table
        $query = "INSERT INTO observer (observer_id, observer_name, observer_species, observer_gender) VALUES('$observer_id','$observer_name','$observer_species','$observer_gender')";
        
        if (mysqli_query($link, $query)) {
            echo "<script>
            document.getElementById('button-container').innerHTML = 
            \"<a href='index.php' class='btn-custom'>🔙 Home</a><br>Successfully added Observer.\";
          </script>";        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    ?>
</body>

</html>