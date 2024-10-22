<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="operators")
 */
class Operator
{
    /**
     * @ORM\Column(type="integer")
     */
    private $customerId;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $surname_1;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $surname_2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderNotificationsEnabled;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $orderNotificationsEmail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderNotificationsByEmail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderNotificationsBySms;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orderNotificationsByPush;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    // Constructor
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    // Getters and Setters
    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname1()
    {
        return $this->surname_1;
    }

    public function setSurname1($surname1)
    {
        $this->surname_1 = $surname1;
    }

    public function getSurname2()
    {
        return $this->surname_2;
    }

    public function setSurname2($surname2)
    {
        $this->surname_2 = $surname2;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function isOrderNotificationsEnabled()
    {
        return $this->orderNotificationsEnabled;
    }

    public function setOrderNotificationsEnabled($orderNotificationsEnabled)
    {
        $this->orderNotificationsEnabled = $orderNotificationsEnabled;
    }

    public function getOrderNotificationsEmail()
    {
        return $this->orderNotificationsEmail;
    }

    public function setOrderNotificationsEmail($orderNotificationsEmail)
    {
        $this->orderNotificationsEmail = $orderNotificationsEmail;
    }

    public function isOrderNotificationsByEmail()
    {
        return $this->orderNotificationsByEmail;
    }

    public function setOrderNotificationsByEmail($orderNotificationsByEmail)
    {
        $this->orderNotificationsByEmail = $orderNotificationsByEmail;
    }

    public function isOrderNotificationsBySms()
    {
        return $this->orderNotificationsBySms;
    }

    public function setOrderNotificationsBySms($orderNotificationsBySms)
    {
        $this->orderNotificationsBySms = $orderNotificationsBySms;
    }

    public function isOrderNotificationsByPush()
    {
        return $this->orderNotificationsByPush;
    }

    public function setOrderNotificationsByPush($orderNotificationsByPush)
    {
        $this->orderNotificationsByPush = $orderNotificationsByPush;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }

    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function updateTimestamps()
    {
        $this->updatedAt = new \DateTime();
    }
}
