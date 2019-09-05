<html> 
    <head>
        <title>
            CUST Web Dev Class | PHP Class 3 Built Int functions
        </title>
    </head>
<body> 

<h1> welcome to my site </h1>

<?php 
	echo "<h1> PHP Built in functions (arrays) </h1> <br/> ";
	
        
    
    //array_combine
    //array_diff
    //array_flip($students)
    //array_pop($students)
   // array_shift($students);
   // array_unique($students);
   // array_merge($students);
   // in_array($students, $haystack)
    // array_unshift()
    
        //eg of an associative array
    $std = array(
        "name" => "habu",
        "CA1" => 45
    );
         
    //testing array combine
    $keys = [
        "name", "CA1", "CA2", "Exam"
    ];     
    
    $values = [
        "Habu", 90, 34, 70
    ];     
    
    $combined = array_combine($keys, $values);
    
  //  var_dump($combined);
    
    //array diff : returns elements that are in the frist array but bot in the second
    
    $names1 = ["Abc", "xyz", "klm"];
    $names2 = ["abc", "123", "ppp", "klm", "abc", "Abc"];
    
    //var_dump(array_diff($names2, $names1));
    
    //array flip: changes keys to values and values to keys
      
  //  var_dump(array_flip($std));
    
    //array POP removes top element
    
    // var_dump(  array_pop($names2));
    // var_dump($names2);
    
    //array_unshift($names2, "firstElement");//adds element at the begunning of the array
   // array_shift($names2, "firstElement");//removes the first element in the array
    
   // var_dump($names2);
    
    
    //Unique: removes duplicat values from an array
    
  //  var_dump(array_unique($names2));
    
    //array merge: merges otwo or more arrays into a larger one

    
   // var_dump(array_merge($names2, $names1));
    
     
    
    ?>

<hr/>

<h1>
    PHP String Functions
</h1>

<hr/>
<?php 
//string functions
//replace, 
//strpos,
//str_repeat($input, $multiplier)
//str_shuffle($str)
//str_split($string, $split_length)
//exploade and implode
//str_word_count($string, $format)
//strtotime($time)
//strpos, strlen, strtoupper($string)
//substr

$str1 = "Changchun University ";
//$str2 = " Jilin University ";

//echo str_replace("Changchun", "Jilin", $str1);
/*
    if  (strpos($str1, "University")) {
        echo " University exists in $str1";

    }
 * 
 */
    //str repaet
//echo str_repeat("Ouyang <br/> ", 10);

    $strToShuffle = "ABCDEFGHIabcdefghi1234567890";

    $shuffledStr =  str_shuffle($strToShuffle);
    
    $name1 = "zayyanu@gmail.com";
     
    
   $substr = substr($name1, 0,  strpos($name1, "@"));
   $substr2 = substr($name1, strpos($name1, "@")+1);
    
  //  echo $substr2 . " len is ". strlen($substr2);
   
   
   $names = "abcd;decfk;olpph;dfuu";
   
   //var_dump(str_split($names, 4));
   
   //Explode converst string to array
   var_dump(explode(";", $names));
   
   //implode converts an aarray to strin
   $names = ["abcd", "def", "jkl"];
   
   var_dump(implode("-", $names));
   
   echo strtolower("SENTENCE");
   
   $date = strtotime("Sun Aug 25, 2019");
   
   var_dump($date);

?>

</body>
</html>