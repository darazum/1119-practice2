<?php
if (getAuthorizedUser()) {
    redirect('/main');
}

if(!empty($_POST['command']) && $_POST['command'] == 'register') {
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    $userModel = new UserModel([
       'name' => $name,
       'password' => $password,
       'password_hash' => hashPassword($password),
       'email' => $email,
    ]);

    $errors = [];
    $result = validateUserData($name, $password, $email, $errors);
    if ($result) {
        (new UserRegistrator(DB::instance()))->registerUser($userModel);
        redirect('/main');
    }
}

if(!empty($_POST['command']) && $_POST['command'] == 'login') {
    $passwordHash = hashPassword($_POST['password'] ?? '');
    $email = $_POST['email'] ?? '';

    $userModel = (new UserFactory(DB::instance()))->getUserByEmailAndPassword($email, $passwordHash);
    if (!$userModel) {
        $errors = ['login' => 'Неверный email или пароль'];
    } else {
        $_SESSION['user_id'] = $userModel->getId();
        redirect('main');
    }
}
?>

<?php
include __DIR__ . '/../templates/register.phtml';
?>