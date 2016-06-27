<?php

namespace AppBundle\Api\User;

use AppBundle\User\User;

class UserResponseFactory
{

	/**
	 * @param \AppBundle\User\User $user
	 * @return mixed[]
	 */
	public function getUser(User $user)
	{
		return [
			'id' => $user->getId(),
			'name' => $user->getName(),
			'email' => $user->getEmail(),
		];
	}
}
