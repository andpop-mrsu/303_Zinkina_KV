<?php
$db = new PDO('sqlite:../data/barbershop.db');
$employee_id = $_POST['employee_id'];
$query = "UPDATE employee SET status = 'dismissed' WHERE id = $employee_id;";
$statement = $db->prepare($query);
$statement->execute();
?>
<center>
<h1>Данные о рабочем удалены</h1>
<a href="../index.php">Вернуться на главную</a>
</center>