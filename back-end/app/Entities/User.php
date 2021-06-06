<?php

namespace App\Entities;

use Doctrine\ORM\EntityManager;
use League\OAuth2\Server\Exception\OAuthServerException;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Passport\HasApiTokens;
use LaravelDoctrine\ORM\Auth\Authenticatable;

/**
 * Class User
 * @package App\Entities
 * @Doctrine\ORM\Mapping\Entity(repositoryClass="\App\Repositories\UserRepository")
 * @Doctrine\ORM\Mapping\Table(name="`user`")
 * @Doctrine\ORM\Mapping\HasLifecycleCallbacks
 */
class User extends BaseEntity implements AuthenticatableContract, CanResetPasswordContract
{
    use CanResetPassword, HasApiTokens, Authenticatable;

    /**
     * @Doctrine\ORM\Mapping\Id
     * @Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     * @Doctrine\ORM\Mapping\Column(type="integer")
     */
    protected $id;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $password;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", nullable=true)
     */
    protected $username;

    /**
     * @Doctrine\ORM\Mapping\Column(type="boolean")
     */
    protected $status;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $fullName;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string")
     */
    protected $email;

    /**
     * @Doctrine\ORM\Mapping\Column(type="string", nullable=true)
     */
    protected $rememberToken;

    /**
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the column name for the primary key
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $name = $this->getAuthIdentifierName();

        return $this->{$name};
    }

    /**
     * Get the password for the user.
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->getPassword();
    }

    /**
     * Get the token value for the "remember me" session.
     * @return string
     */
    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * @param $username
     * @return object|null
     * @throws OAuthServerException
     */
    public function findForPassport($username)
    {
        /** @var EntityManager $em */
        $em = app(EntityManager::class);
        $user = $em->getRepository(get_class($this))->findOneBy(['username' => $username]);

        if (!empty($user) && 0 === $user->status) {
            throw new OAuthServerException('Unauthorized', 1000, 'invalid_credentials', 401);
        }

        return $user;
    }
}
