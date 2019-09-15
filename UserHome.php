<?php 
 
//check if the user has logged in

session_start();

//session varibale must be set
//it must be numeric
//it must be > 0

if (isset($_SESSION["user_id"]) && is_numeric ($_SESSION["user_id"]) && $_SESSION["user_id"] >0) {
    //user has logged in

    $user_id = validateInput($_SESSION["user_id"]);
}

else {
    //redirect user to login page
    ?>
  
  <script>
      alert('Sorry, your session has expired, please login again');

      //redirect
      window.location = 'PhpClass6.php';
  </script>
  //  header("Location: PhpClass6.php");

    <?php
}

        //connecting to the database
        try{
             $con = new mysqli("localhost", "root", "nura", "webdevclassdb");//, $database);
            
        } catch (Exception $ex) {
            echo "<br>  Error in db connection ".$ex->getMessage();

            
        }

         
  
	
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
              /*      if (isset($_GET["user_id"])) {
                            $user_id =  validateInput($_GET["user_id"]);
                            
                            if (!is_numeric($user_id) || $user_id <0){
                                $user_id = 0;
                               //var_dump("user id = $user_id ");
                            }
                            else if ($user_id > 10 ) {
                              //  $user_id = 10;
                                
                            }
                    */

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
                         
                                         <br/> <br/>
                                         <a href = 'logout.php' onclick = 'return confirm(\"Are you sure you want to logout ?\") ' > Logout </a>
                                         ";
                                           
                                          
                                       }
                
                                       else {
                                            $errors [] = "- No user with such details was found ";
                                       }
                
                                        
                               }
                               
                               else {
                                   throw new Exception("<br> Oops! A Database Error Has Occured " . $query_code ." @ db");
                           
                               }
                              
                       
                    /*  } */

            ?>
               
                      

        </div>

 



    </div>
 


    </div> <!-- container -->

    <br> <br>
    
    
</body>
</html>