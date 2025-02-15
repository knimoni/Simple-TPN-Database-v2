<?php
// include database connection file
include_once("config.php");

// Fetch data
$locationsDel = mysqli_query($link, "SELECT * FROM locations WHERE is_delete=1 ORDER BY locations_id DESC");
?>

<html>

<head>
    <title>Deleted Locations List</title>
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
            text-align: center;
        }

        td {
            padding: 1.5rem 1rem;
            text-align: center;
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

    <br /><br />

    <h3>Deleted Locations List</h3>
    <table width='80%' border=1>
        <tr>
            <th>location ID</th>
            <th>location Name</th>
            <th>
                location Status
            </th>
            <th>
                location Type
            </th>
            <th>
                Action
            </th>
        </tr>
        <?php
        while ($item = mysqli_fetch_array($locationsDel)) {
            echo "<tr>";
            echo "<td>" . $item['locations_id'] . "</td>";
            echo "<td>" . $item['locations_name'] . "</td>";
            echo "<td>" . $item['locations_status'] . "</td>";
            echo "<td>" . $item['locations_type'] . "</td>";
            echo "<td><a href='restoreLocations.php?id=$item[locations_id]'>Restore</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>