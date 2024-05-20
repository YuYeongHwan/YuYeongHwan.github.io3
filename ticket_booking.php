<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root"; // 기본 사용자 이름
$password = ""; // 기본 비밀번호
$dbname = "testdb"; // 사용하려는 데이터베이스 이름

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST로부터 데이터 가져오기
$customer_name = $_POST['customer_name'];
$child_en = (int)$_POST['child_en'];
$child_big = (int)$_POST['child_big'];
$child_free = (int)$_POST['child_free'];
$child_year = (int)$_POST['child_year'];
$adult_en = (int)$_POST['adult_en'];
$adult_big = (int)$_POST['adult_big'];
$adult_free = (int)$_POST['adult_free'];
$adult_year = (int)$_POST['adult_year'];

// 각 티켓 가격 정의
$child_prices = array(7000, 12000, 21000, 70000);
$adult_prices = array(10000, 18000, 28000, 90000);

// 각 티켓별 가격 합계 계산
$total_price = ($child_prices[0] * $child_en) +
                ($child_prices[1] * $child_big) +
                ($child_prices[2] * $child_free) +
                ($child_prices[3] * $child_year) +
                ($adult_prices[0] * $adult_en) +
                ($adult_prices[1] * $adult_big) +
                ($adult_prices[2] * $adult_free) +
                ($adult_prices[3] * $adult_year);

// 데이터베이스에 데이터 저장
$sql = "INSERT INTO ticket_bookings (customer_name, child_en, child_big, child_free, child_year, adult_en, adult_big, adult_free, adult_year, total_price)
        VALUES ('$customer_name', $child_en, $child_big, $child_free, $child_year, $adult_en, $adult_big, $adult_free, $adult_year, $total_price)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 사용자에게 보여줄 데이터 출력
echo "<h2>예약 내역</h2>";

// 현재 날짜와 시간 출력
date_default_timezone_set("Asia/Seoul"); // 타임존 설정
$current_datetime = date("Y년 m월 d일 H:i분");
echo "<p>$current_datetime</p>";

echo "<P>$customer_name 고객님 감사합니다</p>";

// 티켓 수량이 0이 아닌 경우에만 출력
if ($child_en > 0) {
    echo "<p>어린이 입장권 수량: $child_en</p>";
}
if ($adult_en > 0) {
    echo "<p>어른 입장권 수량: $adult_en</p>";
}
if ($child_big > 0) {
    echo "<p>어린이 BIG3 수량: $child_big</p>";
}
if ($adult_big > 0) {
    echo "<p>어른 BIG3 수량: $adult_big</p>";
}
if ($child_free > 0) {
    echo "<p>어린이 자유이용권 수량: $child_free</p>";
}
if ($adult_free > 0) {
    echo "<p>어른 자유이용권 수량: $adult_free</p>";
}
if ($child_year > 0) {
    echo "<p>어린이 연간이용권 수량: $child_year</p>";
}
if ($adult_year > 0) {
    echo "<p>어른 연간이용권 수량: $adult_year</p>";
}

echo "<p>합계 $total_price 원 입니다</p>";