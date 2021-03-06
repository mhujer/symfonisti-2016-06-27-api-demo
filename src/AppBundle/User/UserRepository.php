<?php
namespace AppBundle\User;

use Doctrine\ORM\EntityManager;

class UserRepository
{

	/** @var \Doctrine\ORM\EntityManager */
	private $entityManager;

	public function __construct(
		EntityManager $entityManager
	)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @return \AppBundle\User\User[]
	 */
	public function fetchUsers()
	{
		return $this->entityManager
			->createQueryBuilder()
			->select('user')
			->from(User::class, 'user')
			->getQuery()
			->getResult();
	}

	/**
	 * @return \AppBundle\User\User
	 */
	public function getUserById(int $userId)
	{
		try {
			return $this->entityManager
				->createQueryBuilder()
				->select('user')
				->from(User::class, 'user')
				->andWhere('user.id = :userId')->setParameter('userId', $userId)
				->getQuery()
				->getSingleResult();
		} catch (\Doctrine\ORM\NoResultException $e) {
			throw new \AppBundle\User\Exceptions\UserNotFoundException($userId, $e);
		}
	}

}
