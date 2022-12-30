<center>
<h1>Запись на прием</h1>

<?php
    $db = new PDO('sqlite:../../data/barbershop.db');
    $service_id = $_POST['service_id'];
    $employee_id = $_POST['employee_id'];
    $query = "SELECT rowId, date, begin_time, end_time FROM schedule WHERE employee_id ='$employee_id'";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
?>

<h2>Выберите время:</h2>
<form action="make_appointment.php" method="POST">
<label>
    <select name="rowid">
    <?php 
    for ($i = 0; $i < count($rows); $i++) {?>
        <option value= <?= $rows[$i]['rowid']?>>
            <?= $rows[$i]['date'] . ' ' . $rows[$i]['begin_time'] ?>
        </option>
    <?php } ?> 
    </select>
</label>
<input type="hidden" name="service_id" value = <?=$service_id?>>
<input type="hidden" name="employee_id" value = <?=$employee_id?>>
<button type="submit">OK</button>
</form>
<a href="../index.php">Вернуться на главную</a>
</center>