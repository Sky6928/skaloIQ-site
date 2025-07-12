<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@skaloiq.ru";  // ← твой почтовый ящик REG.RU
    $subject = "Новое сообщение с сайта SkaloIQ";

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["_replyto"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Заполните форму корректно.";
        exit;
    }

    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Сообщение:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($to, $subject, $email_content, $headers)) {
        header("Location: thanks.html"); // Создай файл thanks.html или замени URL
        exit;
    } else {
        http_response_code(500);
        echo "Ошибка отправки письма.";
    }
} else {
    http_response_code(403);
    echo "Неверный запрос.";
}
