
<?php
function f_pdoConnect() {         // Но лучше возвращать тип PDO
		static $db;                   // объявление $db
		if($db===null) {              // если небыло коннекта    
			try {        
				// для сервера
				// локально
				$db = new PDO('mysql:host=localhost;dbname=dbnotes','root','',[
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
				]); 
				$db->exec('SET NAMES UTF8');	 
				//echo "<br /> Успешное подключение <br />";  
			} catch (PDOException $e) {
				echo '<br /> Подключение не удалось: ' . $e->getMessage();
				return  $e->getMessage(); //->getMessage();
			}	 
		} 
		return $db;   
	}

// Выбрать все заметки	
	function f_getNotes():array {
		$db = f_pdoConnect();  
		$arrAkkords = [];
		$sql        = "SELECT * FROM notes";
		$strResult  = $db->query($sql);
		$arrResult  = $strResult->fetchAll();	
		return($arrResult);  
	}	

// функция добавляет массив пользовательских сообщений в базу
	function f_blInsertNote($strName,$strNote):bool {
    //------------------------------ 'Сергей','Молодец' 
		$db  = f_pdoConnect();
		//проверка на теги
		$strName = htmlspecialchars($strName);
		$strNote = htmlspecialchars($strNote);
		
		$sql = "INSERT INTO Notes (user_name,note) VALUES ('" . $strName . "',' " .$strNote ."') "; 
		try { 
			$db -> exec($sql);    
			// echo "<br /> Успешно добавлено <br />";
			return true;        
		} catch (Exception $e) { // Отловить ошибку PDO
			echo "<br /> Ошибка добавления <br /> $e";
			return false;
		}

	}  

	
// Функция удаляет заметки из базы данных
	function f_blDelNote($strId): bool {
		$db  = f_pdoConnect();
		$sql = "DELETE FROM Notes WHERE id_note = $strId";
		try { // пытаемся выполнить запрос
			$db -> exec($sql);     // POD запрос
			echo "<br />  удалены предыдущие аккорды";
			return true;           // выводим true;
		} catch (Exception $e) { // Отловить ошибку PDO
			echo "<br /> Ошибка удаления <br />";
			return false;
		}
    
	}
		
	