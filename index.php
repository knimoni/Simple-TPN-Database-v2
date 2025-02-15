<?php
// Create database connection using config file
include_once("config.php");

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Fetch data
$locations = mysqli_query($link, "SELECT * FROM locations WHERE is_delete=0 ORDER BY locations_id ASC");
$observer = mysqli_query($link, "SELECT * FROM  observer  WHERE is_delete=0 ORDER BY observer_id ASC");
$child = mysqli_query($link, "SELECT * FROM  child  WHERE is_delete=0 ORDER BY child_id ASC");
$locationsJoin = mysqli_query($link, "SELECT A.locations_id, A.locations_name, A.locations_status, B.observer_name, C.child_name from locations A INNER JOIN observer B ON A.observer_id = B.observer_id INNER JOIN child C ON A.child_id = C.child_id WHERE A.is_delete=0");
?>

<!DOCobserver html>
    <html lang="en">

    <head>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Cek apakah terdapat parameter pencarian di URL
                if (window.location.search.includes("searchChild") || window.location.search.includes("searchObserver") || window.location.search.includes("searchLocations")) {
                    // Simpan posisi scroll di localStorage sebelum halaman dimuat ulang
                    if (sessionStorage.getItem("scrollPosition")) {
                        window.scrollTo(0, sessionStorage.getItem("scrollPosition"));
                    }
                }

                // Simpan posisi scroll sebelum halaman reload
                window.addEventListener("beforeunload", function() {
                    sessionStorage.setItem("scrollPosition", window.scrollY);
                });
            });
        </script>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Promised Neverland Database</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                font: 14px sans-serif;
            }

            table {
                margin: 1rem auto 1.25rem auto;
            }

            th {
                padding: 1rem;
                white-space: nowrap;
            }

            td {
                padding: 1.5rem 1rem;
                white-space: nowrap;
            }

            h3 {
                text-align: center;
            }

            div {
                width: fit-content;
            }

            a {
                color: purple;
                padding: 7px;
                border: .5px solid purple;
            }

            .btn-danger {
                display: inline-block;
                padding: 6px 12px;
                font-size: 12px;
                font-weight: bold;
                color: #fff;
                background: linear-gradient(135deg, #d9534f, #c9302c);
                border: none;
                border-radius: 8px;
                text-decoration: none;
                transition: all 0.3s ease-in-out;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            }

            .btn-danger:hover {
                background: linear-gradient(135deg, #c9302c, #d9534f);
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            }

            .btn-danger:active {
                transform: scale(0.95);
            }

            .btn-custom {
                padding: 12px 24px;
                font-size: 16px;
                font-weight: bold;
                border-radius: 8px;
                text-decoration: none;
                display: inline-block;
                transition: all 0.3s ease-in-out;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
                border: none;
                color: white;
                cursor: pointer;
            }

            .btn-purple {
                background: linear-gradient(135deg, #8A2BE2, #6A1B9A);
                padding: 10px 17px;
                font-size: 13px;
            }

            .btn-purple:hover {
                background: linear-gradient(135deg, #6A1B9A, #8A2BE2);
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            }

            .btn-blue {
                background: linear-gradient(135deg, #007bff, #0056b3);
                padding: 10px 14px;
                font-size: 13px;
            }

            .btn-blue:hover {
                background: linear-gradient(135deg, #0056b3, #007bff);
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            }

            .btn-gray {
                background: linear-gradient(135deg, #6c757d, #495057);
                padding: 10px 14px;
                font-size: 13px;
            }

            .btn-gray:hover {
                background: linear-gradient(135deg, #495057, #6c757d);
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            }

            .table-container {
                overflow-x: auto;
                border-radius: 10px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }

            .styled-table {
                border-radius: 7px;
                overflow: hidden;
            }

            .styled-table thead {
                background: #007BFF;
                color: white;
                text-align: left;
            }

            .styled-table th,
            .styled-table td {
                padding: 12px 15px;
                text-align: center;
            }

            .styled-table tbody tr {
                border-bottom: 0.7px solid #ddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f8f9fa;
            }

            .styled-table tbody tr:hover {
                background-color: #d6e9ff;
                transition: all 0.3s ease-in-out;
            }

            .styled-table td:last-child {
                white-space: nowrap;
            }
        </style>
        <script defer>
            function warning() {
                alert("Are you sure you want to delete this data?")
            }
        </script>
    </head>

    <body>

        <div class="logout-btn ml-3 mt-3">
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <c class="">Hallo, <b><?php echo htmlspecialchars($_SESSION["username"]); ?>! 👋</b></c>
        </div>

        <h1 class="mb-3 mt-4 text-center">The Promised Neverland Database</h1>
        <h5 class="mb-5 mt-3 text-center">Data information obtained from <a href="https://yakusokunoneverland.fandom.com/wiki/The_Promised_Neverland_Wiki" target="_blank">The Promised Neverland Wiki Fandom</a></h5>

        <!-- child -->
        <div class="d-flex align-items-center mx-auto ">
            <h2>List of Children</h2>
            <form action="index.php" method="get" class="ml-5 row">
                <!-- <label>Search :</label> -->
                <input style="padding-right:1rem" type="text" name="searchChild" class="form-control form-control-sm col mr-3 mt-1">
                <input style="background-color:slateblue; border-color:darkgray; margin-right:1rem" type="submit" value="Search" class="btn-custom btn-purple">
            </form>
        </div>
        <div class="d-flex align-items-center mx-auto ">
            <?php
            if (isset($_GET['searchChild'])) {
                $searchChild = $_GET['searchChild'];
                echo "<b>Search result: " . $searchChild . "</b>";
            }
            ?>
        </div>
        <div class="mx-auto mb-5 px-5">
            <table border="" style="min-width: 777px;" class="styled-table">
                <tr>
                    <th style='text-align:center;'>
                        Children ID
                    </th>
                    <th style='text-align:center;'>
                        Children Name
                    </th>
                    <th style='text-align:center;'>
                        Image
                    </th>
                    <th style='text-align:center;'>
                        Children Identifier
                    </th>
                    <th style='text-align:center;'>
                        Gender
                    </th>
                    <th style='text-align:center;'>
                        Height
                    </th>
                    <th style='text-align:center;'>
                        Birthday
                    </th>
                    <th style='text-align:center;'>
                        Blood Type
                    </th>
                    <th style='text-align:center;'>Action</th>
                </tr>
                <?php
                if (isset($_GET['searchChild'])) {
                    $searchChild = $_GET['searchChild'];
                    $child = mysqli_query($link, "SELECT * FROM child WHERE is_delete=0 AND child_name like '%" . $searchChild . "%'");
                } else {
                    $child = mysqli_query($link, "SELECT * FROM child WHERE is_delete=0 ORDER BY child_id ASC");
                }
                while ($item = mysqli_fetch_array($child)) {
                    echo "<tr>";
                    echo "<td style='text-align:center;'>" . $item['child_id'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['child_name'] . "</td>";
                    echo "<td style='text-align:center;'> <img src='Assets/" . $item['images'] . "' height='230' width='230' </td>";
                    echo "<td style='text-align:center;'>" . $item['child_identifier'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['child_gender'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['child_height'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['child_birthday'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['child_bloodtype'] . "</td>";
                    echo "<td> <a style='color:CornflowerBlue; border-color:CornflowerBlue;' href='editChild.php?id=$item[child_id]'>Edit</a> | <a href='deleteChild.php?id=$item[child_id]' onclick='warning()'>Delete</a></td></tr>";
                }
                ?>
            </table>
            <div class="add-btn ml-auto">
                <a style="background-color:blue; border-color:black;" href="addChild.php" class="btn-custom btn-blue">Add Children</a>
                <a style="background-color:gray; border-color:black" href="binChild.php" class="btn-custom btn-gray">Restore Children</a>
            </div>
        </div>

        <!-- observer -->
        <div class="d-flex align-items-center mx-auto ">
            <h3>List of Observers</h3>
            <form action="index.php" method="get" class="ml-5 row">
                <!-- <label>Search :</label> -->
                <input style="padding-right:1rem" type="text" name="searchObserver" class="form-control form-control-sm col mr-3 mt-1">
                <input style="background-color:slateblue; border-color:darkgray; margin-right:1rem" type="submit" value="Search" class="btn-custom btn-purple">
            </form>
        </div>
        <div class="d-flex align-items-center mx-auto ">
            <?php
            if (isset($_GET['searchObserver'])) {
                $searchObserver = $_GET['searchObserver'];
                echo "<b>Search result: " . $searchObserver . "</b>";
            }
            ?>
        </div>
        <div class="mx-auto mb-5 px-5">
            <table border="" style="min-width: 777px;" class="styled-table">
                <tr>
                    <th style='text-align:center;'>
                        Observer ID
                    </th style='text-align:center;'>
                    <th style='text-align:center;'>
                        Observer Name
                    </th style='text-align:center;'>
                    <th style='text-align:center;'>
                        Observer Species
                    </th style='text-align:center;'>
                    <th style='text-align:center;'>
                        Observer Gender
                    </th>
                    <th style='text-align:center;'>Action</th>
                </tr>
                <?php
                if (isset($_GET['searchObserver'])) {
                    $searchObserver = $_GET['searchObserver'];
                    $observer = mysqli_query($link, "SELECT * FROM observer WHERE is_delete=0 AND observer_name like '%" . $searchObserver . "%'");
                } else {
                    $observer = mysqli_query($link, "SELECT * FROM observer WHERE is_delete=0 ORDER BY observer_id ASC");
                }
                while ($item = mysqli_fetch_array($observer)) {
                    echo "<tr>";
                    echo "<td style='text-align:center;'>" . $item['observer_id'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['observer_name'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['observer_species'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['observer_gender'] . "</td>";
                    echo "<td><a style='color:CornflowerBlue; border-color:CornflowerBlue;' href='editObserver.php?id=$item[observer_id]'>Edit</a> | <a href='deleteObserver.php?id=$item[observer_id]' onclick='warning()'>Delete</a></td></tr>";
                }
                ?>
            </table>
            <div class="add-btn ml-auto">
                <a style="background-color:blue; border-color:black" href="addObserver.php" class="btn-custom btn-blue">Add Observer</a>
                <a style="background-color:gray; border-color:black" href="binObserver.php" class="btn-custom btn-gray">Restore Observer</a>
            </div>
        </div>

        <!-- locations -->
        <div class="d-flex align-items-center mx-auto">
            <h2>List of Locations</h2>
            <form action="index.php" method="get" class="ml-5 row">
                <!-- <label>Search :</label> -->
                <input style="padding-right:1rem" type="text" name="searchLocations" class="form-control form-control-sm col mr-3 mt-1">
                <input style="background-color:slateblue; border-color:darkgray; margin-right:1rem" type="submit" value="Search" class="btn-custom btn-purple">
            </form>
        </div>
        <div class="d-flex align-items-center mx-auto ">
            <?php
            if (isset($_GET['searchLocations'])) {
                $searchLocations = $_GET['searchLocations'];
                echo "<b>Search result: " . $searchLocations . "</b>";
            }
            ?>
        </div>
        <div class="mx-auto mb-5 px-5">
            <table border="" style="min-width: 777px;" class="styled-table">
            <tr>
                    <th style='text-align:center;'>Location ID</th>
                    <th style='text-align:center;'>Location Name</th>
                    <th style='text-align:center;'>Location Status</th>
                    <th style='text-align:center;'>Location Type</th>
                    <th style='text-align:center;'>Action</th>
                </tr>
                <?php
                if (isset($_GET['searchLocations'])) {
                    $searchLocations = $_GET['searchLocations'];
                    $locations = mysqli_query($link, "SELECT * FROM locations WHERE is_delete=0 AND locations_name like '%" . $searchLocations . "%'");
                } else {
                    $locations = mysqli_query($link, "SELECT * FROM locations WHERE is_delete=0 ORDER BY locations_id ASC");
                }
                while ($item = mysqli_fetch_array($locations)) {
                    echo "<tr>";
                    echo "<td style='text-align:center;'>" . $item['locations_id'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['locations_name'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['locations_status'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['locations_type'] . "</td>";
                    echo "<td><a style='color:CornflowerBlue; border-color:CornflowerBlue;' href='editLocations.php?id=$item[locations_id]'>Edit</a> | <a href='deleteLocations.php?id=$item[locations_id]' onclick='warning()'>Delete</a></td></tr>";
                }
                ?>
            </table>
            <div class="add-btn ml-auto">
                <a style="background-color:blue; border-color:black" href="addLocations.php" class="btn-custom btn-blue">Add Location</a>
                <a style="background-color:gray; border-color:black" href="binLocations.php" class="btn-custom btn-gray">Restore Location</a>
            </div>
        </div>

        <h3 style="color:navy;"> Table Join</h3>
        <div class="mx-auto mb-5 px-5">
            <table border="" style="min-width: 600px;" class="styled-table">
                <tr>
                    <th style='text-align:center;'>Location Name</th>
                    <th style='text-align:center;'>Location Status</th>
                    <th style='text-align:center;'>Observer</th>
                    <th style='text-align:center;'>Children</th>
                    <th style='text-align:center;'>Action</th>
                </tr>
                <?php
                while ($item = mysqli_fetch_array($locationsJoin)) {
                    echo "<tr>";
                    echo "<td style='text-align:center;'>" . $item['locations_name'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['locations_status'] . "</td>";
                    echo "<td style='text-align:center;'>" . $item['observer_name'] . "</td>";
                    echo "<td style='text-align:center;'d>" . $item['child_name'] . "</td>";
                    echo "<td><a href='deleteJoin.php?id=$item[locations_id]' onclick='warning()'>Delete</a></td></tr>";
                }
                ?>
            </table>
        </div>

    </body>

    </html>