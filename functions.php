<?php
function redirect(string $url)
{
    header('Location: ' . $url);
    die;
}

function hashPassword(string $password)
{
    return sha1('iuaf;_' . $password);
}

function validateUserData(string $name, string $password, string $email, &$errors = []): bool
{
    if (mb_strlen($name) < 3) {
        $errors['name'] = 'Имя должно быть не короче 3х символов';
    }

    if (mb_strlen($name) > 25) {
        $errors['name'] = 'Имя должно быть не длиннее 25 символов';
    }

    if (mb_strlen($password) < 4) {
        $errors['password'] = 'Пароль должен быть длиннее 3х символов';
    }

    if (strpos($email, '@') === false) {
        $errors['email'] = 'Некорректный email';
    }

    return sizeof($errors) == 0;
}

function getAuthorizedUser(): ?UserModel
{
    static $user = false;

    if ($user === false) {
        $user = null;
        $userId = $_SESSION['user_id'] ?? 0;
        $db = DB::instance();
        if ($userId) {
            $user = (new UserFactory($db))->getUserById($userId);
        }
    }

    return $user;
}