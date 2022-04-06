<?php

namespace Model;

use Aura\SqlQuery\QueryFactory;
use Core\DB;
use Core\ModelAbstract;

class User extends ModelAbstract
{
    private int $id;

    private string $name;

    private string $lastName;

    private string $email;

    private string $password;

    private int $roleId;

    private string $nickname;

    private int $active;

    private string $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    public function checkLoginCredentials(string $email, string $pass)
    {

        $sql = $this->select();

        $sql->cols(['*'])->from('users')
            ->where('email = :email')
            ->bindValue('email', $email)
            ->where('password = :password')
            ->bindValue('password', $pass);

            $rez = $this->db->get($sql);
        return isset($rez['id']) ? $rez['id'] : null;
    }
    public function load(int $id): object
    {
        $sql = $this->select();
        $sql->cols(['*'])->from('users')->where('id = :id');
        $sql->bindValue('id', $id);
        if ($rez = $this->db->get($sql)) {
            $this->id = (int)$rez['id'];
            $this->name = (string)$rez['name'];
            $this->lastName = (string)$rez['last_name'];
            $this->email = (string)$rez['email'];
            $this->password = (string)$rez['password'];
            $this->roleId = (int)$rez['role_id'];
            $this->nickname = (string)$rez['nickname'];
            $this->active = (int)$rez['active'];
            $this->createdAt = (string)$rez['created_at'];
            return $this;
        }
    }

    public function loginUser($username, $passwordas){
        $sql = $this->select();
        $sql->cols(['*'])->from('users')->where('username = :username')->where('password = :password');
        $sql->bindValues(['username' => $username, 'password' => $passwordas]);
        $rez = $this->db->get($sql);
        if(!empty($rez)){
            $this->load($rez['id']);
            return $this;
        }else{
            return null;
        }

    }


}