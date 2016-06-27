<?php

namespace AppBundle\User\Exceptions;

class UserNotFoundException extends \Exception
{

	/**
	 * @var integer
	 */
	private $userId;

	public function __construct(int $userId, \Exception $previous = null)
	{
		parent::__construct(sprintf('User "%s" not found', $userId), 0, $previous);
		$this->userId = $userId;
	}

	/**
	 * @return integer
	 */
	public function getUserId()
	{
		return $this->userId;
	}
}
