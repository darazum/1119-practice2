<?php
class UserModel
{
    private $id;
    private $name;
    private $password;
    private $passwordHash;
    private $email;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->passwordHash = $data['password_hash'] ?? 0;
        $this->email = $data['email'] ?? 0;
    }

    /**
     * @return int|mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int|mixed
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @return int|mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

}