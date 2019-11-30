<?php
class UserFactory
{
    /** @var DB */
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getUserById(int $userId): ?UserModel
    {
        $select = "SELECT * FROM users WHERE id = :id";
        $data = $this->db->fetchAll($select, __METHOD__, [':id' => $userId]);
        if (!$data || empty($data[0])) {
            return null;
        }

        return new UserModel($data[0]);
    }

    public function getUserByEmailAndPassword(string $email, string $passwordHash): ?UserModel
    {
        $select = "SELECT * FROM users WHERE email = :email AND password = :password";
        $data = $this->db->fetchAll($select, __METHOD__, [
            ':email' => $email,
            ':password' => $passwordHash,
        ]);
        if (!$data || empty($data[0])) {
            return null;
        }

        return new UserModel($data[0]);
    }
}