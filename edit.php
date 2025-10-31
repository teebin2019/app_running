<?php
include_once 'connection.php';
// insert a row
$id_card = $_GET['id_card'];
// ค้นหาเลขประชาชนว่าซ้ำไหม
$stmt = $conn->prepare("SELECT * FROM users WHERE id_card = :id_card");
$stmt->bindParam(':id_card', $id_card);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // sweet alert 
    echo '
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
        <script>
             setTimeout(function() {
              swal({
                  title: "บัตรประชาชนไม่พบในระบบ",
                  type: "error"
              }, function() {
                  window.location = "index.php"; //หน้าที่ต้องการให้กระโดดไป
              });
            }, 1000);
        </script>';
    exit();
}

// ค้นหาเลขประชาชนว่าซ้ำไหม
$stmt = $conn->prepare("SELECT * FROM running_type WHERE id_card = :id_card");
$stmt->bindParam(':id_card', $id_card);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $type_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $type_selected = array_column($type_rows, 'type');
} else {
    $type_rows = [];
    $type_selected = [];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>แก้ไขสมัครวิ่ง</title>
</head>

<body>
    <div class="container">
        <h1>ระบบแก้ไขสมัครวิ่ง</h1>
        <form action="update.php" method="post">
            <div class="mb-3">
                <label for="f_name" class="form-label">ชื่อจริง <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="f_name" name="f_name" value="`<?= $row['f_name'] ?>`" required>
            </div>
            <div class="mb-3">
                <label for="l_name" class="form-label">นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="l_name" name="l_name" value="<?= $row['l_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_card" class="form-label">บัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="id_card" name="id_card" value="<?= $row['id_card'] ?>" required minlength="13" maxlength="13" readonly>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="age" name="age" value="<?= $row['age'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">เพศ <span class="text-danger">*</span></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="ชาย" <?= ($row['gender'] == 'ชาย') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gender1">ชาย</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="หญิง" <?= ($row['gender'] == 'หญิง') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gender2">หญิง</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender3" value="ไม่ระบุ" <?= ($row['gender'] == 'ไม่ระบุ') ? 'checked' : '' ?>>
                    <label class="form-check-label" for="gender3">ไม่ระบุ</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="birth_day" class="form-label">วันเกิด <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="birth_day" name="birth_day" value="<?= $row['birth_day'] ?>" required>
            </div>

            <h5>ประเภทการวิ่ง</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ประเภท</th>
                        <th scope="col">ราคา</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">วิ่งเดี่ยว</th>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="price1" name="price[]" value="100" <?= in_array('วิ่งเดี่ยว', $type_selected) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="price1">100 บาท</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">วิ่งคู่</th>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="price2" name="price[]" value="150" <?= in_array('วิ่งคู่', $type_selected) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="price2">150 บาท</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">วิ่งหลายคน</th>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="price3" name="price[]" value="200" <?= in_array('วิ่งหลายคน', $type_selected) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="price3">200 บาท</label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">ยืนยัน</button>
        </form>

    </div>

</body>

</html>