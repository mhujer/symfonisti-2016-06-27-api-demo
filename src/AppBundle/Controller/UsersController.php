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
				return $this->get('api.user.user_response_factory')->getUser($user);
			}, $users),
		]);
	}

	/**
	 * @Get("/users/{userId}")
	 */
	public function userDetailAction(int $userId)
	{
		$user = $this->get('user_repository')->getUserById($userId);

		return new JsonResponse([
			'user' => $this->get('api.user.user_response_factory')->getUser($user),
		]);
	}

}
