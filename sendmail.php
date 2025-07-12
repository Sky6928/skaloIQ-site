<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["_replyto"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Заполните форму корректно.";
        exit;
    }

    $to = "info@skaloiq.ru";
    $subject = "Новое сообщение с сайта SkaloIQ";
    $content = "Имя: $name\nEmail: $email\n\nСообщение:\n$message";

    $headers = "From: SkaloIQ <info@skaloiq.ru>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8";

    if (mail($to, $subject, $content, $headers)) {
        http_response_code(200);
        echo "Спасибо! Ваше сообщение отправлено.";
    } else {
        http_response_code(500);
        echo "Ошибка при отправке.";
    }
} else {
    http_response_code(403);
    echo "Ошибка запроса.";
}
?>
