<?php

if( isset( $_GET[ 'Submit' ] ) ) {
    // Get input
    $id = $_GET[ 'id' ]; // ⚠️ Ошибка 1: Не фильтруется ввод пользователя. Возможна SQL-инъекция.

    // Check database
    $getid  = "SELECT first_name, last_name FROM users WHERE user_id = '$id';"; 
    // ⚠️ Ошибка 2: Используется динамическое формирование SQL-запроса с небезопасным вводом.

    $result = mysqli_query($GLOBALS["___mysqli_ston"],  $getid ); 
    // ⚠️ Ошибка 3: Используется глобальная переменная, что затрудняет тестирование и делает код менее прозрачным.
    // ⚠️ Ошибка 4: Нет обработки ошибок при выполнении SQL-запроса (например, если база данных недоступна).

    // Get results
    $num = @mysqli_num_rows( $result ); // ⚠️ Ошибка 5: Символ '@' подавляет ошибки, затрудняя их обнаружение.
    if( $num > 0 ) {
        // Feedback for end user
        $html .= '<pre>User ID exists in the database.</pre>';
        // ⚠️ Ошибка 6: Переменная $html не инициализирована. Это может вызвать предупреждения.
    }
    else {
        // User wasn't found, so the page wasn't!
        header( $_SERVER[ 'SERVER_PROTOCOL' ] . ' 404 Not Found' );

        // Feedback for end user
        $html .= '<pre>User ID is MISSING from the database.</pre>';
        // ⚠️ Ошибка 7: Повторное использование $html без инициализации.
    }

    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res); 
    // ⚠️ Ошибка 8: Код избыточен. Закрытие соединения с базой данных можно сделать проще.
}

?>
