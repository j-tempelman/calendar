<?php
require(ROOT . "model/BirthdayModel.php");
function index(){
	$data = getDataList();
	
	render('calendar/index', array("datas" => $data));
}

function add() 
{
	if(isset($_POST["person"]) && !empty($_POST["person"]))
	{
		$data=array();
		$data['person']= $_POST['person'];
		$data['day']= $_POST['day'];
		$data['month']= $_POST['month'];
		$data['year']= $_POST['year'];

		addBirthday($data);

		header("Location: /birthday");
	}
	else 
	{
		echo 'Vul alle velden in';	
	}
}

function edit($id)
{
	render('calendar/edit', array('person' => getPerson($id)
	));
}

function save() 
{
	$id = $_POST['id'];
	$person = $_POST['person'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];

	$result = saveChanges($id, $person, $day, $month, $year);

	header('location: /birthday');

}

function remove($person)
{

	$result = deletePerson($person);

	if($result == "Successfully")
	{
		header('location: /birthday');
	}

}

?>