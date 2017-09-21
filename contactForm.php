<!DOCTYPE html>
<html>
<!-- Validation PHP -->
<?php
	// define variables & set to empty values
	$IDErr = $clubNameErr = $clubTypeErr = $clubQErr = $clubEmailErr = $presQErr = $presNameErr = $presEmailErr = $presPhoneErr = $advisorNameErr = $advisorEmailErr = ""; 

	$ID = $clubName = $clubType = $clubQ = $clubEmail = $presQ = $presName = $presEmail = $presPhone = $advisorName = $advisorEmail = "";

	$server = '';
	$user = 'USERNAME';
	$pass = 'PASSWORD';
	$db_name = 'USERNAME';
	$table = 'ASU_Clubs';
	$presValid = FALSE;
	$valid = TRUE;	
	$conn = new mysqli($server, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
	

	if ($_SERVER["REQUEST_METHOD"] == "POST"){

// ID Check		
		if(empty($_POST["ID"])){
			$IDErr = "Required";
			$valid = FALSE;

		} elseif(!preg_match("/^[(907)]{3}[0-9]{6}$/", $_POST["ID"])) {
			$IDErr = "Only Student IDs Allowed";
			$valid = FALSE;
		} else {
			$ID = test_input($_POST["ID"]);
		}

// Club Name Check
		if(empty($_POST["clubName"])){
			$clubNameErr = "Required";
			$valid = FALSE;

		} elseif(!preg_match("/^[a-zA-Z0-9\s]*$/", $_POST["clubName"])){
			$clubNameErr = "Only letters, numbers, and white spaces Allowed.";
			$valid = FALSE;
		} else {
			$clubName = test_input($_POST["clubName"]);
		}

// Club Type Check
	if($_POST){	
		if(isset($_POST['clubType'])){
			if($_POST['clubType'] == 'blank'){
				$clubTypeErr = "Required";
				$valid = FALSE;
			} else{
				$clubType = test_input($_POST["clubType"]);
			}
		}
	}	
// Club Question Validation
		if(empty($_POST["clubQ"])){
			$clubQErr = "Required";
			$valid = FALSE;
		} elseif (isset($_POST['clubQ']) && $_POST['clubQ'] == 'yes'){
		// Club Email Check			
			if(empty($_POST["clubEmail"])){
				$clubEmailErr = "Email is Required";
				$valid = FALSE;
			}
			else if(!filter_var($_POST["clubEmail"], FILTER_VALIDATE_EMAIL)){
				$clubEmailErr = "Invalid email format";
				$valid = FALSE;
			} else {
				$clubEmail = test_input($_POST["clubEmail"]);
			}
			
		} elseif(isset($_POST["club"]) && $_POST["club"] == "no"){
			$clubQ = test_input($_POST["clubQ"]);
		}

// President Question Validation		
		if(empty($_POST["presQ"])){
			$presQErr = "Required";
			$valid = FALSE;
		} elseif(isset($_POST["presQ"]) && $_POST["presQ"] == "yes1" ){
			$presValid = TRUE;
		} elseif(isset($_POST["presQ"]) && $_POST["presQ"] == "no1"){
			$presQ = test_input($_POST["presQ"]);
		}

// President Name Check
		if($presValid == TRUE){
			if(empty($_POST["presName"])){
				$presNameErr = "Required";
				$valid = FALSE;

			} elseif(!preg_match("/^[a-zA-Z\s]*$/", $_POST["presName"])){
				$presNameErr = "Only letters and white spaces Allowed.";
				$valid = FALSE;
			} else{
				$presName = test_input($_POST["presName"]);
			}
		} 

// President Email Check
		if($presValid == TRUE){		
			if(empty($_POST["presEmail"])){
				$presEmailErr = "Required";
				$valid = FALSE;
			} elseif(!filter_var($_POST["presEmail"], FILTER_VALIDATE_EMAIL)){
				$presEmailErr = "Invalid email format";
				$valid = FALSE;
			} else {
				$presEmail = test_input($_POST["presEmail"]);
			}
		}

// President Phone Check
		if($presValid == TRUE){
			if(empty($_POST["presPhone"])){
				$presPhoneErr = "Required";
				$valid = FALSE;
			} elseif(!preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/", $_POST["presPhone"])){
				$presPhoneErr = "Only digits allowed";
				$valid = FALSE;
			} else {
				$presPhone = test_input($_POST["presPhone"]);
			}
		}

// Advisor Name Check
			if(empty($_POST["advisorName"])){
				$advisorNameErr = "Required";
				$valid = FALSE;
			} elseif(!preg_match("/^[a-zA-Z\s]*$/", $_POST["advisorName"])){
				$advisorNameErr = "Only letters and white spaces Allowed.";
				$valid = FALSE;
			} else{
				$advisorName = test_input($_POST["advisorName"]);
			}

// Advisor Email Check			
		if(empty($_POST["advisorEmail"])){
			$advisorEmailErr = "Required";
			$valid = FALSE;
		} elseif(!filter_var($_POST["advisorEmail"], FILTER_VALIDATE_EMAIL)){
				$advisorEmailErr = "Invalid email format";
				$valid = FALSE;
		} else {
				$advisorEmail = test_input($_POST["advisorEmail"]);
		}	

	} 

	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);				
		return $data;
	}


	?>

    <title>Armstrong Club's Database</title>

    <head>
        <link type="text/css" rel="stylesheet" href="stylesheet.css" />

        <!-- JQuery hide & show Functions -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
            $(function () {
                $("#hide").click(function () {
                    $('.emailReveal').hide();
                });
                $("#show").click(function () {
                    $('.emailReveal').show();
                });
                $("#hide1").click(function () {
                    $('.presReveal').hide();
                });
                $("#show1").click(function () {
                    $('.presReveal').show();
                });
            });
        </script>
        <select onchange="location = this.options[this.selectedIndex].value;">
            <option> Jump to </option>
            <option value="http://web-students.armstrong.edu/USER/Final/index.html">Home Page</option>
            <option value="http://web-students.armstrong.edu/USER/Final/contactForm.php">Contact Form</option>
            <option value="http://web-students.armstrong.edu/USER/Final/searchDatabase.php">Search Database</option>
        </select>
    </head>

    <body>

        <!-- Title -->
        <h1>Club Information</h1>
        <form action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="POST">

            <!-- Table Form -->
            <table class="form">
                <tr>
                    <td>Student ID</td>
                </tr>

                <tr>
                    <td>
                        <input class="inputfield" type="int" name="ID" value="<?php echo $ID;?>"><span class="error"> * <?php echo $IDErr;?></span></td>
                </tr>

                <tr>
                    <td>Club Name</td>
                </tr>

                <tr>
                    <td>
                        <input class="inputfield" type="varchar" name="clubName" value="<?php echo $clubName;?>"><span class="error"> * <?php echo $clubNameErr;?></span></td>
                </tr>

                <tr>
                    <td>Club Type</td>
                </tr>

                <tr>
                    <td>
                        <select name="clubType" id="clubType" value="<?php echo $clubTypeErr;?>">
                            <option value="blank"> </option>
                            <option value="Academic">Academic</option>
                            <option value="Faith-Based">Faith-Based</option>
                            <option value="Special Interest">Special Interest</option>
                            <option value="Honor Society">Honor Society</option>
                            <option value="Sports">Sports</option>
                        </select><span class="error"> * <?php echo $clubTypeErr;?></span>
                    </td>
                </tr>
                <!-- Javascript for Drop List -->
                <script type="text/javascript">
                    document.getElementById('clubType').value = "<?php echo $_GET['clubType'];?>";
                </script>

                <tr>
                    <td>Do you have a club email?</td>
                </tr>
                <tr>
                    <td>Yes
                        <input type="radio" name="clubQ" value="yes" id="show" <?php if (isset($_POST[ 'clubQ']) && $_POST[ 'clubQ']=='yes' ) echo "checked"; ?> > No
                        <input type="radio" name="clubQ" value="no" id="hide" <?php if (isset($_POST[ 'clubQ']) && $_POST[ 'clubQ']=='no' ) echo "checked";?> ><span class="error"> * <?php echo $clubQErr;?></span></td>
                </tr>

                <tr>
                    <td>
                        <div id='emailReveal' class="emailReveal" style="display:none">Club Email</div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='emailReveal' class="emailReveal" style="display:none">
                            <input class="inputfield" type="varchar" name="clubEmail" value="<?php echo $clubEmail;?>"><span class="error"> * <?php echo $clubEmailErr;?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Do you have a club President?</td>
                </tr>

                <tr>
                    <td>Yes
                        <input type="radio" name="presQ" value="yes1" id="show1" <?php if (isset($_POST[ 'presQ']) && $_POST[ 'presQ']=='yes1' ) echo "checked"; ?> > No
                        <input type="radio" name="presQ" value="no1" id="hide1" <?php if (isset($_POST[ 'presQ']) && $_POST[ 'presQ']=='no1' ) echo "checked"; ?> ><span class="error"> * <?php echo $presQErr;?></span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='presReveal' class="presReveal" style="display:none">President Name</div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='presReveal' class="presReveal" style="display:none">
                            <input class="inputfield" type="text" name="presName" value="<?php echo $presName;?>"><span class="error"> * <?php echo $presNameErr;?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='presReveal' class="presReveal" style="display:none">President Email</div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='presReveal' class="presReveal" style="display:none">
                            <input class="inputfield" type="varchar" name="presEmail" value="<?php echo $presEmail;?>"><span class="error"> * <?php echo $presEmailErr;?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='presReveal' class="presReveal" style="display:none">President Phone</div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div id='presReveal' class="presReveal" style="display:none">
                            <input class="inputfield" type="int" name="presPhone" value="<?php echo $presPhone;?>"><span class="error"> * <?php echo $presPhoneErr;?></span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>Advisor Name</td>
                </tr>

                <tr>
                    <td>
                        <input class="inputfield" type="text" name="advisorName" value="<?php echo $advisorName;?>"><span class="error"> * <?php echo $advisorNameErr;?></span></td>
                </tr>

                <tr>
                    <td>Advisor Email</td>
                </tr>

                <tr>
                    <td>
                        <input class="inputfield" type="varchar" name="advisorEmail" value="<?php echo $advisorEmail;?>"><span class="error"> * <?php echo $advisorEmailErr;?></span></td>
                </tr>

            </table>

            <br>

            <div style="text-align: center;">
                <button type="submit" style="height:50px; width: 100px" name="buttSubmit">
                    <h2>Submit</h2></button>
            </div>
        </form>

        <span>	
<!-- After all information is TRUE in validation PHP, submit to Database -->	
<?php
if($valid and $_SERVER['REQUEST_METHOD'] == 'POST'){
      if(!$conn)
      {
        die('Could not connect:'. $conn->connect_error);
      }
$query = "INSERT INTO ASU_Clubs (ID, clubName, clubType, clubEmail,
 presName, presEmail, presPhone, advisorName, advisorEmail) 
VALUES ('$ID', '$clubName', '$clubType', '$clubEmail', '$presName', '$presEmail',
	'$presPhone', '$advisorName','$advisorEmail');";

$result = mysqli_query($conn, $query);

if(!$result)
    {
die('Could not enter data:'. mysqli_error($conn));
}
echo "Entered data successfully";
}
mysqli_close($conn);

?>
</span>
    </body>

</html>