<center>
<h1>Добавление рабочего дня</h1>

<?php
    $db = new PDO('sqlite:../data/barbershop.db');
    $employee_id = $_GET['id'];
?>

<form method="post" action="add_working_day.php?id=<?=$employee_id?>">
    <table width=800>
        <tr> 
            <td>Дата</td>
            <td>Начало рабочего дня</td>
            <td>Конец рабочего дня</td>
        </tr>
        <tr>
            <td> 
                <input type=date name="date" ?>>
            </td>
            <td> 
                <input type=time step=1 name="begin_time" ?>>
            </td>
            <td> 
                <input type=time step=1 name="end_time" ?>>
            </td>
        </tr>
    </table>
    <button type="submit">Добавить</button>
</form>

<?php
if(isset($_POST['date'], $_POST['begin_time'], $_POST['end_time']))
{
    $insert = $db->prepare("INSERT INTO 'schedule' ('employee_id', 'date', 'begin_time', 'end_time' ) VALUES (:employee_id, :date, :begin_time, :end_time)");
    $insert->bindValue(':employee_id', $employee_id);
    $insert->bindValue(':date', $_POST['date']);
    $insert->bindValue(':begin_time', $_POST['begin_time']);
    $insert->bindValue(':end_time', $_POST['end_time']);
    $insert->execute();
}
?>
<a href="../index.php">Вернуться на главную</a>
</center>