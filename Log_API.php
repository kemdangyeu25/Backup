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
<!-- ======= Header ======= -->
<?php
include 'html_header_bar.php'; 
?>
<!-- End Header -->

  <!-- ======= Sidebar ======= -->
<?php
include 'html_sidebar.php';
?>
<!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Logs Hệ Thống (API)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item" onclick="loading('show')"><a href="index.php">Trang chủ</a></li>
          <li class="breadcrumb-item active">Logs API</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
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
<div class="form-control border-success text-info bg-dark" id="logsOutput" style="height: 500px; overflow-y: auto; white-space: pre-wrap;"></div>
</div>
		</div>
		</div>
		</div>
		</div>
		</section>
	
</main>


  <!-- ======= Footer ======= -->
<?php
include 'html_footer.php';
?>
<!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Nghe thử file âm thanh -->
<audio id="audioPlayer" style="display: none;" controls></audio>

  <!-- Template Main JS File -->
<?php
include 'html_js.php';
?>


    <script>
        const checkbox = document.getElementById('fetchLogsCheckbox');
        const logsOutput = document.getElementById('logsOutput');

        let intervalId;

        // Hàm gửi yêu cầu và cập nhật textarea
        function fetchLogs() {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function() {
                if (this.readyState === 4) {
                    try {
                        const response = JSON.parse(this.responseText);
                        if (response.success) {
                            const logs = response.data.map(item => item.logs_message).join('\n');
                            logsOutput.value = logs;
							//cuộn xuống dưới cùng
							logsOutput.scrollTop = logsOutput.scrollHeight;
							
                        } else {
                            logsOutput.value = 'Lỗi: ' + response.message;
                        }
                    } catch (e) {
                        logsOutput.value = 'Lỗi khi phân tích dữ liệu: ' + e.message;
                    }
                }
            });

            xhr.open("GET", "<?php echo $Protocol.$serverIp.':'.$Port_API; ?>/logs");
            xhr.send();
        }
        // Hàm xử lý sự kiện khi checkbox thay đổi
        checkbox.addEventListener('change', function() {
            if (this.checked) {
				showMessagePHP("Đang hiển thị Logs trên web", 5);
                // Bắt đầu gửi yêu cầu mỗi 1 giây
                intervalId = setInterval(fetchLogs, 1000);
            } else {
                // Dừng gửi yêu cầu khi checkbox không được chọn
                clearInterval(intervalId);
				// Xóa nội dung của textarea
                //logsOutput.value = ''; 
            }
        });
    </script>
<script>
function fetchLogs() {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            try {
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    const logs = response.data.map(item => formatLogMessage(item.logs_message)).join('');
                    logsOutput.innerHTML = logs;
                    logsOutput.scrollTop = logsOutput.scrollHeight; // Cuộn xuống dưới cùng
                } else {
                    logsOutput.innerHTML = '<span style="color:rgb(60, 137, 9);">Lỗi: ' + response.message + '</span>';
                }
            } catch (e) {
                logsOutput.innerHTML = '<span style="color: red;">Lỗi khi phân tích dữ liệu: ' + e.message + '</span>';
            }
        }
    });

    xhr.open("GET", "<?php echo $Protocol.$serverIp.':'.$Port_API; ?>/logs");
    xhr.send();
}

function formatLogMessage(message) {
    if (message.includes('[BOT] Đang thu âm....')) {
        return `<div style="color:  rgb(221, 116, 122);">${message}</div>`;
    } else if (message.includes('[BOT]')) {
        return `<div style="color: rgb(240, 244, 26);">${message}</div>`;
    } else if (message.includes('[HUMAN]')) {
        return `<div style="color:rgb(98, 236, 6);">${message}</div>`;
    } else if (message.includes('Đang chờ được đánh thức.')) {
        return `<div style="color:rgb(58, 136, 205);">${message}</div>`;
    } else if (message.includes('dữ liệu âm thanh')) {
        return `<div style="color: #4aba01;">${message}</div>`;
    } else if (message.includes('Không có giọng nói được truyền vào')) {
        return `<div style="color:rgb(246, 69, 255);">${message}</div>`;
    } else if (message.includes('Đã được đánh thức.')) {
        return `<div style="color: rgb(246, 69, 255);">${message}</div>`;
    } else if (message.includes('Đang phát')) {
        return `<div style="color:rgb(240, 244, 26);">${message}</div>`;
    } else if (message.includes('[Atibot]')) {
        return `<div style="color:rgb(10, 194, 250);">${message}</div>`;
    } else if (message.includes('ERROR')) {
        return `<div style="color: red;">${message}</div>`;
    } else if (message.includes('WARNING')) {
        return `<div style="color: orange;">${message}</div>`;
    } else if (message.includes('SUCCESS')) {
        return `<div style="color: green;">${message}</div>`;
    } else {
        return `<div style="color: white;">${message}</div>`;
    }
}


</script>
</body>
</html>