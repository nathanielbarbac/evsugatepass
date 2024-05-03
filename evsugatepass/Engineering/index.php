<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVSU GATEPASS v1.0</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            position: relative;
            cursor: pointer;
        }

        th::after {
            content: "";
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            border-width: 4px 4px 0;
            border-style: solid;
            border-color: white transparent transparent;
            opacity: 0;
            transition: opacity 0.3s;
        }

        th.sorted-asc::after {
            opacity: 1;
            transform: translateY(-50%) rotate(180deg);
        }

        th.sorted-desc::after {
            opacity: 1;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }


        .approve {
            background-color: #28a745;
            color: white;
        }

        .reject {
            background-color: #dc3545;
            color: white;
        }

        /* button:hover {
            background-color: #555;
            color: white;
        } */

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #007bff;
            margin: 0 5px;
            color: #007bff;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
        }

        /* new button styles */
        /* Styles for In and Out buttons */
        button {
            padding: 12px 24px; /* Adjust padding to make buttons bigger */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px; /* Increase font size */
        }

        .in-button {
            background-color: #28a745;
            color: white;
        }

        .out-button {
            background-color: #dc3545;
            color: white;
        }
        
    </style>
</head>
<body>
    <h1>Gatepass Dashboard [Engineering]</h1>
    <center><img src="../img/evsu logo.png" alt="Logo" width="50" height="50"></center>
    <?php
    // Database connection
    include "../db_connection.php";

    // Pagination
    $results_per_page = 8;
    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }
    $offset = ($page - 1) * $results_per_page;

    // Retrieve requests from the database with pagination
    $sql = "SELECT * FROM gatepass_data ORDER BY date_time DESC LIMIT $offset, $results_per_page";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display requests in a table
        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Destination</th>
                    <th>Purpose</th>
                    <th>Duration</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Number</th>
                    <th>HR Status</th>
                    <th>Department Head Status</th>
                    <th>Action</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            if ($row['department'] == 'Engineering') {
            echo "<tr>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['date_time'] . "</td>
                    <td>" . $row['destination'] . "</td>
                    <td>" . $row['purpose'] . "</td>
                    <td>" . $row['duration_hours'] . " hours " . $row['duration_minutes'] . " minutes</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['department'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['status'] . "</td>
                    <td>" . $row['dh_status'] . "</td>
                    <td>
                        <button class='approve'><a href='approve_request_department_head.php?id=" . $row['id'] . "'>Approve</a></button>
                        <button class='reject'><a href='reject_request_department_head.php?id=" . $row['id'] . "'>Reject</a></button>
                    </td>
                </tr>";
        }
    }
        echo "</table>";

        // Pagination controls
        $sql = "SELECT COUNT(id) AS total FROM gatepass_data";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $results_per_page);

        echo "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<a href='department_head_dashboard.php?page=$i' class='active'>$i</a>";
            } else {
                echo "<a href='department_head_dashboard.php?page=$i'>$i</a>";
            }
        }
        echo "</div>";
    } else {
        echo "No requests found.";
    }

    // Close connection
    $conn->close();
    ?>

</body>
</html>
