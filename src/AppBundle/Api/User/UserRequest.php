<?php

namespace AppBundle\Api\User;

use JMS\Serializer\Annotation as JMS;

use Symfony\Component\Validator\Constraints as Assert;

class UserRequest
{

	/**
	 * @JMS\Type("string")
	 * @Assert\Type("string")
	 * @Assert\NotBlank()
	 * @var string
	 */
	public $name;

	/**
	 * @JMS\Type("string")
	 * @Assert\Type("string")
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 * @var string
	 */
	public $email;
}
