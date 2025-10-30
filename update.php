<?php
include_once 'connection.php';

try {
    // รับค่าจากฟอร์ม
    $id_card = $_POST['id_card'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $birth_day = $_POST['birth_day'];
    $prices = $_POST['price'] ?? []; // ป้องกันกรณีไม่ได้เลือกอะไรเลย

    // ✅ แก้ไขข้อมูลผู้ใช้
    $stmt = $conn->prepare("
        UPDATE users 
        SET f_name = :f_name, 
            l_name = :l_name, 
            age = :age, 
            gender = :gender, 
            birth_day = :birth_day 
        WHERE id_card = :id_card
    ");
    $stmt->execute([
        ':f_name' => $f_name,
        ':l_name' => $l_name,
        ':age' => $age,
        ':gender' => $gender,
        ':birth_day' => $birth_day,
        ':id_card' => $id_card,
    ]);

    // ✅ ลบข้อมูลเก่าก่อน
    $stmt = $conn->prepare("DELETE FROM running_type WHERE id_card = :id_card");
    $stmt->execute([':id_card' => $id_card]);

    // ✅ เพิ่มข้อมูลใหม่
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

        $stmt = $conn->prepare("
            INSERT INTO running_type (type, id_card, price)
            VALUES (:type, :id_card, :price)
        ");
        $stmt->execute([
            ':type' => $type,
            ':id_card' => $id_card,
            ':price' => $price
        ]);
    }

    // ✅ แสดง SweetAlert ตามผลลัพธ์
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    ';

    echo '<script>
        setTimeout(function() {
            swal({
                title: "บันทึกข้อมูลสำเร็จ!",
                type: "success"
            }, function() {
                window.location = "index.php";
            });
        }, 1000);
    </script>';

} catch (PDOException $e) {
    echo '
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    ';
    echo '<script>
        setTimeout(function() {
            swal({
                title: "เกิดข้อผิดพลาด: ' . addslashes($e->getMessage()) . '",
                type: "error"
            }, function() {
                window.location = "edit.php?id_card=' . $id_card . '";
            });
        }, 1000);
    </script>';
}

$conn = null;
?>
