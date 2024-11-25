<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SIMS</title>
	<style>
	:root {
	--bgcolor:#E7C876;
}

* {
	margin: 0;
	padding: 0;
	font-family: sans-serif;
}

body {
	min-height: 100vh;
	display: grid;
	place-items: center;
background: linear-gradient(255deg,#E7C876, #5E579A );
	color: #5E579A;
}
body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	
}
nav {
	list-style: none;
}

ul{
	list-style:none;
}
a {
	font-size: 5rem;
	position: relative;
	text-transform: uppercase;
	transition: all 300ms ease;
	width: fit-content;
	cursor: pointer;
}
a:hover {
	transform: skew(10deg);
}
a::before {
	content: attr(data-name);
	position: absolute;
	top: 0;
	left: -20px;
	background: var(--bgcolor);
	height: 3rem;
	overflow: hidden;
	transition: all 300ms ease;
	padding-left: 20px;
}
a:hover::before {
	top: -3px;
	left: 0px;
	color: #f1b7ff;
}

a::after {
	content: "";
	height: 4px;
	width: 0;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background: #d27115;
	transition: all 300ms ease;
}
a:hover::after {
	width: 120%;
	outline: 5px solid rgb(2, 0, 36);
}
label {
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 50px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}

	</style>
</head>
<body>
    
<label>Welcome to S.I.M.S</label><br>

<nav>
		<ul>
			
			<li><a style="text-decoration:none;" data-name="insert" href="insert.php">Insert</a></li>
			<li><a style="text-decoration:none;" data-name="edit" href="edit.php">Edit</a></li>
			<li><a style="text-decoration:none;" data-name="view" href="view.php">View</a></li>
			<li><a style="text-decoration:none;" data-name="delete" href="delete.php">Delete</a></li>
			<li><a style="text-decoration:none;" data-name="logout" href="logout.php">Logout</a></li>
		
		
	
	</ul>
<nav>

</body>
</html>
