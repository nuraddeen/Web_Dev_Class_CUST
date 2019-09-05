<html> 
    <head>
        <title>
            CUST Web Dev Class | PHP Class 2 Arrays
        </title>
    </head>
<body> 

<h1> welcome to my site </h1>

<?php 
	echo "<h1> PHP Arrays </h1> <br/> ";
	
        //declare only
        
        $emptyArray = [];
       $emptyArray = array();
        
        var_dump($emptyArray);
        
        //declaring and initializing
       // $names = ["name", "name2", "name3", 34, 45.6, true];
        $names = array ("name1", "name2", "name3", 34, 45.6, true);
        
        //accessing elements
        
        echo "second element is ".$names[1];
        
        //adding elements 
        //using index (if the index exists, the val will be overidden) else it it wil put the new element  at the top
        $names [10] = "AnotherName";
       //without index
        
        $names[] = "YetANotherName";
        
      
        
        //overriding Same as above
        $names[0] = "NewName1";
  
        
        //adding elemtnst at some position
         array_unshift($names, "name1 at begining");  
         
         //ARRAY BUILT_IN  FUNCTIONS
         
         //getting length (array size)
         
         echo "<h1> array size is ".count($names). "</h1> ";
         
         //getting if an element exists in array
        
         if(in_array("34", $names)) {
             echo "34 is in the array <br/> ";
         }
       // var_dump($names);
         
         //array tarversing
         
         $newArray = [];
         
         for ($index = count($names)-1; $index >= 0 ; $index--) {
           //  echo "<br/> element at index $index is ". $names[$index];
             
             $newArray [] = $names[$index];
         }
         
       //  var_dump($names);
       //  var_dump($newArray);
         
         //ARRAY TYPES
         
         //multi dimensional array
         
    $students = [
        ["Ali", 30, 15, 50],
        ["Habu", 20, 10, 40],
        ["Jaja", 41, 25, 80],
    ];     
    
    //accessing single 
    
    //echo "<br/> Jaja's CA1 is ".$students[2][1];
         
    //tarevrsing
    
    $students [2][0] = "PUKK";
    for ($mainIndex =0; $mainIndex< count($students); $mainIndex++) {
        
        for ($secIndex = 0; $secIndex < count($students[$mainIndex]); $secIndex++) {
            echo " ". $students[$mainIndex][$secIndex];
        }
        
        echo " <br/> ";
    }
    
    //associative arrays
    
    $stds = ["name" => "Ali", "CA1" => 20, "CA2" => 30, "Exam" => 90];
    
    echo " <br/> std name ". $stds["CA1"];
         
?>

</body>
</html>