<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // กำหนดอีเมลผู้รับ (ของคุณ)
    $to = "pairploy.chp@gmail.com"; 

    // ดึงค่าจากฟอร์ม
    $name    = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
    $email   = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $subject = isset($_POST['subject']) ? strip_tags($_POST['subject']) : 'No Subject';
    $message = isset($_POST['message']) ? strip_tags($_POST['message']) : '';

    // ป้องกันช่องว่างเปล่า
    if(empty($name) || empty($email) || empty($message)){
        die("กรุณากรอกข้อมูลให้ครบ");
    }

    // เนื้อหาอีเมล
    $body = "คุณได้รับข้อความใหม่จากฟอร์มติดต่อ:\n\n";
    $body .= "ชื่อ: $name\n";
    $body .= "อีเมล: $email\n";
    $body .= "เรื่อง: $subject\n";
    $body .= "ข้อความ:\n$message\n";

    // Header
    $headers  = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // ส่งอีเมล
    if(mail($to, $subject, $body, $headers)){
        echo "ส่งข้อความเรียบร้อยแล้ว!";
    } else {
        echo "เกิดข้อผิดพลาดในการส่งข้อความ กรุณาลองใหม่อีกครั้ง";
    }
}
?>
