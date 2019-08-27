<?php
$var = "<script> alert('hamnu'); </script> ";

 
var_dump( stripslashes($var));
var_dump(htmlspecialchars($var));
var_dump(trim($var));



//capturing
if (isset($_POST["contact-us"])) {
    //echo " You have submitted a contact form ";
    //lets capture the data
    
    if (strlen($_POST["password"]) <3) {
        echo " Your password is too short ";
    }
    
  else {
      
      //checking whether the full name was sent
      if (isset($_POST["fullname"])) {
          echo "<br> <strong> Your Name : </strong> ".  $_POST["fullname"];
      }
      
      echo 
     "<br> <strong> Your Email : </strong> ". $_POST["email"]
    . "<br> <strong> Your Password : </strong> ". $_POST["password"]
    . "<br> <strong> Your Phone Number : </strong> ". $_POST["phone_number"]
    . "<br> <strong> Your Adress : </strong> ". $_POST["address"];
      
      //wiping data
      unset($_POST);
  }
    
}


?>


<html> 
    <head>
        <title>
            CUST Web Dev Class | PHP Class 4 Forms Handling
        </title>
    </head>
<body> 

<h1> Welcome to my site </h1>

<h1> PHP Forms Handling </h1> <br/> 
 <hr/>
 <form action="phpClass4.php" method="POST">
                
                <h1> Contact Us </h1>
                <label> Your name </label>
                <input type ="text" name="fullname" id="fullname" value="<?php 
                
                  if (isset($_POST["fullname"])) {
                      echo $_POST["fullname"]; 
                  }
                
                ?>"/>
                <br/>
                
                <label> Your email </label>
                <input type ="email" name="email" id="email" value="<?php 
                
                  if (isset($_POST["email"])) {
                      echo $_POST["email"]; 
                  }
                
                ?>"/>
                <br/>
                
                <label> Your password </label>
                <input type ="password" name="password" id="password" />
               
                <br/>
                
                <label> Your Phone Number </label>
                <input type ="text" name="phone_number" id="phone_number" value="<?php 
                
                  if (isset($_POST["phone_number"])) {
                      echo $_POST["phone_number"]; 
                  }
                
                ?>"/>
               
                <br/>
                <label> Your Address </label>
                <input type ="text" name="address" id="address" value="<?php 
                
                  if (isset($_POST["address"])) {
                      echo $_POST["address"]; 
                  }
                
                ?>"/>
                
                <br/>
                <input type="submit" value="Submit" name="contact-us">

            </form>

</body>
</html>