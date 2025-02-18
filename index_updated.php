
<?php
#Code By: Vũ Tuyển
#Designed by: BootstrapMade
#Facebook: https://www.facebook.com/TWFyaW9uMDAx
include 'Configuration.php';
?>
<?php
if ($Config['contact_info']['user_login']['active']){
session_start();
// Kiểm tra xem người dùng đã đăng nhập chưa và thời gian đăng nhập
if (!isset($_SESSION['user_login']) ||
    (isset($_SESSION['user_login']['login_time']) && (time() - $_SESSION['user_login']['login_time'] > 43200))) {
    
    // Nếu chưa đăng nhập hoặc đã quá 12 tiếng, hủy session và chuyển hướng đến trang đăng nhập
    session_unset();
    session_destroy();
    header('Location: Login.php');
    exit;
}
// Cập nhật lại thời gian đăng nhập để kéo dài thời gian session
//$_SESSION['user_login']['login_time'] = time();
}
?>

<!DOCTYPE html>
<html lang="vi">
<?php
include 'html_head.php';
?>

<body>


  <!-- ======= Sidebar ======= -->

<!-- End Sidebar-->

  <main id="main" class="main">

	    <section class="section">
        <div class="row">
		
	<div class="col-lg-12">

          <div class="card">
            <div class="card-body">
<br/>
<center>
<button type="button" class="btn btn-primary">
<input class="form-check-input" title="Bật để hiển thị Logs" type="checkbox" name="fetchLogsCheckbox" id="fetchLogsCheckbox">
<label class="form-check-label" for="fetchLogsCheckbox" title="Thiết lập trong: Cấu hình Config->Đồng bộ trạng thái với Web UI"> Hiển thị Logs</label>
</button>
<button type="button" class="btn btn-danger" onclick="change_og_display_style('clear_api', 'clear_api', 'false')"><i class="bi bi-trash"></i> Xóa logs</button>
</center>
<div class="form-group">
<br/>
 <!-- Đổi màu log>
 <textarea class="form-control border-success text-info bg-dark" id="logsOutput" rows="17" readonly></textarea>
  <!-- Đổi màu log-->

    <div class="form-group">
    <br />
    <div class="form-control border-success text-info bg-dark" id="logsOutput" style="height: 400px; overflow-y: auto; white-space: pre-wrap;"></div>
</div>
<!-- Đổi màu log-->
		</div>
		</div>
		</div>
		</div>
		</div>
		</section>
	
</main>




  <!-- Template Main JS File -->
<?php
include 'html_js.php';
?>
<?php
include 'logapi.php';
?>



</body>
</html>
