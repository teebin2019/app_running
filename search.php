<?php

include_once 'connection.php';
try {
    // insert a row
    $id_card = $_POST['id_card'];
    // ค้นหาเลขประชาชนว่าซ้ำไหม
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
                  title: "ค้นหาเลขประชาชนนี้สำเร็จ",
                  type: "success"
              }, function() {
                  window.location = "edit.php?id_card=' . $id_card . '"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
        exit();
    } else {
        // sweet alert 
        echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <script>
             setTimeout(function() {
              swal({
                  title: "บัตรประชาชนนี้ไม่มีการลงทะเบียน",
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
