<?php

namespace AppBundle\Controller;

use AppBundle\User\User;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersController extends FOSRestController
{

	/**
	 * @Get("/users")
	 */
	public function listUsersAction()
	{
		$users = $this->get('user_repository')->fetchUsers();

		return new JsonResponse([
			'users' => array_map(function(User $user) {
				return [
					'id' => $user->getId(),
					'name' => $user->getName(),
					'email' => $user->getEmail(),
				];
			}, $users),
		]);
	}

}
