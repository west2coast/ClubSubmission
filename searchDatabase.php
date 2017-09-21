<!DOCTYPE html>
<html>

<head>
    <title>ASU Club Database</title>
    <meta http-equiv="Content-Type" content="text/html; charset= iso-8859-1">
    <link type="text/css" rel="stylesheet" href="stylesheet.css" />
</head>

<body>
    <select onchange="location = this.options[this.selectedIndex].value;">
        <option> Jump to </option>
        <option value="http://web-students.armstrong.edu/USER/Final/index.html">Home Page</option>
        <option value="http://web-students.armstrong.edu/USER/Final/contactForm.php">Contact Form</option>
        <option value="http://web-students.armstrong.edu/USER/Final/searchDatabase.php">Search Database</option>
    </select>
    <h3>ASU Club Database</h3>
    <form method="post" action="searchDatabase.php?go">
        <p class="newp">Search by club name
            <input type="text" name="searchBar">
            <input type="submit" name="submitSearch" value="Search">
        </p>

        <p class="newp">Search by club type
            <select name="clubType" id="clubType">
        </p>
        <option value="blank"> </option>
        <option value="Academic">Academic</option>
        <option value="Faith-Based">Faith-Based</option>
        <option value="Special Interest">Special Interest</option>
        <option value="Honor Society">Honor Society</option>
        <option value="Sports">Sports</option>
        </select>
        <input type="submit" name="submitSearch2" value="Search">
    </form>

    <!-- Different Search Setups: Club name, Club type, or just full database (default) -->
    <?php
	$server = '';
	$user = 'USERNAME';
	$pass = 'PASSWORD';
	$db_name = 'USERNAME';
	$table = 'ASU_Clubs';
	$match = "/^[a-zA-Z]+/";


// Connect to the database
$db = mysql_connect ("$server", "$user", "$pass") or die ('I cannot connect to the database because: ' . mysqli_error());

// Select the database to use
$mydb = mysql_select_db('USER');

// Query the database table
$searchBar = $_POST['searchBar'];
$clubType = $_POST['clubType'];

$sql = "SELECT * FROM ASU_Clubs WHERE clubName LIKE '%" . $searchBar . "%'";
$sql1 = "SELECT * FROM ASU_Clubs WHERE clubType LIKE '%" . $clubType . "%'";
$sql2 = "SELECT * FROM ASU_Clubs ORDER BY clubName";
// Run the query against the mysqli query function
$result = mysql_query($sql);
$result1 = mysql_query($sql1);
$result2 = mysql_query($sql2);

	// Search by Club Name
if (isset ($_POST['submitSearch'])){
	if (isset ($_GET['go'])){
		if (preg_match($match, $_POST['submitSearch'])) {
			echo "<table>";

echo "<table class='table'>
	<tr>
	<th class= 'table'>Club Name</th>
	<th class= 'table'>Club Type</th>
	<th class= 'table'>Club Email</th>
	<th class= 'table'>President Name</th>
	<th class= 'table'>President Email</th>
	<th class= 'table'>President Phone</th>
	<th class= 'table'>Advisor Name</th>
	<th class= 'table'>Advisor Email</th>
	</tr>";

	while ($row = mysql_fetch_assoc($result)){
		echo "<tr class= 'table'>";
		echo "<td class= 'table'>" . $row["clubName"] . "</td>";
		echo "<td class= 'table'>" . $row["clubType"] . "</td>";
		echo "<td class= 'table'>" . $row["clubEmail"] . "</td>";
		echo "<td class= 'table'>" . $row["presName"] . "</td>";
		echo "<td class= 'table'>" . $row["presEmail"] . "</td>";
		echo "<td class= 'table'>" . $row["presPhone"] . "</td>";
		echo "<td class= 'table'>" . $row["advisorName"] . "</td>";
		echo "<td class= 'table'>" . $row["advisorEmail"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	mysql_close();
		}

	}
	// Search By Club Type
} elseif (isset ($_POST['submitSearch2'])){
	if (isset ($_GET['go'])){
		if (preg_match($match, $_POST['submitSearch2'])) {
			echo "<table>";

echo "<table class='table'>
	<tr>
	<th class= 'table'>Club Name</th>
	<th class= 'table'>Club Type</th>
	<th class= 'table'>Club Email</th>
	<th class= 'table'>President Name</th>
	<th class= 'table'>President Email</th>
	<th class= 'table'>President Phone</th>
	<th class= 'table'>Advisor Name</th>
	<th class= 'table'>Advisor Email</th>
	</tr>";

	while ($row1 = mysql_fetch_assoc($result1)){
		echo "<tr class= 'table'>";
		echo "<td class= 'table'>" . $row1["clubName"] . "</td>";
		echo "<td class= 'table'>" . $row1["clubType"] . "</td>";
		echo "<td class= 'table'>" . $row1["clubEmail"] . "</td>";
		echo "<td class= 'table'>" . $row1["presName"] . "</td>";
		echo "<td class= 'table'>" . $row1["presEmail"] . "</td>";
		echo "<td class= 'table'>" . $row1["presPhone"] . "</td>";
		echo "<td class= 'table'>" . $row1["advisorName"] . "</td>";
		echo "<td class= 'table'>" . $row1["advisorEmail"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	mysql_close();
		}

	}
	// Show whole table with information ordered by Club Title
} else {
		echo "<table>";

echo "<table class='table'>
	<tr>
	<th class= 'table'>Club Name</th>
	<th class= 'table'>Club Type</th>
	<th class= 'table'>Club Email</th>
	<th class= 'table'>President Name</th>
	<th class= 'table'>President Email</th>
	<th class= 'table'>President Phone</th>
	<th class= 'table'>Advisor Name</th>
	<th class= 'table'>Advisor Email</th>
	</tr>";

	while ($row2 = mysql_fetch_assoc($result2)){
		echo "<tr class= 'table'>";
		echo "<td class= 'table'>" . $row2["clubName"] . "</td>";
		echo "<td class= 'table'>" . $row2["clubType"] . "</td>";
		echo "<td class= 'table'>" . $row2["clubEmail"] . "</td>";
		echo "<td class= 'table'>" . $row2["presName"] . "</td>";
		echo "<td class= 'table'>" . $row2["presEmail"] . "</td>";
		echo "<td class= 'table'>" . $row2["presPhone"] . "</td>";
		echo "<td class= 'table'>" . $row2["advisorName"] . "</td>";
		echo "<td class= 'table'>" . $row2["advisorEmail"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";

	mysql_close();

			//echo "<p>Probably doesn't exist or look at your wording carefully.</p>";
		}

	?>
</body>

</html>