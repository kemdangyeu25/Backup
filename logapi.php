
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
                    logsOutput.innerHTML = '<span style="color: red;">Lỗi: ' + response.message + '</span>';
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
    } else if (message.includes('[Custom skills')) {
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

