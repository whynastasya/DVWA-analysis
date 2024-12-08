# Отчёт о проделанной практической работе 4

## Задание

### 1. Необходимо найти участок кода, содержащий инъекцию SQL кода в задании Blind Sql Injection
- Развернула в докере контейнер SonarQube
- Авторизовалась и создала проект dvwa-analysis
- Создала файл properties и запустила его
#### - Результаты:
![вывод](https://github.com/user-attachments/assets/90813ccc-bd9d-4308-92cd-c126aecf1e99)

![](https://github.com/user-attachments/assets/a619cc60-dc14-4b57-a65f-68038d6534f6)

![](https://github.com/user-attachments/assets/c1fa93d7-6f25-4a51-9731-161017f93c7e)

### 2. Проанализировать код и сделать кодревью, указав слабые места

Подробнее в [login.php](https://github.com/whynastasya/DVWA-analysis/blob/main/login.php)

1. Ввод пользователя ($_GET['id']) вставляется в запрос без обработки.
2. Данные из формы не проверяются и не фильтруются.
3. Ошибки скрываются с помощью символа @.
4. Используются глобальные переменные для подключения к базе.
5. Результат выполнения SQL-запроса не проверяется.
6. Переменная $html используется без задания начального значения.
7. Код для закрытия базы слишком сложен и избыточен.
8. Данные из базы выводятся напрямую без защиты.
9. SQL-запрос составляется вручную, что небезопасно.

### 3. Разработать свою систему вывода информации об объекте на любом языке, исключающий взможность инъекции SQL кода.

- [upgraded_login.php](https://github.com/whynastasya/DVWA-analysis/blob/main/upgraded_login.php)
  
Что сделано:
- Подготовленные запросы (prepare) – Устраняют SQL-инъекции.
- Проверка типа данных – ID проверяется как число перед выполнением запроса.
- Безопасное подключение – Используется mysqli с явной проверкой ошибок.
- Корректное закрытие соединений – Закрываются как запросы, так и соединение с базой.
  
### 4. Использовать sqlmap для нахождения уязвимости в веб-ресурсе
![](https://github.com/user-attachments/assets/1fbe4452-6277-4797-95fd-091566d37cab)

### 5. Использовать Burp для нахождения уязвимости в веб-ресурсе