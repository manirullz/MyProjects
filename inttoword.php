<?php
//
//    function convertNumberToWordsForIndia($number){
//        //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
//        $words = array(
//        '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
//        '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
//        '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
//        '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
//        '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
//        '80' => 'eighty','90' => 'ninty');
//        
//        //First find the length of the number
//        $number_length = strlen($number);
//        //Initialize an empty array
//        $number_array = array(0,0,0,0,0,0,0,0,0);        
//        $received_number_array = array();
//        
//        //Store all received numbers into an array
//        for($i=0;$i<$number_length;$i++){    $received_number_array[$i] = substr($number,$i,1);    }
//
//        //Populate the empty array with the numbers received - most critical operation
//        for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ $number_array[$i] = $received_number_array[$j]; }
//        $number_to_words_string = "";        
//        //Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
//        for($i=0,$j=1;$i<9;$i++,$j++){
//            if($i==0 || $i==2 || $i==4 || $i==7){
//                if($number_array[$i]=="1"){
//                    $number_array[$j] = 10+$number_array[$j];
//                    $number_array[$i] = 0;
//                }        
//            }
//        }
//        
//        $value = "";
//        for($i=0;$i<9;$i++){
//            if($i==0 || $i==2 || $i==4 || $i==7){    $value = $number_array[$i]*10; 
//			// if($i==4 && $value!=0){    $number_to_words_string.= "Thousand "; }
//			// if($i==2 && $value!=0){    $number_to_words_string.= "Lakhs  "; }
//			}
//            else{ $value = $number_array[$i];    }            
//            if($value!=0){ $number_to_words_string.= $words["$value"]." "; }
//            if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
//            if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";  }
//           // if($i==4 && $value==0){    $number_to_words_string.= "Thousand "; }
//			if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
//            if($i==6 && $value!=0){    $number_to_words_string.= "Hundred  "; }
//			//if($i==2 && $value==0){    $number_to_words_string.= "Lakhs  "; }
//        }
//        if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
//        return ucwords(strtolower("".$number_to_words_string)." Only");
//    }
//
//   echo convertNumberToWordsForIndia("78547627");
//    echo "<br/>";
    //Output ==> Indian Rupees Ninty Eight Crores Seventy Six Lakhs Fifty Four Thousand Three Hundred & Twenty One Only.
	
/**************NO TO WORD IN NEW*************************/	
	
	$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fourteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
function no_to_words($no)
{    global $words;
    if($no == 0)
        return ' ';
    else {           $novalue='';$highno=$no;$remainno=0;$value=100;$value1=1000;        
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }        
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
          else { 
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;             
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
           }
    }
}
//echo no_to_words(145524585);
?>