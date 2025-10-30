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
        <h1>ค้นหาการสมัคร</h1>
        <form action="search.php" method="post">

            <div class="mb-3">
                <label for="id_card" class="form-label">บัตรประชาชน <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="id_card" name="id_card" required minlength="13" maxlength="13">
            </div>

            <button type="submit" class="btn btn-primary">ยืนยัน</button><br>
            หากยังไม่มีการสมัคร <a href="register.php">สมัครได้ที่นี่</a>
        </form>

    </div>

</body>

</html>