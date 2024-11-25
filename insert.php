<?php
require 'db.php';

$connection_message = ""; // Variable to store connection status message
$action_message = ""; // Variable to store form submission result message

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $connection_message = "Database connected successfully!";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $class = $_POST['class'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, age, class, email) VALUES ('$name', $age, '$class', '$email')";
    if ($conn->query($sql)) {
        $action_message = "Student added successfully!";
    } else {
        $action_message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Student</title>
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
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(330deg, #5e759a 10%, #e7c876 90%);
        }
        .container {
            max-width: 600px;
            width: 100%;
            padding: 30px;
            background: linear-gradient(133deg, #5e759a 10%, #e7c876 90%);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }
        .container h1 {
            font-size: 24px;
            color: #333;
        }
        .message {
            margin: 15px 0;
            font-size: 16px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button-container {
    display: flex;
    justify-content: center;
    align-items: center; /* Ensures vertical alignment */
    gap: 15px; /* Adds spacing between buttons */
    margin-top: 20px; /* Adjust spacing from the form */
}

button, .home-btn {
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
}

button {
    background-color: #4CAF50;
    color: white;
}

button:hover {
    background-color: #45a049;
}

.home-btn {
    text-decoration: none;
    background-color: #f44336;
    color: white;
}

.home-btn:hover {
    background-color: #d32f2f;
}

    </style>
</head>
<body>
    <div class="container">
        <!-- Display connection and action messages -->
        <?php if (!empty($connection_message) || !empty($action_message)) : ?>
            <div class="message">
                <?php if (!empty($connection_message)) : ?>
                    <div class="success"><?php echo $connection_message; ?></div>
                <?php endif; ?>
                <?php if (!empty($action_message)) : ?>
                    <div class="success"><?php echo $action_message; ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h1>Insert New Student</h1>
        <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="class">Class</label>
                <input type="text" id="class" name="class" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="button-container">
    <button type="submit" name="submit">Submit</button>
    <a href="index.php" class="home-btn">Go to Home</a>
</div>
        </form>
    </div>
</body>
</html>
