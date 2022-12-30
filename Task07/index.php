<?php
$db = new PDO('sqlite:barbershop.db');

$query = "SELECT id, name, surname FROM employee ORDER BY id";
$statement = $db->query($query);
$rows = $statement->fetchAll();
?>
<center>
<h1>Select a master:</h1>
<form action="" method="POST">
<label>
    <select name="id">
        <option value = 0>All</option>
        <?php foreach ($rows as $row):?>
        <option value= <?= $row['id']?>>
            <?= $row['id'] . ' ' . $row['name'] . ' ' . $row['surname'] ?>
        </option>
        <?php endforeach;?>
    </select>
</label>
<button type="submit">OK</button>
</form>
<?php
    $employee_id = -1;
    if(isset($_POST['id']) )
    {
        $employee_id = (int) $_POST['id'] ;
    }
    if ($employee_id == 0){
        $query = "SELECT employee.id, employee.name, employee.surname, appointment.date, appointment.time, services.name as service_name, services.price FROM employee INNER JOIN appointment ON employee.id = appointment.employee_id INNER JOIN services ON appointment.service_id = services.id where appointment.done = 'yes' ORDER BY employee.surname, appointment.date, appointment.time";
    }
    else {
        $query = "SELECT employee.id, employee.name, employee.surname, appointment.date, appointment.time, services.name as service_name, services.price FROM employee INNER JOIN appointment ON employee.id = appointment.employee_id INNER JOIN services ON appointment.service_id = services.id where employee.id = {$employee_id} and appointment.done = 'yes' ORDER BY employee.surname, appointment.date, appointment.time";
    }
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
?>
<?php if ($employee_id != -1): ?>
<table width=800>
    <tr> 
        <td>id</td>
        <td>name</td>
        <td>surname</td>
        <td>date</td>
        <td>time</td>
        <td>service_name</td>
        <td>price</td>
    </tr>
    <?php foreach ($rows as $row):?>
    <tr>
        <td> <?= $row['id'] ?> </td>
        <td> <?= $row['name'] ?> </td>
        <td> <?= $row['surname'] ?> </td>
        <td> <?= $row['date'] ?> </td>
        <td> <?= $row['time'] ?> </td>
        <td> <?= $row['service_name'] ?> </td>
        <td> <?= $row['price'] ?> </td>
    </tr>
    <?php endforeach;?>
</table>
<?php endif; ?>
</center>