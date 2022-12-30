<center>
<h1>Вы действительно хотите удалить этого работника?</h1>
<?php
    $employee_id = $_GET['id'];
?>
<form method="post" action="dismiss.php">
    <input type="hidden" name="employee_id" value=<?= $employee_id ?>>
    <button>Да</button>
</form>
<form method="post" action="../index.php">
    <button>Отмена</button>
</form>
</center>