<?php
$user = getAuthorizedUser();

if (!$user) {
    redirect('/register');
}
?>

<?php
include __DIR__ . '/../templates/main.phtml';
?>