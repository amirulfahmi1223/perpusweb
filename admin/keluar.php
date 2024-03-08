<?php
session_start();
// menghapus satu sesi
unset($_SESSION['status_login']);
setcookie("login_admin", "", time() - 3600);
setcookie("id_admin", '', time() - 3600);

//menyimpan perubahan sesi
session_write_close();
echo '<script>window.location="login.php"</script>';
