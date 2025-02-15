<?php
// include database connection file
include_once("config.php");

// Fetch data
$childDel = mysqli_query($link, "SELECT * FROM child WHERE is_delete=1 ORDER BY child_id DESC");
?>

<html>

<head>
    <title>Deleted Children List</title>
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

    <h3>Deleted Children List</h3>
    <table width='80%' border=1>
        <tr>
            <th>
                Children ID
            </th>
            <th>
                Children Name
            </th>
            <th>
                Image
            </th>
            <th>
                Children Identifier
            </th>
            <th>
                Gender
            </th>
            <th>
                Height
            </th>
            <th>
                Birthday
            </th>
            <th>
                Blood Type
            </th>
            <th>Action</th>
        </tr>
        <?php
        while ($item = mysqli_fetch_array($childDel)) {
            echo "<tr>";
            echo "<td>" . $item['child_id'] . "</td>";
            echo "<td>" . $item['child_name'] . "</td>";
            echo "<td style='text-align:center;'> <img src='Assets/" . $item['images'] . "' height='230' width='230' </td>";
            echo "<td>" . $item['child_identifier'] . "</td>";
            echo "<td>" . $item['child_gender'] . "</td>";
            echo "<td>" . $item['child_height'] . "</td>";
            echo "<td>" . $item['child_birthday'] . "</td>";
            echo "<td>" . $item['child_bloodtype'] . "</td>";
            echo "<td><a href='restoreChild.php?id=$item[child_id]'>Restore</a></td></tr>";
        }
        ?>
    </table>
</body>

</html>