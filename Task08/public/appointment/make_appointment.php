<?php
$db = new PDO('sqlite:../../data/barbershop.db');
$employee_id = $_POST['employee_id'];
$service_id = $_POST['service_id'];
$rowid = $_POST['rowid'];

$query = "SELECT date, begin_time FROM schedule WHERE rowId ='$rowid'";
$statement = $db->query($query);
$rows = $statement->fetchAll();
$date = $rows[0]['date'];
$time = $rows[0]['begin_time'];

$insert = $db->prepare("INSERT INTO appointment(employee_id, service_id, date, time) values (:employee_id, :service_id, :date, :time);");
$insert->bindValue(':employee_id', $employee_id);
$insert->bindValue(':service_id', $service_id);
$insert->bindValue(':date', $date);
$insert->bindValue(':time', $time);
$insert->execute();

$query = "DELETE FROM schedule WHERE rowId = '$rowid'";
$statement = $db->prepare($query);
$statement->execute();

?>
<center>
<h1>Вы записаны на прием.</h1>
<a href="../index.php">Вернуться на главную</a>
</center>