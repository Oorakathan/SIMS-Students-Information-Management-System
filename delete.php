<?php
require 'db.php'; // Include database connection

// Handle deletion if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // Convert input to integer for safety

    // SQL query to delete the record
    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Record with ID $id deleted successfully!</p>";
    } else {
        echo "<p style='color: red;'>Error deleting record: " . $conn->error . "</p>";
    }
}

// Fetch all student records to display
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(330deg, #ff8a65 10%, #4CAF50 90%);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f44336;
            color: white;
        }
        form {
            margin: 20px auto;
            background: linear-gradient(133deg, #f44336 10%, #ff8a65 90%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 50%;
        }
        input[type="number"] {
            padding: 10px;
            margin: 5px 0;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            position: relative;
            padding: 10px 20px;
            margin: 10px 5px 0 0;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            background: #f44336;
            overflow: hidden;
            border: none;
        }
        button:hover {
            background: #d32f2f;
        }
        button .inner {
            position: absolute;
            height: 100%;
            width: 300%;
            top: 0;
            left: -100%;
            background: linear-gradient(135deg, #ff9e80, #f44336, #ff7043, #ff8a65);
            transition: all 0.4s ease;
            z-index: -1;
        }
        button:hover .inner {
            left: 0;
        }
        button span {
            position: relative;
            z-index: 2;
        }
        .home-btn {
            display: inline-block;
            text-decoration: none;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
        .home-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <h2>Delete Student Record</h2>

    <!-- Display the table of students -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Class</th>
            <th>Email</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Form to input ID to delete -->
    <form method="POST" action="">
        <label for="id">Enter ID to Delete:</label>
        <input type="number" name="id" id="id" required>
        <button type="submit">
            <div class="inner"></div>
            <span>Delete</span>
        </button>
    </form>

    <!-- Home button -->
    <a href="index.php" class="home-btn">Go to Home</a>
</body>
</html>
