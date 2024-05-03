<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVSU GATEPASS v1.0</title>
    <style>
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

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Gatepass Form</h1>
    <p align = "center"><img src="img/evsu logo.png" alt="Logo" width="50" height="50"></p>
    <!-- Replace "your_icon_or_logo.png" with the path to your icon or logo image -->
    <form action="submit.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="date">Date and Time:</label>
        <input type="datetime-local" id="date" name="date" required>
        <br>
        <br>

        <label for="destination">Where to go:</label>
        <input type="text" id="destination" name="destination" required>

        <label for="purpose">Purpose:</label>
        <input type="text" id="purpose" name="purpose" required>

        <label for="duration">Expected Duration:</label>
        <select id="duration_hours" name="duration_hours">
            <option value="0">0 hour</option>
            <option value="1">1 hour</option>
            <option value="2">2 hours</option>
            <option value="3">3 hours</option>
            <option value="4">4 hours</option>
            <option value="5">5 hours</option>
            <option value="6">6 hours</option>
            <option value="7">7 hours</option>
            <option value="8">8 hours</option>
            <option value="9">9 hours</option>
            <option value="10">10 hours</option>
            <!-- Add more options as needed -->
        </select>
        <select id="duration_minutes" name="duration_minutes">
            <option value="0">0 minute</option>
            <option value="10">10 minutes</option>
            <option value="20">20 minutes</option>
            <option value="30">30 minutes</option>
            <option value="40">40 minutes</option>
            <option value="50">50 minutes</option>
            <!-- Add more options as needed -->
        </select>

        <label for="employee_name">Employee Name:</label>
        <input type="text" id="employee_name" name="employee_name" required>

        <label for="email">Employee Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="department">Department:</label>
        <select id="department" name="department" required>
            <option value="">Select Department</option>
            <option value="Computer Studies">Computer Studies</option>
            <option value="Engineering">Engineering</option>
            <!-- <option value="N/A">N/A</option> -->
        </select>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]+" required>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
