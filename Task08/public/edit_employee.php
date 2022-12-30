<center>
<h1>Изменение персональных данных мастера</h1>

<?php
    $db = new PDO('sqlite:../data/barbershop.db');
    $employee_id = $_GET['id'];
    $query = "SELECT name, surname, specialization, percent FROM employee WHERE id='$employee_id'";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
    $employee = $rows[0];
?>

<form action="" method="post" action="index.php">
    <table width=800>
        <td><label>Имя: <input name="name" value=<?= $employee['name'] ?>></label></td>
        <td><label>Фамилия: <input name="surname" value=<?= $employee['surname'] ?>></label></td>
        <td>
        <fieldset>
            <label> Специализация</label>
            <p><label> <input type=radio name=specialization value="male"> мужчины </label></p>
            <p><label> <input type=radio name=specialization value="female"> женщины </label></p>
            <p><label> <input type=radio name=specialization value="universal"> универсал </label></p>
        </fieldset>
        </td>
        <td><label>Процентная ставка: <input name="percent" value=<?= $employee['percent'] ?>></label></td>
        <td><button type="submit">Сохранить изменения </button></td>
    </table>
</form>
<a href="../index.php">Вернуться на главную</a>
</center>

<?php
    if(isset($_POST['name'], $_POST['surname'], $_POST['percent'], $_POST['specialization']))
    {
        $update = $db->prepare("UPDATE employee SET name = :name, surname = :surname, specialization = :specialization, percent = :percent WHERE id = $employee_id");
        $update->bindValue(':name', $_POST['name']);
        $update->bindValue(':surname', $_POST['surname']);
        $update->bindValue(':percent', (int) $_POST['percent']);
        $update->bindValue(':specialization', $_POST['specialization']);
        $update->execute();
    }
?>