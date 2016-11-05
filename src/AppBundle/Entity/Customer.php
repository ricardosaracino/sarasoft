<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * Customer
 *
 * @ORM\Table(name="customer", indexes={@ORM\Index(name="updated_by", columns={"updated_by"}), @ORM\Index(name="created_by", columns={"created_by"})})
 * @ORM\Entity
 *
 * @UniqueEntity("phone")
 * @UniqueEntity("email")
 */
class Customer
{
	use \AppBundle\Entity\Traits\Timestampable;
	use \AppBundle\Entity\Traits\Blameable;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="first_name", type="string", length=32, nullable=false)
	 *
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3)
	 */
	private $firstName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="last_name", type="string", length=32, nullable=false)
	 *
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3)
	 */
	private $lastName;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="phone", type="phone_number", length=35, nullable=false)
	 *
	 * @Assert\NotBlank()
	 * @AssertPhoneNumber
	 */
	private $phone;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="alt_phone", type="phone_number", length=35, nullable=true)
	 *
	 * @AssertPhoneNumber
	 */
	private $altPhone;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=64, nullable=true)
	 *
	 * @Assert\Email()
	 */
	private $email;

	/**
	 * @var \Address
	 *
	 * @ORM\ManyToOne(targetEntity="Address", cascade={"all"})
	 * @ORM\JoinColumns({
	 *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
	 * })
	 *
	 * @Assert\Valid()
	 */
	private $address;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set firstName
	 *
	 * @param string $firstName
	 *
	 * @return Customer
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * Get firstName
	 *
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * Set lastName
	 *
	 * @param string $lastName
	 *
	 * @return Customer
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;

		return $this;
	}

	/**
	 * Get lastName
	 *
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * Set phone
	 *
	 * @param string $phone
	 *
	 * @return Customer
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;

		return $this;
	}

	/**
	 * Get phone
	 *
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * Set altPhone
	 *
	 * @param string $altPhone
	 *
	 * @return Customer
	 */
	public function setAltPhone($altPhone)
	{
		$this->altPhone = $altPhone;

		return $this;
	}

	/**
	 * Get altPhone
	 *
	 * @return string
	 */
	public function getAltPhone()
	{
		return $this->altPhone;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 *
	 * @return Customer
	 */
	public function setEmail($email)
	{
		$this->email = mb_strtolower($email);

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set address
	 *
	 * @param \AppBundle\Entity\Address $address
	 *
	 * @return Company
	 */
	public function setAddress(\AppBundle\Entity\Address $address = null)
	{
		$this->address = $address;

		return $this;
	}

	/**
	 * Get address
	 *
	 * @return \AppBundle\Entity\Address
	 */
	public function getAddress()
	{
		return $this->address;
	}
}