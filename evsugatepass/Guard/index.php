<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30" >
    <title>EVSU GATEPASS V1.0</title>
    <style>
        /* Your CSS styles here */

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        h2 {
            margin-top: 30px;
            color: #333;
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
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #007bff;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #007bff;
            border-radius: 4px;
            margin: 0 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination a.active {
            background-color: #007bff;
            color: white;
        }

        /* .pagination a:hover {
            background-color: #f2f2f2;
        } */

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
    <h1>Gate Guard Dashboard</h1>
    <center><img src="../img/evsu logo.png" alt="Logo" width="50" height="50"></center>
    <center><body onload="startTime()">
        <br>
        <div id="txt"></div>

        <script>
        function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        // Function to record "In" or "Out" action
        function recordInOut(id, action) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // If the action is successful, update the corresponding button's text
                    if (action === 'In') {
                        document.getElementById('in-btn-' + id).innerText = 'Recorded';
                    } else if (action === 'Out') {
                        document.getElementById('out-btn-' + id).innerText = 'Recorded';
                    }
                }
            };
            xhttp.open("GET", "../record_in_out.php?id=" + id + "&action=" + action, true);
            xhttp.send();
        }
        </script>
    </center>

    <!-- Display approved and rejected requests along with pagination -->
    <h3>Approved and Rejected Requests</h3>
    <?php
    // Include database connection file
    include "../db_connection.php";

    // Define variables for pagination
    $results_per_page = 6; // Number of results per page
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number, default is 1
    $start_from = ($current_page - 1) * $results_per_page; // Starting point for fetching results

    // Retrieve total number of records
    $sql = "SELECT COUNT(*) AS total FROM gatepass_data WHERE status IN ('Approved', 'Rejected')";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total'];

    // Calculate total number of pages
    $total_pages = ceil($total_records / $results_per_page);

    // Retrieve approved and rejected requests for the current page, sorted by timestamp in descending order
    $sql = "SELECT * FROM gatepass_data WHERE status IN ('Approved', 'Rejected') ORDER BY date_time DESC LIMIT $start_from, $results_per_page";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display approved and rejected requests in a table
        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Destination</th>
                    <th>Purpose</th>
                    <th>Duration</th>
                    <th>HR Status</th>
                    <th>Department Head Status</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>In Log</th>
                    <th>Out Log</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['date_time'] . "</td>
                    <td>" . $row['destination'] . "</td>
                    <td>" . $row['purpose'] . "</td>
                    <td>" . $row['duration_hours'] . " hours " . $row['duration_minutes'] . " minutes</td>
                    <td>" . $row['status'] . "</td>
                    <td>" . $row['dh_status'] . "</td>
                    <td>" . $row['in_action'] . "</td>
                    <td>" . $row['out_action'] . "</td>
                    <td>";




            // Display "In" button if the "In" action is not recorded
            if ($row['in_action'] == NULL) {
                echo "<button id='in-btn-" . $row['id'] . "' class='in-button' onclick=\"recordInOut(" . $row['id'] . ", 'In')\">In</button>";
            } else {
                echo "Recorded";
            }
            echo "</td>
                    <td>";
            // Display "Out" button if the "Out" action is not recorded
            if ($row['out_action'] == NULL) {
                echo "<button id='out-btn-" . $row['id'] . "' class='out-button' onclick=\"recordInOut(" . $row['id'] . ", 'Out')\">Out</button>";
            } else {
                echo "Recorded";
            }
            echo "</td>
                </tr>";
        }
        echo "</table>";

        
        
        // Display pagination controls
        echo "<div class='pagination'>";
        for ($page = 1; $page <= $total_pages; $page++) {
            echo "<a href='index.php?page=" . $page . "' class='" . ($page == $current_page ? 'active' : '') . "'>" . $page . "</a> ";
        }
        echo "</div>";
    } else {
        echo "No approved or rejected requests found.";
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
