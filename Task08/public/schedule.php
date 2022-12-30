<center>
<h1>Расписание работника</h1>

<?php
    $db = new PDO('sqlite:../data/barbershop.db');
    $employee_id = $_GET['id'];
    $query = "SELECT date, begin_time, end_time FROM schedule WHERE employee_id ='$employee_id'";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
?>
<table width=800>
    <tr> 
        <td>Дата</td>
        <td>Начало рабочего дня</td>
        <td>Конец рабочего дня</td>
        <td>Сохранение</td>
        <td>Удаление</td>
    </tr>
    <?php 
        for ($i = 0; $i < count($rows); $i++) {?>
            <form method="post" action="schedule.php?id=<?=$employee_id?>">
                <tr>
                    <td> 
                        <input type=date name="date" value=<?= $rows[$i]['date'] ?>>
                    </td>
                    <td> 
                        <input type=time step=1 name="begin_time" value=<?= $rows[$i]['begin_time'] ?>>
                    </td>
                    <td> 
                        <input type=time step=1 name="end_time" value=<?= $rows[$i]['end_time'] ?>>
                    </td>
                    <td>
                        <button name="save" type="submit" value="save">Сохранить</button>
                    </td>
                    <td>
                        <button name="delete" type="submit" value="delete">Удалить</button>
                        <input type="hidden" name="index" value = <?=$i?>>
                    </td>
                </tr>
            </form>
    <?php } ?> 
</table>

<?php
    if ($_POST) {
        if (isset($_POST['save'])) {
            $update = $db->prepare("UPDATE schedule SET date = :date, begin_time = :begin_time, end_time = :end_time WHERE employee_id = :employee_id AND date = :old_date");
            $update->bindValue(':employee_id', $employee_id);
            $update->bindValue(':date', $_POST['date']);
            $update->bindValue(':begin_time', $_POST['begin_time']);
            $update->bindValue(':end_time', $_POST['end_time']);
            $update->bindValue(':old_date',$rows[$_POST['index']]['date']);
            $update->execute();
        } elseif (isset($_POST['delete'])) {
            $del = $db->prepare("DELETE FROM schedule WHERE employee_id=:employee_id AND date=:date");
            $del->bindValue(':employee_id', $employee_id);
            $del->bindValue(':date', $rows[$_POST['index']]['date']);
            $del->execute();
        }
    }
?>

<form method="post" action="add_working_day.php?id=<?=$employee_id?>">
    <button>Добавить рабочий день</button>
</form>
<a href="../index.php">Вернуться на главную</a>
</center>