<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "info@skaloiq.ru";  // ← замени на свой email
    $subject = "Новое сообщение с сайта SkaloIQ";

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["_replyto"]);
    $message = htmlspecialchars($_POST["message"]);

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $body = "Имя: $name\nEmail: $email\nСообщение:\n$message";

    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "Ошибка при отправке сообщения.";
    }
} else {
    echo "Метод не поддерживается.";
}
?>
