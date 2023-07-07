<?
require_once('views/header.php');
require_once('model/model.php');
?>

<style>
table {
	border: 1px solid black;
}
td {
	border: 1px solid black
}
</style>
   
   <h1> Журнал заметок  </h1>

		<form action="controller/add.php" method="POST">
			 Ваше имя:<input type="text" name="name"> <br />
			 заметка: <br />
			<textarea name="textarea" cols="60" rows="5" /> </textarea> 
			<input type="submit" name="doAdd" value="Добавить">
		</form>
		
<? 
$getNotes = f_getNotes(); 

$all = count($getNotes);
$pages = ceil($all/10);
$i = $_GET['i']??$pages;
$j = 0;
$k = 0;
//if($i > 1) $first = 

$last = $i*10;
$first = $last - 9;



echo "<table style=''>";
echo "<tr> <td> num </td> <td> id_note </td> <td> user_name </td> <td> note </td></tr>";

foreach($getNotes as $column)
{
 
 if($j >= $first && $j <= $last)
 {	 
	echo "<tr>";
	//echo '<p>' .  $column["id_note"] . $column["user_name"] . $column['note']  . '<br />' . '</p>';
	echo  '<td>' .  $k . '</td>' . '<td>' .  $column["id_note"] . '</td>' .  '<td>' .  $column["user_name"] . '</td>' . '<td>' .  $column['note'] . '</td>';
	echo "<td> <a href='controller/del.php?id=" . $column["id_note"] . "'> Удалить </a> </td>";
	echo "</tr>";
 }	
  $j++;
  $k++;
}
echo "</table>";

for($i=1;$i<=$pages;$i++)
{
	echo "<a href='index.php?i=" . $i . "'>" . $i .  " </a>";
}

require_once('views/footer.php')
?> 
