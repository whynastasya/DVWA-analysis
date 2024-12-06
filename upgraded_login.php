<?php

if (isset($_GET['Submit'])) {
    // Получаем ввод
    $id = $_GET['id'];

    // Проверяем соединение с базой данных
    $conn = mysqli_connect("localhost", "username", "password", "database");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); // Обработка ошибки подключения
    }

    // Подготовленный запрос для предотвращения SQL-инъекций
    $stmt = mysqli_prepare($conn, "SELECT first_name, last_name FROM users WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id); // Привязываем параметр как целое число
    mysqli_stmt_execute($stmt);

    // Получаем результат
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        echo '<pre>User ID exists in the database: ' . htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) . '</pre>';
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        echo '<pre>User ID is MISSING from the database.</pre>';
    }

    // Закрываем соединение
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>
