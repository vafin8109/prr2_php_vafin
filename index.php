<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (empty($name) || strlen($name) < 3) {
        echo "Ошибка: Имя должно быть заполнено и иметь длину не менее 3 символов.";
    }

    if (empty($email) || strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Ошибка: Email должен быть заполнен, иметь длину не более 50 символов и быть действительным.";
        return;
    }
    if (empty($phone) || strlen($phone) != 11) {
        echo "Ошибка: Номер телефона должен быть заполнен и иметь 11 символов.";
        return;
    }
    echo "Данные успешно сохранены.";
}
?>

<?php
function validateName($name)
{
    if (empty($name)) {
        return "Поле Имя не должно быть пустым.";
    }
    if (strlen($name) < 3 || strlen($name) > 50) {
        return "Пооле Имя не должно быть меньше 3 символов и больше 50 символов";
    }
    return "";
}

function validateEmail($email)
{
    if (empty($email)) {
        return "Поле Почта не должно быть пустым.";
    }
    if (strlen($email) > 50) {
        return "Поле почты не должно быть более 50 символов.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Неправильный формат почты.";
    }
    return "";
}

function validatePhone($phone)
{
    if (empty($phone)) {
        return "Поле Номер телефона не должно быть пустым.";
    }
    if (strlen($phone) != 10) {
        return "Номер телефона должен быть больше 10 символов";
    }
    return "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $nameError = validateName($name);
    $emailError = validateEmail($email);
    $phoneError = validatePhone($phone);

    if (empty($nameError) && empty($emailError) && empty($phoneError)) {
        echo "Вы зарегистрировались";
    } else {
        $errorMessage = "";
        if (!empty($nameError)) {
            $errorMessage .= "Name: " . $nameError . "<br>";
        }
        if (!empty($emailError)) {
            $errorMessage .= "Email: " . $emailError . "<br>";
        }
        if (!empty($phoneError)) {
            $errorMessage .= "Phone: " . $phoneError . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Валидация формы</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Форма регистрации</h1>
        <form name="post" method="post">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" required>
                <span class="error-message"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span class="error-message"></span>
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона:</label>
                <input type="tel" id="phone" name="phone" required>
                <span class="error-message"></span>
            </div>
            <?echo $errorMessage?>
            <button type="submit">Отправить</button>
        </form>
    </div>
</body>

</html>