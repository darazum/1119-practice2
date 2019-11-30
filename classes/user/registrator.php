<?php
class UserRegistrator
{
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @param UserModel $user
     * @return bool
     * @throws Exception
     */
    public function registerUser(UserModel $user): bool
    {
        $insert = "
            INSERT INTO users (
              `name`,
              email,
              `password`,
              created_at
            ) VALUES (
              :name,
              :email,
              :password,
              :created_at
            );
        ";

        $ret = $this->db->exec($insert, __METHOD__, [
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
            ':password' => $user->getPasswordHash(),
            ':created_at' => date('Y-m-d H:i:s')
        ]);

        $userId = $this->db->lastInsertId();
        if (!$ret || !$userId) {
            throw new Exception('Cant register user');
        }

        $_SESSION['user_id'] = $userId;

        return $userId;
    }
}