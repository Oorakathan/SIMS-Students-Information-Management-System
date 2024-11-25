<?php
require 'db.php'; // Include the database connection

// Fetch all student records to display in a table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

// Variables for pre-filling the form
$student = null;
$id_to_edit = null;

// If an ID is submitted, fetch the student's details
if (isset($_POST['id_to_edit'])) {
    $id_to_edit = intval($_POST['id_to_edit']);
    $query = $conn->query("SELECT * FROM students WHERE id = $id_to_edit");
    if ($query->num_rows > 0) {
        $student = $query->fetch_assoc();
    } else {
        echo "<p style='color: red;'>Student with ID $id_to_edit not found!</p>";
    }
}

// If the form is submitted to update the record
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $age = intval($_POST['age']);
    $class = $_POST['class'];
    $email = $_POST['email'];

    // SQL query to update the student record
    $sql = "UPDATE students SET name='$name', age=$age, class='$class', email='$email' WHERE id=$id";

    // Execute the query and provide feedback
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Record with ID $id updated successfully!</p>";
        // Redirect to view.php after a successful update
        header("Location: view.php");
        exit(); // Make sure no further code is executed after the redirect
    } else {
        echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
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
            background: linear-gradient(330deg, #5e759a 10%, #e7c876 90%);
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
            background-color: #5e759a;
            color: white;
        }
        form {
            margin: 20px auto;
            background: linear-gradient(133deg, #5e759a 10%, #e7c876 90%);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 50%;
        }
        input[type="text"], input[type="number"], input[type="email"] {
            padding: 10px;
            margin: 5px 0;
            width: 50%;
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
            background: #5e759a;
            overflow: hidden;
            border: none;
        }
        button:hover {
            background: #4a5e7c;
        }
        button .inner {
            position: absolute;
            height: 100%;
            width: 300%;
            top: 0;
            left: -100%;
            background: linear-gradient(135deg, #56d8e4, #9f01ea, #5e759a, #e7c876);
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
            background: #e7c876;
            color: white;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
        .home-btn:hover {
            background: #d6b366;
        }
    </style>
</head>
<body>
    <h2>Edit Student Record</h2>

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

    <!-- Form to enter the ID to edit -->
    <form method="POST" action="">
        <label for="id_to_edit">Enter ID to Edit:</label>
        <input type="number" name="id_to_edit" id="id_to_edit" required>
        <button type="submit">
            <div class="inner"></div>
            <span>Fetch Record</span>
        </button>
    </form>

    <a href="index.php" class="home-btn">Go to Home</a>

    <!-- Display the editable form if a student is found -->
    <?php if ($student): ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br><br>

        <label>Age:</label>
        <input type="number" name="age" value="<?php echo $student['age']; ?>" required><br><br>

        <label>Class:</label>
        <input type="text" name="class" value="<?php echo $student['class']; ?>" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br><br>

        <button type="submit" name="update">
            <div class="inner"></div>
            <span>Update</span>
        </button>
    </form>
    <?php endif; ?>
</body>
</html>
