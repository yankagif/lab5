<?require_once 'engine/page/title.php';?>
<?require_once 'engine/connection/connectionStart.php';?>
<html>
    <body>
		<?
			if(isset($_GET['id'])&&isset($_GET['query'])){
                $id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));
                $index = htmlentities(mysqli_real_escape_string($link, $_GET['query']));
                switch($index){
                case "item":
                    $array = array("№", "name", "teacher", "faculty", "count_lecture", "count_lab");
                    $arrayTitle = array("№","Наименование", "Преподаватель", "Факультет", "Количество лекций", "Количество лабораторных");
                    $query = "SELECT * FROM $database.$index WHERE id='$id'";
                    $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    $rows = array();
                    echo("<legend><H2>Редактировать предмет:</H2></legend>");
                    echo("<form id='form' method='post' action='save_edit.php'>");
                    while ($row=mysqli_fetch_array($result)){
                        for($i = 0; $i < count($row)/2; $i++){
                            if($i == 0){
                                echo("<input type='hidden' name='id' value='$id'> <br>");
                            } else {
                                $ar =  $row[$i];
                                echo(" $arrayTitle[$i]: <input name='$array[$i]' size='50' type='text' value='$ar' maxlength='16'> <br>");
                            }
                        }
                    }
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    
                    echo("<input type='submit' value='Сохранить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                break;
                case "group":
                    $array = array("№", "name", "faculty");
                    $arrayTitle = array("№","Название", "Факультет");
                    $query = "SELECT * FROM $database.$index WHERE id='$id'";
                    $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    $rows = array();
                    echo("<legend><H2>Редактировать группу:</H2></legend>");
                    echo("<form id='form' method='post' action='save_edit.php'>");
                    while ($row=mysqli_fetch_array($result)){
                        for($i = 0; $i < count($row)/2; $i++){
                            if($i == 0){
                                print "<input type='hidden' name='id' value='$id'> <br>";
                            } else {
                                $ar =  $row[$i];
                                print " $arrayTitle[$i]: <input name='$array[$i]' size='50' type='text' value='$ar' maxlength='16'> <br>";
                            }
                        }
                    }
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    echo("<input type='submit' value='Сохранить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                break;
                case "exam_info":
                    $query_2 = "SELECT * FROM $database.$index WHERE id='$id'";
                    $index = "exam";
                    $queryTab_0 = "group";
                    $queryTab_1 = "item";
                    $query_0 = "SELECT * FROM $database.$queryTab_0 ORDER BY $database.$queryTab_0.id ASC";
                    $query_1 = "SELECT * FROM $database.$queryTab_1 ORDER BY $database.$queryTab_1.id ASC";
                    $result_2 = mysqli_query($link, $query_2) or die("Не могу выполнить запрос!");
                    $result_0 = mysqli_query($link, $query_0) or die("Не могу выполнить запрос!");
                    $result_1 = mysqli_query($link, $query_1) or die("Не могу выполнить запрос!");
                    $query = "SELECT * FROM $database.$index WHERE id='$id'";
                    $result = mysqli_query($link, $query) or die ("Ошибка в запросе");
                    
                    $rows = array();
                    while ($row=mysqli_fetch_array($result)){
                        $rows = $row;
                    }
                    
                    $rws = array();
                    while ($row=mysqli_fetch_array($result_2)){
                        $rws = $row;
                    }
                        
                    echo("<legend><H2>Изменить:</H2></legend>");
                    echo("<form id='form' method='post' action='save_edit.php'>");
                    
                    echo("<input type='hidden' name='id' value='$id'>");
                    $id_0 = "group_select";
                    echo("<label for='$id_0'>Список разрешенных характеристик: </label>");
                    echo("<select id='$id_0' name='$id_0'>");
                    echo("<option value=''>--Please choose an option--</option>");
                        
                    while ($row=mysqli_fetch_array($result_0)){
                        if($rws[1]==$row[1]){
                            echo("<option value='$row[0]' selected> $row[0]. $row[1]|$row[2] </option>");
                        } else{
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                    }
                    echo("</select><br>");
                    
                    $id_1 = "item_select";
                    echo("<label for='$id_1'>Список соответствующих значений: </label>");
                    echo("<select id='$id_1' name='$id_1'>");
                    echo("<option value=''>--Please choose an option--</option>");
                    
                    while ($row=mysqli_fetch_array($result_1)){
                        if($rws[2]==$row[1]){
                            echo("<option value='$row[0]' selected> $row[0]. $row[1]|$row[2] </option>");
                        } else{
                            echo("<option value='$row[0]'> $row[0]. $row[1]|$row[2]</option>");
                        }
                    }
                    echo("</select><br>");
                    
                    echo("Введите дата консультации: <input name='date_c' type='date' value='$rows[3]'/> <br>");
                    echo("Введите дата экзамена: <input name='date_e' type='date' value='$rows[4]'/> <br>");
                    echo("Введите аудиторию: <input name='audit' type='text' maxlength='6' value='$rows[5]'/> <br>");
                    
                    echo("<input type='hidden' name='index' value='$index'> <br>");
                    echo("<input type='submit' value='Добавить'/> <br>");
                    echo("</form>");
                    echo("</fieldset>");
                break;
                }
			}
		?>
	</body>
</html>
<?require_once 'engine/connection/connectionEnd.php';?>