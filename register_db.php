<?php

include_once 'connection.php';
try {

    // insert a row
    $id_card = $_POST['id_card'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $birth_day = $_POST['birth_day'];
    $prices = $_POST['price']; // เก็บเป็น array

    // prepare sql and bind parameters
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_card = :id_card");
    $stmt->bindParam(':id_card', $id_card);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        // sweet alert 
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <script>
             setTimeout(function() {
              swal({
                  title: "บัตรประชาชนนี้มีการลงทะเบียนแล้ว",
                  type: "error"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
        exit();
    }

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

    foreach ($prices as $price) {
        switch ($price) {
            case 100:
                $type = "วิ่งเดี่ยว";
                break;
            case 150:
                $type = "วิ่งคู่";
                break;
            case 200:
                $type = "วิ่งหลายคน";
                break;
            default:
                $type = "ไม่ระบุประเภทการวิ่ง";
        }

        // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO running_type (type ,id_card,	price	)
  VALUES (:type, :id_card ,  :price)");
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id_card', $id_card);
        $stmt->bindParam(':price', $price);

        $result = $stmt->execute();
    }

    // sweet alert 
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    if ($result) {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เพิ่มข้อมูลสำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    } else {
        echo '<script>
             setTimeout(function() {
              swal({
                  title: "เกิดข้อผิดพลาด",
                  type: "error"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
