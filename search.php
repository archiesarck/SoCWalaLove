<?php 

	$ser = $_POST['search'];			//string to be searched
			$mil_gya = array();				//array for search results

			$handle = fopen("courses.txt", "r");//opening connection with the file
			if($handle){

				while (!feof($handle)) {													//start search all over the file till EOF comes.
					$buffer = fgets($handle);			
					if(strpos($buffer, $ser)!==FALSE){
						$mil_gya[] = $buffer;	
						/*you can also use stristr function*/ 								//If matches found store in $mil_gya.
					}
				}
				fclose($handle);															//close connection
			}
			
			if(sizeof($mil_gya)!=0){
				foreach ($mil_gya as $k) {
					echo $k . "<br>";
				}
			}
			else echo "No courses found!";
?>