<center>
<h1>Добавить работника</h1>
<?php
    $db = new PDO('sqlite:../data/barbershop.db');
?>
<form action="" method="post" action="add_employee.php">
    <p><label>Имя: <input name="name"></label></p>
    <p><label>Фамилия: <input name="surname"></label></p>
    <p><label>Процентная ставка: <input name="percent"></label></p>
    <fieldset>
        <h3><label> Специализация</label></h3>
        <p><label> <input type=radio name=specialization value="male"> мужчины </label></p>
        <p><label> <input type=radio name=specialization value="female"> женщины </label></p>
        <p><label> <input type=radio name=specialization value="universal"> универсал </label></p>
    </fieldset>
    <p><button type="submit">Добавить работника</button></p>
</form>
<a href="../index.php">Вернуться на главную</a>
</center>

<?php
if(isset($_POST['name'], $_POST['surname'], $_POST['percent'], $_POST['specialization']))
{
    $insert = $db->prepare("INSERT INTO 'employee' ('name', 'surname', 'specialization', 'percent' ) VALUES (:name, :surname, :specialization, :percent)");
    $insert->bindValue(':name', $_POST['name']);
    $insert->bindValue(':surname', $_POST['surname']);
    $insert->bindValue(':specialization', $_POST['specialization']);
    $insert->bindValue(':percent', (int) $_POST['percent']);
    $insert->execute();
}
?>