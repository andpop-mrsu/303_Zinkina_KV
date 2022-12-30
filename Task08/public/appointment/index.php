<center>
<h1>Запись на прием</h1>

<?php
    $db = new PDO('sqlite:../../data/barbershop.db');
    $query = "SELECT id, name, price FROM services ORDER BY id";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
?>

<h2>Выберите услугу:</h2>
<form action="master_choice.php" method="POST">
<label>
    <select name="service_id">
        <?php foreach ($rows as $row):?>
        <option value= <?= $row['id']?>>
            <?= $row['name'] . ' ' . $row['price'] ?>
        </option>
        <?php endforeach;?>
    </select>
</label>
<button type="submit">OK</button>
</form>
<a href="../index.php">Вернуться на главную</a>
</center>