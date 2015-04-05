<html>
	<head>
		<style>
			table,th,td{
				border:1px solid black;
			}
		</style>	
	</head>
	<body>
		<?php
		$server="localhost";
		$username="root";
		$password="root";
		$databaseName="S1533608"; 

		$connection=new mysqli($server,$username,$password,$databaseName);
		
		$empVar;
		for($i=1;$i<31;$i++){
			if($_POST['editIT']=="edit".$i){
				 $empVar=$i;
			}
		}
		
		$sql="SELECT * FROM SID_OID WHERE SID=$empVar";

		$result=$connection->query($sql);
		

		$sql2="SELECT Service_Name FROM list_of_services WHERE SID=$empVar";
		$do=$connection->query($sql2);
		while($fetch=mysqli_fetch_array($do)){
			$holder=$fetch['Service_Name'];
		}

		echo "<H1>
				Objectives of [s".$empVar.":".$holder."]

			 </H1>";
		echo "<form action=index.php method=post>";
		echo "<table>";
		echo "<tr>
				<th>OID</th>
				<th>Objective Statement</th>
				<th>Associated Goals</th>
				<td><input type=submit name=submit></td>
			</tr>";		 
		
		while($row_fetch=mysqli_fetch_array($result)){
			echo "<tr>";
			$p=$row_fetch['OID'];
			$query="SELECT Objective_Statement FROM list_of_objectives WHERE $p=OID";
			$result2=$connection->query($query);
			echo "<td>o".$p."</td>";

			while($row_fetch2=mysqli_fetch_array($result2)){
				$p2=$row_fetch2['Objective_Statement'];
			}

			
			echo "<td><textarea name=bring".$p2." cols=85 row=15 maxlength=100>$p2</textarea></td>";

			$query2="SELECT GID FROM OID_GID WHERE OID=$p";
			$result3=$connection->query($query2);
			
			
			$arrayGID=array();
			while($row_fetch3=mysqli_fetch_array($result3)){
				
				$p3=$row_fetch3['GID'];
				array_push($arrayGID,$p3);
				
				
			}
			echo $arrayGID;
			echo "<td>";
			print_r($arrayGID);
			for($i=1;$i<11;$i++){

				/*if(in_array($i, $arrayGID)){
					echo $i;
					echo "<input type=checkbox name=s".$i." checked>";

				}
				else{
					echo "<input type=checkbox name=s".$i.">";

				}*/
			}

			echo "</td>";


			echo "</tr>"; 
						

		}
		
		echo "</table>";
		echo "</form>";		



		

		?>
	</body>