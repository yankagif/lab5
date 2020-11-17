<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
			if(isset($_GET['Index'])){
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['Index']));
                switch($index){
                    case "item":
                        echo("<legend><H2>Добавить новый предмет:</H2></legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите наименование: <input name='name' type='text' maxlength='16'/> <br>");
                        echo("Введите преподавателя: <input name='teacher' type='text' maxlength='16'/> <br>");
                        echo("Введите факультет: <input name='faculty' type='text' maxlength='16'/> <br>");
                        echo("Введите количество лекций : <input name='count_lecture' type='number'min='2' max='1000' value='2'/> <br>");
                        echo("Введите количество лабораторных : <input name='count_lab' type='number' min='2' max='1000' value='2'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "group":
                        echo("<legend><H2>Добавить новую группу:</H2></legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        echo("Введите наименование: <input name='name' type='text' maxlength='16'/> <br>");
                        echo("Введите факультет: <input name='faculty' type='text' maxlength='16'/> <br>");
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                    case "exam":
                        $queryTab_0 = "group";
                        $queryTab_1 = "item";
                        $query_0 = "SELECT * FROM $database.$queryTab_0 ORDER BY $database.$queryTab_0.id ASC";
                        $query_1 = "SELECT * FROM $database.$queryTab_1 ORDER BY $database.$queryTab_1.id ASC";
                        $result_0 = mysqli_query($link, $query_0) or die("Не могу выполнить запрос!");
                        $result_1 = mysqli_query($link, $query_1) or die("Не могу выполнить запрос!");
                        echo("<legend><H2>Добавить расписание экзаменов:</H2></legend>");
                        echo("<form id='form' method='post' action='save_new.php'>");
                        $id_0 = "group_select";
                        echo("<label for='$id_0'>Список групп: </label>");
                        echo("<select id='$id_0' name='$id_0'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_0)){
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                        echo("</select><br>");
                        $id_1 = "item_select";
                        echo("<label for='$id_1'>Список предметов: </label>");
                        echo("<select id='$id_1' name='$id_1'>");
                        echo("<option value=''>--Please choose an option--</option>");
                        while ($row=mysqli_fetch_array($result_1)){
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                        echo("</select><br>");
                        
                        echo("Введите дата консультации: <input name='date_c' type='date'/> <br>");
                        echo("Введите дата экзамена: <input name='date_e' type='date'/> <br>");
                        echo("Введите аудиторию: <input name='audit' type='text' maxlength='6' /> <br>");
                        
                        echo("<input type='hidden' name='index' value='".$index."'> <br>");
                        echo("<input type='submit' value='Добавить'/> <br>");
                        echo("</form>");
                        echo("</fieldset>");
                    break;
                }
			   
			}
		?>
		
		<a href="index.php"> Вернуться к списку </a> 
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>