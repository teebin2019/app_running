<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>ระบบสมัครวิ่ง</title>
</head>

<body>
    <div class="container">
        <h1>ระบบสมัครวิ่ง</h1>
        <form action="register_db.php" method="post">
            <div class="mb-3">
                <label for="f_name" class="form-label">ชื่อจริง <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="f_name" name="f_name" required>
            </div>
            <div class="mb-3">
                <label for="l_name" class="form-label">นามสกุล <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="l_name" name="l_name" required>
            </div>
            <div class="mb-3">
                <label for="id_card" class="form-label">บัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="id_card" name="id_card" required minlength="13" maxlength="13">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">อายุ <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">เพศ <span class="text-danger">*</span></label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="ชาย">
                    <label class="form-check-label" for="gender1">ชาย</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="หญิง">
                    <label class="form-check-label" for="gender2">หญิง</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="gender3" value="ไม่ระบุ">
                    <label class="form-check-label" for="gender3">ไม่ระบุ</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="birth_day" class="form-label">วันเกิด <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="birth_day" name="birth_day" required>
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
                                <input class="form-check-input" type="checkbox" id="price1" name="price[]" value="100">
                                <label class="form-check-label" for="price1">100 บาท</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">วิ่งคู่</th>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="price2" name="price[]" value="150">
                                <label class="form-check-label" for="price2">150 บาท</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">วิ่งหลายคน</th>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="price3" name="price[]" value="200">
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