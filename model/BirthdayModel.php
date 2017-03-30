<?php
function getDataList(){
	$db = openDatabaseConnection();
	
	$query = $db->prepare("SELECT * FROM birthdays ORDER BY month, day");
	
	$query->execute();
	
	return $query->fetchAll();
	
};

function addBirthday($data){
	 $db = openDatabaseConnection();

	 $query = $db->prepare('INSERT INTO birthdays (`person`, `day`, `month`, `year`) 
	 VALUES (:person, :day, :month, :year)');

	 $query->bindParam(':person', $data['person']);
	 $query->bindParam(':day', $data['day']);
	 $query->bindParam(':month', $data['month']);
	 $query->bindParam(':year', $data['year']);

	 $query->execute();

};

function getPerson($id) 
{
	$db = openDatabaseConnection();

	$query = $db->prepare("SELECT * FROM `birthdays` WHERE `id` = (:id)");
	$query->bindParam(':id', $id);

	$query->execute();

	return $query->fetch(PDO::FETCH_ASSOC);


}

function saveChanges($id, $person, $day, $month, $year)
{

	$db = openDatabaseConnection();

	$query = $db->prepare('UPDATE birthdays SET `person` = (:person),`day` = (:day),`month` = (:month),`year` = (:year) WHERE `id` = (:id)');

	$query->bindParam(':id', $id);
	$query->bindParam(':person', $person);
	$query->bindParam(':day', $day);
	$query->bindParam(':month', $month);
	$query->bindParam(':year', $year);

	$query->execute();

}

function deletePerson($id) 
{
	$db = openDatabaseConnection();

	$sql = "DELETE FROM `birthdays` WHERE `id` = (:id)";

	$stmt = $db->prepare($sql);

	$stmt->bindParam(':id', $id);

	$stmt->execute();

	$db = null;

	return "Successfully";

}
?>