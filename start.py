import requests
from bs4 import BeautifulSoup
import schedule
import time

def fetch_news():
    url = "https://www.msn.com/"
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')

    # Tìm các tiêu đề tin tức
    headlines = soup.find_all('h2')  # Điều chỉnh lại tùy theo cấu trúc HTML của trang MSN

    with open('news.txt', 'w', encoding='utf-8') as file:
        for headline in headlines:
            # Lưu tiêu đề tin tức vào file
            file.write(headline.get_text() + '\n')

    print("Đã cập nhật tin tức mới!")

# Lên lịch để chạy hàm fetch_news hàng ngày vào lúc 8 giờ sáng
schedule.every().day.at("08:00").do(fetch_news)

print("Đang chạy lịch trình lấy tin tức...")

while True:
    schedule.run_pending()
    time.sleep(1)
