
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

echo "<H1>Goals Table</H1>";
echo "<form action=index.php method=post>";

echo "<table>";

echo "<tr><th>GID</th><th>Goal Statement</th><td><input type=submit name=submit></td></tr>";



$gid=0;
//Filling in the goal table
while($row_fetch=mysqli_fetch_array($info,MYSQLI_BOTH)) {
    $gid=$row_fetch['GID'];
    $goals=$row_fetch['goals'];

        
        echo "<tr>";
        echo "<td>s".$gid."</td>";
        echo "<td><textarea name=bring".$gid." cols=85 row=15 maxlength=100>$goals</textarea></td>";


        $i++;
        


        
        echo "<td>
        <input type=radio name=edit".$gid." value=asismode checked=checked>as-is
        <input type=radio name=edit".$gid." value=editmode>update
        <input type=radio name=edit".$gid." value=delmode>delete


        

        </td>";


            

            
        echo "</tr>";
        
    }
    $gid++;
    echo "<tr>";
    echo "<td>s".$gid."</td>";
    echo "<td><textarea name=new1 cols=85 row=15 maxlength=100>NEW GOAL HERE</textarea></td>";
    echo "</tr>";

    $gid++;
    
    echo "<tr>";
    echo "<td>s".$gid."</td>";
    echo "<td><textarea name=new2 cols=85 row=15 maxlength=100>NEW GOAL HERE</textarea></td>";
    echo "</tr>";





//finished table

echo "</table>";
echo "</form>";














//make and print the service table
$sql="SELECT * FROM list_of_services";
$info=$connection->query($sql);

echo "<H1>Services Table</H1>";
echo "<table>";

echo "<tr>
        <th>SID</th>
        <th>Service Statement</th>
      </tr>";

//Filling in the goal table
while($row_fetch=mysqli_fetch_array($info)) {
    $sid=$row_fetch['SID'];
    $serviceName=$row_fetch['Service_Name'];
    echo "<tr>
            <td><a href=entire2.php?serviceID=$sid>s".$sid."</td>
            <td>".$serviceName."</td>
          </tr>";
}

//finished table

echo "</table>";




?>
</body>
</html>