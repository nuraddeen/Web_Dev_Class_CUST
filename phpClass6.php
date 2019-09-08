<?php 
 
        //connecting to the database
        try{
             $con = new mysqli("localhost", "root", "nura", "webdevclassdb");//, $database);
            
        } catch (Exception $ex) {
            echo "<br>  Error in db connection ".$ex->getMessage();

            
        }


    function saveData ($con, $filtered_inputs) {
        
        try{ //execute db query
            
                $insertcode = "INSERT INTO userstable "
                        . "(fullname, address, email, password, phone_number)"
                        . "VALUES ('".$filtered_inputs["fullname"]."', '".$filtered_inputs["address"]."', '".$filtered_inputs["email"]."' ,"
                        . " '".$filtered_inputs["password"]."', '".$filtered_inputs["phone_number"]."' "
                        . ")";
                if (mysqli_query($con, $insertcode)) {
                   // echo "<br> Your data saved. Thank you for registering ";

                    return true;
                }
                else {
                 //   echo "<br> Error in saving your data. please try again";
                   return false;
                }
              
            } catch (Exception $ex) {
               // echo "<br>  Error in db connection ".$ex->getMessage();
                return false;
            }

    }


    function infoExists ($con, $email, $pswd = null) {
         
                $query_code = "SELECT *  FROM userstable  WHERE email = '$email' ";

                if ($pswd) {
                    $query_code .= " AND password = '$pswd' ";
                }
                  
                //check if query was executed succesfully
                    if($result = mysqli_query( $con, $query_code)){
                          
                            //get the data
                            $data = mysqli_fetch_assoc($result);

                            if ($data) {
                                return true;
                            }

                            return false;
                            
                    }
                    
                    else {
                        throw new Exception("<br> Oops! A Database Error Has Occured " . $query_code ." @ db");
                
                    }
            

    }
 

//capturing the data
if (isset($_POST["contact-us"])) {
    //echo " You have submitted a contact form ";
    //lets capture the data

    $filters = array(
        "fullname" => FILTER_SANITIZE_STRING,
        "password" => FILTER_SANITIZE_STRING,
        "email" => FILTER_VALIDATE_EMAIL,
        "phone_number" => FILTER_VALIDATE_INT,
        "address" => FILTER_SANITIZE_STRING,
    );
    
    $filtered_inputs = filter_input_array(INPUT_POST, $filters);
    
    $errors = array();
 

    //pswd must be >=3 xters
    if (strlen($filtered_inputs["password"]) <3) {
        $errors [] = "- Your password is too short";
    }

    //pswd must be >=3 xters
    if (strlen($filtered_inputs["phone_number"]) <5 ) {
        $errors [] = "- Your phone number is invalid ";
    }

    //email must be valid email address
    if ($filtered_inputs["email"] == false) {
        $errors [] = "- Your email is invalid ";
    }
    else if (infoExists($con, $filtered_inputs["email"])){
        $errors [] = "- The email was already taken by another user ";
    }

    //fullname must be alphabetic
    if(!preg_match("/^([a-zA-Z' ]+)$/",$filtered_inputs["fullname"])){
        $errors [] = "- Your full name is invalid ";
    } 

    //address should not be empty
    if (!$filtered_inputs["address"]) { //null ""
        $errors [] = "- Your address is invalid ";
    }


    //check if there is errors 

    if (count($errors) == 0 ) {
        //np error, lets save

        if (saveData($con, $filtered_inputs)) {
            $succesText = "- Your registration was successfull. You can now login. Thank you";
        }
        else {
            $errors [] = "- Your data was not saved ";
        }

        

        unset($_POST);
    }


}//end reg form was sent
      
      



// user login
else if (isset($_POST["login"])) {
    //echo " You have submitted a contact form ";
    //lets capture the data

    $filters = array(
        "password" => FILTER_SANITIZE_STRING,
        "email" => FILTER_VALIDATE_EMAIL 
    );

     
    
    //filter and validate the inputs
    $filtered_inputs = filter_input_array(INPUT_POST, $filters);
    
    $errors = array();
 

    //pswd must be >=3 xters
    
    if (!$filtered_inputs["password"]) {
        $errors [] = "- Your password is required. ";
    }

     

    //email must be valid email address
    if ($filtered_inputs["email"] == false) {
        $errors [] = "- Your email is invalid ";
    }
      
    //check if there is errors 

    if (count($errors) == 0 ) {

        if (infoExists($con, $filtered_inputs["email"], $filtered_inputs["password"])) {
            $succesText = " You are logged in ";
        }

        else {
            $errors [] = "- No user with such details was found ";
        }
        
        /*//np error, lets save
            //check if the email and the pswd exists
            $query_code = "SELECT *  FROM userstable  WHERE email = '".$filtered_inputs["email"]."' AND password = '".$filtered_inputs["password"]."' ";
                  
            //check if query was executed succesfully
                if($result = mysqli_query( $con, $query_code)){
                      
                        //get the data
                        $data = mysqli_fetch_assoc($result);

                        if ($data) {
                            $succesText = " You are logged in ";
                        }
                        else {
                            $errors [] = "- No user with such details was found ";
                        }
 
                        
                }
                
                else {
                    throw new Exception("<br> Oops! A Database Error Has Occured " . $query_code ." @ db");
            
                }
                */
 
    }


}//end reg form was sent
      
      
     

?>


<html> 
    <head>
        <title>
            CUST Web Dev Class | PHP Class 5 User Registration
        </title>

        <!-- import js and boostrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <style>
             
        </style>

    </head>
<body> 
         <h1 class = "jumbotron"> Welcome to my site </h1>
        
         <div class = "container">


            <h1 class = "bg-info"> User Registration </h1> <br/> 

            <?php 

            
                //check if there is errors and display them here
                if (isset($errors) && count($errors) > 0){
                    echo "<div class = 'alert alert-danger' > ";

                    //loop thru the array and display each errros

                    foreach($errors as $errorText) {
                        echo "$errorText <br> ";
                    }
                    
                    echo "</div> ";
                }

                //show success text

                if (isset($succesText) && $succesText ) {
                    echo "<div class = 'alert alert-success'>  $succesText </div> ";
                }

            ?>


            
    <hr/>
        
    <div class = "row"class = "bg-light" >
        <div class = "col-md-8" class = "bg-light" >
            <h1> Register With Us </h1>

            <form action="phpClass6.php" method="POST"  style = " width: 60%">
            
                    <label> Your name </label>
                    <input type ="text" name="fullname" class = "form-control" id="fullname" value="<?php 
                    
                    if (isset($_POST["fullname"])) {
                        echo $_POST["fullname"]; 
                    }
                    
                    ?>" required/>
                    <br/>
                    
                    <label> Your email </label>
                    <input type ="email" name="email" id="email" class = "form-control"  value="<?php 
                    
                    if (isset($_POST["email"])) {
                        echo $_POST["email"]; 
                    }
                    
                    ?>" required/>
                    <br/>
                    
                    <label> Your password </label>
                    <input type ="password" name="password" id="password" class = "form-control"  required/>
                
                    <br/>
                    
                    <label> Your Phone Number </label>
                    <input type ="text" name="phone_number" id="phone_number" class = "form-control"  value="<?php 
                    
                    if (isset($_POST["phone_number"])) {
                        echo $_POST["phone_number"]; 
                    }
                    
                    ?>" required/>
                
                    <br/>
                    <label> Your Address </label>
                    <input type ="text" name="address" id="address" class = "form-control"  value="<?php 
                    
                    if (isset($_POST["address"])) {
                        echo $_POST["address"]; 
                    }
                    
                    ?>" required/>
                    
                    <br/>
                    <input type="submit" value="Submit" class = "btn btn-info"  name="contact-us">

                </form>

        </div>



        <div class = "col-md-4" >
            <h1 > Login to your account </h1> 
             
            <form action="phpClass6.php" method="Post"  style = " width: 60%">
                    <label> Your email </label>
                    <input type ="email" name="email" id="email-login" class = "form-control"  required/>
                    <br/>
                    
                    <label> Your password </label>
                    <input type ="password" name="password" id="password-login" class = "form-control" required />
                
                    <br/>
                     
                    <br/>
                    <input type="submit" value="Login" class = "btn btn-info"  name="login">

                </form>

        </div>



    </div>
 


    </div> <!-- container -->

    <br> <br>
    
    
</body>
</html>