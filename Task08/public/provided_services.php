<center>
<h1>Оказанные услуги</h1>
<?php
    $db = new PDO('sqlite:../data/barbershop.db');
    $employee_id = $_GET['id'];
    $query = "SELECT a.date, a.time, s.name, s.price FROM employee INNER JOIN appointment a ON employee.id = a.employee_id INNER JOIN services s ON a.service_id = s.id WHERE employee.id = {$employee_id} and a.done = 'yes' ORDER BY a.date, a.time";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
?>
<table width=800>
    <tr> 
        <td>Услуга</td>
        <td>Дата</td>
        <td>Время</td>
        <td>Цена</td>
    </tr>
    <?php 
        foreach ($rows as $row) {?>
            <tr>
                <td> <?= $row['name'] ?> </td>
                <td> <?= $row['date'] ?> </td>
                <td> <?= $row['time'] ?> </td>
                <td> <?= $row['price'] ?> </td>
            </tr>
    <?php } ?> 
</table>
<a href="../index.php">Вернуться на главную</a>
</center>