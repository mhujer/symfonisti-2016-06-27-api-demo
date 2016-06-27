<?php
namespace AppBundle\Api;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class RequestValidationErrorException extends \Exception
{

	/**
	 * @var \Symfony\Component\Validator\ConstraintViolationListInterface
	 */
	private $violationList;

	public function __construct(ConstraintViolationListInterface $violationList, \Exception $previous = null)
	{
		parent::__construct('', 0, $previous);
		$this->violationList = $violationList;
	}

	/**
	 * @return \Symfony\Component\Validator\ConstraintViolationListInterface
	 */
	public function getViolationList()
	{
		return $this->violationList;
	}
}
