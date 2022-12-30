<center>
<h1>Запись на прием</h1>

<?php
    $db = new PDO('sqlite:../../data/barbershop.db');
    $service_id = $_POST['service_id'];
    $query = "SELECT id, name, surname FROM employee WHERE status = 'works' and (specialization = (SELECT gender FROM services WHERE id = '$service_id') or specialization = 'universal') ORDER BY id";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
?>

<h2>Выберите мастера:</h2>
<form action="datetime_choice.php" method="POST">
<label>
    <select name="employee_id">
        <?php foreach ($rows as $row):?>
        <option value= <?= $row['id']?>>
            <?= $row['name'] . ' ' . $row['surname'] ?>
        </option>
        <?php endforeach;?>
    </select>
</label>
<input type="hidden" name="service_id" value = <?=$service_id?>>
<button type="submit">OK</button>
</form>
<a href="../index.php">Вернуться на главную</a>
</center>