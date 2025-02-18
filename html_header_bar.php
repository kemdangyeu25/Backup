<?php
#Code By: Vũ Tuyển
#Designed by: BootstrapMade
#Facebook: https://www.facebook.com/TWFyaW9uMDAx
include 'Configuration.php';
?>

<head>
<!-- CSS thanh trượt Volume index.php -->
<style>
.header-nav2 ul {
  display: flex;
  justify-content: center;
  align-items: center;
  list-style: none;
  padding: 0;
  margin: 0;
}
.header-nav2 ul li {
  margin: 0 10px;
}
</style>


<title>VBot Home 1 - <?php echo $Config['contact_info']['full_name'] ?></title>

<!-- css ChatBot -->
<link href="assets/css/chatbot_head_bar.css" rel="stylesheet">
</head>
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" onclick="loading('show')" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">VBot Home 1</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav2 ms-auto">
      <ul class="d-flex align-items-center">

<!-- Nút chức năng header bar-->
<li><button type="button" id="assistant_Button" name="assistant_Button" title="Wake Up Bot" class="btn btn-info" onclick="wakeUpBot()"><i class="bi bi-robot"></i>
</button></li>
<li><button type="button" id="assistant_Button" name="assistant_Button" title="Logs API" class="btn btn-info" onclick="window.location.href='Log_API.php'"><i class="bi bi-journal-code"></i>
</button></li>
<li><button type="button" id="volumeDOWN_Button" name="volumeDOWN_Button" title="Giảm âm lượng" class="btn btn-primary" onclick="control_volume('down')"><i class="bi bi-volume-down-fill"></i>
</button></li>
<li><button type="button" id="pause_Button" name="pause_Button" title="Tạm dừng phát nhạc" class="btn btn-warning" onclick="control_media('pause')"><i class="bi bi-pause-circle"></i>
</button></li>
<li><button type="button" id="stop_Button" name="stop_Button" title="Dừng phát nhạc" class="btn btn-danger" onclick="control_media('stop')"><i class="bi bi-stop-circle"></i>
</button></li>
<li><button type="button" id="volumeUP_Button" name="volumeUP_Button" title="Tăng âm lượng" class="btn btn-primary" onclick="control_volume('up')"><i class="bi bi-volume-up-fill"></i>
</button></li>

</ul>
</nav>
<!-- Nút chức năng -->
<nav class="header-nav ms-auto">
<ul class="d-flex align-items-center">


<li class="nav-item dropdown">
<?php
include 'Notify.php';
?>
 </li><!-- End Notification Nav -->
<!-- Chatbot Biểu tượng mở chatbox -->
<li class="nav-item nav-icon">
    <i class="bi bi-chat-dots text-primary" type="button" class="btn btn-primary" title="Mở ChatBot" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable_chatbot"></i>
</li>
<div class="modal fade" id="modalDialogScrollable_chatbot" tabindex="-1" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" id="chatbot_size_setting">
        <div class="modal-content">
            <div id="welcome-message" class="welcome-message">ChatBot
			<div class="icon-group_chatbot">
			<i class="bi bi-arrow-repeat pe-3" onclick="loadMessages()" title="Tải lại Chatbox"></i>
			<i class="bi bi-arrows-fullscreen pe-3" id="chatbot_fullscreen" onclick="chatbot_toggleFullScreen()" title="Phóng to, thu nhỏ giao diện chatbox"></i>
                <i class="bi bi-x-lg" data-bs-dismiss="modal" title="Đóng ChatBox"></i>
            </div>
            </div>
            <div class="modal-body">
                <div id="chatbox_wrapper">
                    <div id="chatbox"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="input-group mb-3">
				 <button class="btn btn-info border-success" onclick="Recording_STT('start', '6')"><i class="bi bi-mic"></i></button>
                    <input type="text" class="form-control border-success" id="user_input_chatbox" placeholder="Nhập tin nhắn...">
                      <button id="send_button_chatbox" class="btn btn-primary border-success" title="Gửi tin nhắn"><i class="bi bi-send"></i>
                    </button>
					<button id="re-load_button_chatbox" class="btn btn-info border-success" onclick="loadMessages()" title="Tải lại Chatbox"><i class="bi bi-arrow-repeat"></i>
                </button>
					<button id="clear_button_chatbox" class="btn btn-warning border-success" onclick="clearMessages()" title="Xóa lịch sử Chat"><i class="bi bi-trash"></i>
                </button>
				 <button type="button" class="btn btn-danger border-success" data-bs-dismiss="modal" title="Đóng ChatBox"><i class="bi bi-x-lg"></i>
                </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Chatbot --> 
		
<!-- restart vbot -->	



        <li class="nav-item dropdown pe-3">

          <a class="nav-item nav-icon" href="#" data-bs-toggle="dropdown">
           <i class="bi bi-power text-danger"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow POWER_CONTROL">
<form method="POST"	action="">


            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="power_action_service('start_vbot_service','Khởi chạy chương trình VBot')">
                <i class="bi bi-align-start text-success"></i>
                 <span class="text-primary">Start VBot</span>
              </a>
            </li> 
			
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="power_action_service('stop_vbot_service','Bạn có chắc chắn muốn dừng chương trình VBot')">
                <i class="bi bi-stop-btn text-danger"></i>
                 <span class="text-primary">Stop VBot</span>
              </a>
            </li> 
			
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="power_action_service('restart_vbot_service','Bạn có chắc chắn muốn khởi động lại chương trình VBot')">
                <i class="bi bi-arrow-repeat text-warning" title="Khởi động lại chương trình VBot"></i>
                <span class="text-primary">Restart VBot</span>
              </a>
            </li>
			

            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="power_action_service('reboot_os','Bạn có chắc chắn muốn khởi động lại toàn bộ hệ thống')">
                <i class="bi bi-bootstrap-reboot text-primary"></i>
                 <span class="text-danger">Reboot OS</span>
              </a>
            </li>
</form>
          </ul>
        </li>

<!-- end restart vbot -->		
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo $Avata_File; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $Config['contact_info']['full_name']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $Config['contact_info']['full_name']; ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="loading('show')" href="Users_Profile.php">
                <i class="bi bi-person"></i>
                <span>Cá nhân</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="FAQ.php">
                <i class="bi bi-question-circle"></i>
                <span>Hướng Dẫn</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

				<?php
				if ($Config['contact_info']['user_login']['active']){
					
					echo '            <li>
              <a class="dropdown-item d-flex align-items-center" onclick="loading(\'show\')" href="Login.php?logout">
                <font color=red><i class="bi bi-box-arrow-right"></i>
                <span>Đăng xuất</span></font>
              </a>
            </li>';
					
					
				}
				?>



          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->
<script>
//Khởi động lại chương trình VBot html_header_bar.php
function power_action_service(action_name, mess_name) {
    if (!confirm(mess_name)) {
        return;
    }
    loading('show');
    var xhr = new XMLHttpRequest();
    var url = "includes/php_ajax/Check_Connection.php?" + action_name;
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            loading('hide');
            if (xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        showMessagePHP(response.message);
                    } else {
                        show_message("Lỗi: " + response.message);
                    }
                } catch (e) {
                    show_message("<b>Lỗi định dạng phản hồi từ máy chủ:</b><br/>"+xhr.responseText);
                }
            } else {
                show_message("Yêu cầu thất bại với mã trạng thái: " + xhr.status);
            }
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}

</script>



<script>
var API_VBot = '<?php echo $Protocol . $serverIp . ':' . $Port_API; ?>';

function wakeUpBot() {
    var data = JSON.stringify({
        "type": 2,
        "data": "wake_up",
        "action": true
    });

    loading('show');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', API_VBot);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.addEventListener('readystatechange', function() {
        if (this.readyState === 4) {
            loading('hide');
        }
    });

    xhr.send(data);
}
</script>
  </header>