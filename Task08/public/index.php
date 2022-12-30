<?php
$db = new PDO('sqlite:../data/barbershop.db');

$query = "SELECT id, name, surname, specialization FROM employee WHERE status = 'works' ORDER BY surname";
$statement = $db->query($query);
$rows = $statement->fetchAll();
?>
<center>
<h1>Мастера:</h1>
<table width=800>
    <tr> 
        <td>Номер</td>
        <td>Имя</td>
        <td>Фамилия</td>
        <td>Специализация</td>
    </tr>
    <?php foreach ($rows as $row):?>
    <tr>
        <td> <?= $row['id'] ?> </td>
        <td> <?= $row['name'] ?> </td>
        <td> <?= $row['surname'] ?> </td>
        <td> <?= $row['specialization'] ?> </td>
        <td> <a href="edit_employee.php?id=<?= $row['id']?>">Редактировать</a> </td>
        <td> <a href="delete_employee.php?id=<?= $row['id']?>">Удалить</a> </td>
        <td> <a href="schedule.php?id=<?= $row['id']?>">График</a> </td>
        <td> <a href="provided_services.php?id=<?= $row['id']?>">Выполненные работы</a> </td>
    </tr>
    <?php endforeach;?>
</table>
<form method="post" action="add_employee.php">
    <button>Добавить работника</button>
</form>
<form method="post" action="appointment/">
    <button>Запись на прием</button>
</form>
</center>