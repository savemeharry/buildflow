<?php
// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
    
    // Email получателя 
    $to = "yesenzhanov@gmail.com"; // Адрес получателя
    
    // Тема письма
    $subject = "Новая заявка с сайта BuildFlow";
    
    // Содержимое письма
    $email_content = "Новая заявка с сайта BuildFlow\n\n";
    $email_content .= "Email: $email\n";
    if (!empty($message)) {
        $email_content .= "Сообщение: $message\n";
    }
    
    // Заголовки письма
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    // Отправка письма
    if (mail($to, $subject, $email_content, $headers)) {
        // Успешная отправка
        header("Location: index.html?status=success");
        exit;
    } else {
        // Ошибка отправки
        header("Location: index.html?status=error");
        exit;
    }
} else {
    // Если форма не была отправлена методом POST, перенаправляем на главную
    header("Location: index.html");
    exit;
}
?> 