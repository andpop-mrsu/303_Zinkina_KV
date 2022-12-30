<?php
$db = new PDO('sqlite:barbershop.db');

$query = "SELECT id, name, surname FROM employee ORDER BY id";
$statement = $db->query($query);
$rows = $statement->fetchAll();

echo "Enter master's id or press enter:\n";
foreach ($rows as $row) {
    echo $row['id'] . ' ' . $row['name'] . ' ' . $row['surname'] . "\n";
}
$employee_id = readline();
$number_is_valid = false;
foreach ($rows as $row) {
    if ($row['id'] == $employee_id){
        $number_is_valid = true;
    }
}
if ($employee_id == '') {
    $number_is_valid = true;
}

if (!$number_is_valid) {
    echo "The number isn't valid.";
}
else if ($employee_id == '') {
    $query = "SELECT employee.id, employee.name, employee.surname, appointment.date, appointment.time, services.name as service_name, services.price FROM employee INNER JOIN appointment ON employee.id = appointment.employee_id INNER JOIN services ON appointment.service_id = services.id where appointment.done = 'yes' ORDER BY employee.surname, appointment.date, appointment.time";
    $statement = $db->query($query);
    $rows = $statement->fetchAll();
    foreach ($rows as $row) {
        echo $row['id'] . ' ' . $row['name'] . ' ' . $row['surname'] . ' ' . $row['date'] . ' ' . $row['time'] . ' ' . $row['service_name'] . ' ' . $row['price'] . "\n";
    }
}
else {
    $query = "SELECT employee.id, employee.name, employee.surname, appointment.date, appointment.time, services.name as service_name, services.price FROM employee INNER JOIN appointment ON employee.id = appointment.employee_id INNER JOIN services ON appointment.service_id = services.id where employee.id = :id and appointment.done = 'yes' ORDER BY employee.surname, appointment.date, appointment.time";
    $statement = $db->prepare($query);
    $statement->execute(['id' => $employee_id]);
    $rows = $statement->fetchAll();
    foreach ($rows as $row) {
        echo $row['id'] . ' ' . $row['name'] . ' ' . $row['surname'] . ' ' . $row['date'] . ' ' . $row['time'] . ' ' . $row['service_name'] . ' ' . $row['price'] . "\n";
    }
}