<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pending_notifications")
 */
class PendingNotification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(name="customer_id", type="string")
     */
    private ?string $customer_id;

    /**
     * @ORM\Column(name="operator_id", type="string")
     */
    private ?int $operator_id;

    /**
     * @ORM\Column(name="order_number", type="string")
     */
    private ?string $orderNumber;

    /**
     * @ORM\Column(name="message_type", type="string")
     */
    private ?string $messageType;

    /**
     * @ORM\Column(name="create_date", type="datetime")
     */
    private \DateTimeInterface $createdDate;

    // Getters y Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerId(): ?string
    {
        return $this->customer_id;
    }

    public function setCustomerId(string $customerId): self
    {
        $this->customer_id = $customerId;
        return $this;
    }

    public function getOperatorId(): ?int
    {
        return $this->operator_id;
    }

    public function setOperatorId(int $operatorId): self
    {
        $this->operator_id = $operatorId;
        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function getMessageType(): ?string
    {
        return $this->messageType;
    }

    public function setMessageType(string $messageType): self
    {
        $this->messageType = $messageType;
        return $this;
    }

    public function getCreatedDate(): \DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;
        return $this;
    }
}
