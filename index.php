
<html>
<head>
    <style>
        table,th,td{
            border: 1px solid black;
        }
    </style>
 </head> 
 <body>  
<?php
/**
 * Created by PhpStorm.
 * User: tarekulislam
 * Date: 3/9/15
 * Time: 3:52 PM
 */



//echo "hello";



//Make connection to to database
$connection = new mysqli("localhost","root","root","S1533608");//$server,$username,$password,$databaseName);

//Checking if connection successful
// if($connection->connect_error){
//     die("Not able to connect: ".$connection->connect_error);
// }

//Make and print the Goal table
$sql="SELECT * FROM list_of_goals";
$info=$connection->query($sql); //or die($mysqli_error());
#$ww="SELECT GID FROM list_of_goals";
#$retrieve=$connection->query($ww);

echo "<H1>Goals Table</H1>";
echo"<form action=editPage.php>";
echo "<table>";

echo "<tr><th>GID</th><th>Goal Statement</th><th>
            <input type=submit value=edit></th></tr>";




#echo $_POST["new1"];

$gid=0;          
while($row_fetch=mysqli_fetch_array($info)){
    
    $gid=$row_fetch['GID'];
    #echo $gid;
    $goals=$row_fetch['goals'];
    
    
    #echo $hold;
    
        
    if(isset($_POST['edit'.$gid])){
        if($_POST['edit'.$gid]=='editmode'){
            echo $hold=$_POST['bring'.$gid];
            echo $sql2 = "UPDATE list_of_goals SET goals='".$hold."' WHERE GID=".$gid;
            $connection->query($sql2);
            
            $goals=$hold;
            echo "<tr>";
            echo "<td>g".$gid."</td>";
            echo"<td>".$goals."</td>";
            echo "</tr>";



        }
        else if($_POST['edit'.$gid]=='asismode'){
            
            echo "<tr>";
            echo "<td>g".$gid."</td>";
            echo"<td>".$goals."</td>";
            echo "</tr>";
        }
        else if($_POST['edit'.$gid]=='delmode'){
            echo $sql3= "DELETE FROM list_of_goals WHERE GID=".$gid;
            $connection->query($sql3);
            echo $sql4= "DELETE FROM OID_GID WHERE GID=".$gid;
            $connection->query($sql4);

        }

    }
    else{
        
        
        echo "<tr>";
            echo "<td>g".$gid."</td>";
            echo"<td>".$goals."</td>";
            echo "</tr>";

        
    }


}
$gid++;

$more="SELECT * FROM list_of_goals"; 
$info2=$connection->query($more);

$newROW=0;
if(isset($_POST["new1"])){
    if($_POST["new1"]!="NEW GOAL HERE"){
                $counter=0;
                while($row_bring=mysqli_fetch_array($info2)){   
                    if($counter<$row_bring['GID']){
                        $counter=$row_bring['GID'];
                    }
                }
                $hold2=$_POST["new1"];
                echo $newROW=$counter+1;

                echo $hold2;
                $me="INSERT INTO `list_of_goals` (`GID`, `goals`) VALUES ('".$newROW."','" .$hold2."')";
                if(mysqli_query($connection,$me)){
                    echo "New record created successfully";
                    echo "<tr> 
                            <td>s".$gid."</td>
                            <td>".$hold2."</td>
                         </tr>";
                         $newROW++;

                }
                else{
                    echo "Error: " . $me . "<br>" . mysqli_error($connection);
                }

} 
}
$gid++;

if(isset($_POST["new2"])){
    if($_POST["new2"]!="NEW GOAL HERE"){
                
                $hold3=$_POST["new2"];
                //echo $newROW;

                //echo $hold3;
                $me2="INSERT INTO `list_of_goals` (`GID`, `goals`) VALUES ('".$newROW."','" .$hold3."')";
                if(mysqli_query($connection,$me2)){
                    echo "New record created successfully";
                    echo "<tr> 
                            <td>s".$gid."</td>
                            <td>".$hold3."</td>
                         </tr>";

                }
                else{
                    echo "Error: " . $me . "<br>" . mysqli_error($connection);
                }

} 
}




#echo $i;       


//Filling in the goal table







//finished table

echo "</table>";
echo "</form>";




//make and print the service table
$sql="SELECT * FROM list_of_services";
$info=$connection->query($sql);

echo "<H1>Services Table</H1>";
echo"<form action=Entire2.php method=post>";
echo "<table>";

echo "<tr>
        <th>SID</th>
        <th>Service Statement</th>
        <th>Objectives</th>
        <td></td>
      </tr>";

      

//Filling in the goal table
while($row_fetch=mysqli_fetch_array($info)) {
    $sid=$row_fetch['SID'];
    $serviceName=$row_fetch['Service_Name'];
     
    
    echo "<tr>";
            echo "<td>s".$sid."</td>
            <td>".$serviceName."</td>";

            echo "<td>";
            echo "<table>";
                echo "<tr>
                    
                    <th>OID</th>
                    <th>Objective Statement</th>
                    <th>g1</th>
                    <th>g2</th>
                    <th>g3</th>
                    <th>g4</th>
                    <th>g5</th>
                    <th>g6</th>
                    <th>g7</th>
                    <th>g8</th>
                    <th>g9</th>
                    <th>g10</th>
                    
                </tr>";    

                $find="SELECT * FROM SID_OID WHERE SID=$sid";
                $look=$connection->query($find);
                while($row_get=mysqli_fetch_array($look)){
                    
                    $oid=$row_get['OID'];
                    $find2="SELECT Objective_Statement FROM list_of_objectives WHERE $oid=OID";
                    $look2=$connection->query($find2);
                    echo "<tr>";   
                     
                     
                    $row_get2=mysqli_fetch_array($look2);
                    $obj=$row_get2['Objective_Statement'];
                            
                    if(isset($_POST['selected'.$oid])){
                        
                        if($_POST['selected'.$oid]=='updatemode'){
                            //echo "hello";
                            echo $box=$_POST['text'.$oid];
                            echo $new = "UPDATE list_of_objectives SET Objective_Statement='".$box."' WHERE OID=".$oid;
                            $connection->query($new);
                            for($i=1;$i<10;$i++){
                                if($_POST['g'.$i]=='on'){
                                    //$vari=$_POST['g'.$i];
                                    echo $new2="INSERT INTO OID_GID (OID,GID) VALUES (".$oid.",".$i.")";
                                    $connection->query($new2);
                                }
                                
                                    
                                

                            }
            
                            $obj=$box;
                            echo "<td>o".$oid."</td>";
                            echo "<td>".$obj."</td>";
                        }
                        else if($_POST['selected'.$oid]=='asis'){
            
                            //echo "<tr>";
                            echo "<td>o".$oid."</td>";
                            echo"<td>".$obj."</td>";
                            //echo "</tr>";
                        }
                        else if($_POST['selected'.$oid]=='del'){
                            echo $sq3= "DELETE FROM SID_OID WHERE OID=".$oid." AND SID=$sid";
                            $connection->query($sq3);
                            

                        }


                    }
                    
                    
                    else{
                        //echo "nooooo ";
                        echo "<td>o".$oid."</td>";
                        echo "<td>".$obj."</td>";
                    }

                    $find3="SELECT * FROM OID_GID WHERE $oid=OID";
                    $look3=$connection->query($find3);
            
                    $my_array=array();
                    while($row_get3=mysqli_fetch_array($look3)){
                        $found3=$row_get3['GID'];
                        if($found3==1){
                            array_push($my_array,$found3);
                        }
                        else if($found3==2){
                            array_push($my_array,$found3);
                        }
                        else if($found3==3){
                            array_push($my_array,$found3);
                    
                        }
                        else if($found3==4){
                            array_push($my_array,$found3);
                        }
                        else if($found3==5){
                            array_push($my_array,$found3);

                        }
                        else if($found3==6){
                            array_push($my_array,$found3);
                        }
                        else if($found3==7){
                            array_push($my_array,$found3);
                        }
                        else if($found3==8){
                            array_push($my_array,$found3);
                        }
                        else if($found3==9){
                            array_push($my_array,$found3);
                        }
                        else if($found3==10){
                            array_push($my_array,$found3);
                        }

                        
                        
                    }
                    
                    for($i=1;$i<10;$i++){
                        if(in_array($i, $my_array)){
                            echo "<td>";
                                echo "<p>&#10004;</p>";
                                echo "</td>";

                        }
                        else{
                            echo "<td></td>";
                        }
                    }

                    echo "</tr>";

                    
                    

                }
                echo "</tr>";

            echo "</table>";

                


                
             
            echo "</td>";
            echo "<td><input type=submit name=editIT value=edit".$sid."></td>";
          echo "</tr>";
}

//finished table

echo "</table>";
echo "</form>";




?>
</body>
</html>