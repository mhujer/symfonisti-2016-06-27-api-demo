<?php
namespace AppBundle\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ApiExceptionListener
{
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		$exception = $event->getException();

		if ($exception instanceof \Exception) {
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
