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
        
     
 
    }


}//end reg form was sent
      
      
     

	
 function validateInput($data) {
 
    $data =  filter_var (trim(stripslashes(htmlspecialchars($data))));
          
    return  str_replace('"', '\"', str_replace("'", "\'", $data));
  }
  

?>


<html> 
    <head>
        <title>
            CUST Web Dev Class | PHP Class 7 User Homepage
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


            <h1 class = "bg-info"> User Home Page  </h1> <br/> 

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
            <h1> User Information  </h1>
  
            <?php
                    //check if user_id was sent
                    if (isset($_GET["user_id"])) {
                            $user_id =  validateInput($_GET["user_id"]);
                            
                            if (!is_numeric($user_id) || $user_id <0){
                                $user_id = 0;
                               //var_dump("user id = $user_id ");
                            }
                            else if ($user_id > 10 ) {
                              //  $user_id = 10;
                                
                            }
 

                            //check the db for this user(get the info from the db)

                            $query_code = "SELECT *  FROM userstable  WHERE user_id = $user_id ";
                        
                           //check if query was executed succesfully
                               if($result = mysqli_query( $con, $query_code)) {
                                     
                                       //get the data
                                       $data = mysqli_fetch_assoc($result);
                   
                                       if ($data) {
                                          

                                       echo "  <strong> Name: </strong> <em> ".$data["fullname"]."</em>

                                         <br/><br/>
                         
                                         <strong> Email: </strong> <em>".$data["email"]."</em>
                         
                                         <br/> <br/>
                         
                                         <strong> Phone Number : </strong> <em> ".$data["phone_number"]." </em>
                         
                                         <br/> <br/>
                         
                                         <strong> Address  : </strong> <em> ".$data["address"]." </em>
                         
                                         <br/> <br/>";
                                           
                                          
                                       }
                
                                       else {
                                            $errors [] = "- No user with such details was found ";
                                       }
                
                                          
                               }
                               
                               else {
                                   throw new Exception("<br> Oops! A Database Error Has Occured " . $query_code ." @ db");
                           
                               }
                       
                    }

            ?>
               
                      

        </div>

 



    </div>
 


    </div> <!-- container -->

    <br> <br>
    
    
</body>
</html>