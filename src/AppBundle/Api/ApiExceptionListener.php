<?php
namespace AppBundle\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ApiExceptionListener
{
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		$exception = $event->getException();

		if ($exception instanceof \AppBundle\Api\Exceptions\NotFoundException) {
			$event->setResponse(
				new JsonResponse(
					[
						'message' => $exception->getMessage(),
					],
					404
				)
			);
		} elseif ($exception instanceof \AppBundle\Api\RequestValidationErrorException) {
			$violations = [];

			foreach ($exception->getViolationList() as $violation) {
				/** @var \Symfony\Component\Validator\ConstraintViolationInterface $violation  */
				$violations[$violation->getPropertyPath()] = $violation->getMessage();
			}

			$event->setResponse(
				new JsonResponse(
					[
						'message' => 'Validation failed!',
						'errors' => $violations,
					],
					400
				)
			);
			return;
		} else {
			$event->setResponse(
				new JsonResponse(
					[
						'message' => 'Error: ' . get_class($exception),
						'errors' => $exception->getMessage(),
					],
					500
				)
			);
		}
	}
}
