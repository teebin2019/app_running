<?php

try {
    include_once 'connection.php';

    // insert a row
    $id_card = $_POST['id_card'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $birth_day = $_POST['birth_day'];

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO users (id_card,	f_name,	l_name,	age,	gender	,birth_day	)
  VALUES (:id_card, :f_name, :l_name , :age , :gender , :birth_day)");
    $stmt->bindParam(':id_card', $id_card);
    $stmt->bindParam(':f_name', $f_name);
    $stmt->bindParam(':l_name', $l_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':birth_day', $birth_day);

    $stmt->execute();

    echo "New records created successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
