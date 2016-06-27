<?php

namespace AppBundle\Controller;

use AppBundle\Api\User\UserRequest;
use AppBundle\User\User;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
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

	/**
	 * @Post("/users")
	 */
	public function addUserAction(UserRequest $userRequest)
	{
		$user = new User(
			$userRequest->name,
			$userRequest->email
		);

		$this->get('doctrine.orm.entity_manager')->persist($user);
		$this->get('doctrine.orm.entity_manager')->flush();

		return new JsonResponse(null, 204);
	}

	/**
	 * @Delete("/users/{userId}")
	 */
	public function deleteUserAction(int $userId)
	{
		$user = $this->get('user_repository')->getUserById($userId);

		$this->get('doctrine.orm.entity_manager')->remove($user);
		$this->get('doctrine.orm.entity_manager')->flush();

		return new JsonResponse(null, 204);
	}

}
