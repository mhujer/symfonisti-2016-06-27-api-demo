<?php

namespace AppBundle\Api\User;

use JMS\Serializer\Annotation as JMS;

class UserRequest
{

	/**
	 * @JMS\Type("string")
	 * @var string
	 */
	public $name;

	/**
	 * @JMS\Type("string")
	 * @var string
	 */
	public $email;
}
