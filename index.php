<html> 

<body> 

<h1> welcome to my site </h1>

<?php 
	echo "<h1> Welcome to Php </h1> <br/> ";
	$x = 5 + 15  + 5;
echo $x;

echo " another line <br/> ";

//types

	$name = "hanmu";

	echo " Bawan A'isha is ".$name;

	$name = 25;

	echo "<br/> His age is $name  and hes is from Hadejia ";

	$name = 2895.67;

	echo "<br/> His account balance is ".$name;

	$name = false;

  
	if (0.00) {

		echo "<br/> And hes is Nigerian ".$name;
	}

	$name = "hanmu";

	$otherName = "Muazzamu";

	//$fullname = $name . " ". $otherName;

	$fullname = "$name $otherName";

	echo " <br/> His full name is $fullname  and his hobby id Ball's";

	 
	 $num = 25;
 echo '5 x 5 = $num' ;

 //date

 //timestamp
 //date
 //formatting
 //date arithmetics

 $timestamp = time();//timestamp
echo " <br/> current timestamp is $timestamp ";

 $date = date("D-M/Y H:I:s A", $timestamp);

 //echo " <br/> formatted dateis $date ";


$today = new DateTime("02-05-2008");

$date2 = new DateTime("Wed Aug 21, 2019");

echo " <br/> differencet is ". $today->diff($date2)->format("%y");
 
 echo " <br/> rand is ".rand();

	for ($i =1; $i<=10; $i++) {

		echo " <div style = 'background-color: #f00' > $i) ".getName()." </div> <br/> ";
	}


 
	function  getName() {
 
		if (rand() %2 == 0){

		 return " Hamnu ";
		}

		else {
			return " Jaja";
		}
	}

 

?>

</body>
</html>