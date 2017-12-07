<?php
	declare(strict_types=1);

	namespace Jkirkby91\LumenRestServerComponent\Libraries {

		use Psr\Http\Message\ResponseInterface;
		use Zend\{
			Diactoros
		};

		use Spatie\{
			Fractal\Fractal
		};

		/**
		 * Class ResourceResponseTrait
		 *
		 * @package Jkirkby91\LumenRestServerComponent\Libraries
		 * @author James Kirkby <jkirkby91@gmail.com>
		 * @TODO abstract this into its own package
		 */
		trait ResourceResponseTrait
		{

			/**
			 * createdResponse()
			 * @param $data
			 *
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function createdResponse($data) : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse($data,201,$this->getHeaders());
			}

			/**
			 * showResponse()
			 * @param array $data
			 *
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function showResponse(array $data) : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse($data,200,$this->getHeaders());
			}

			/**
			 * deletedResponse()
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function deletedResponse() : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'success',
					'msg' => 'Successfully deleted resource.'
				],204,$this->getHeaders());
			}

			/**
			 * completedResponse()
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function completedResponse() : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'success',
					'msg' => 'Successfully completed response.'
				],204,$this->getHeaders());
			}

			/**
			 * clientErrorResponse()
			 * @param string $msg
			 *
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function clientErrorResponse(string $msg = 'Un-processable Entity.') : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'error',
					'error' => 'entity.invalid',
					'msg' => $msg
				],422,$this->getHeaders());
			}

			/**
			 * notFoundResponse()
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function notFoundResponse() : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'error',
					'error' => 'Not Found',
					'msg' => 'Resource Not Found.'
				],404,$this->getHeaders());
			}

			/**
			 * unauthorizedResponse()
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function unauthorizedResponse() : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'error',
					'error' => 'Unauthorized',
					'msg' => 'Credentials dont match.'
				],403,$this->getHeaders());
			}

			/**
			 * serverErrorResponse()
			 * @param string $msg
			 *
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function serverErrorResponse(string $msg = 'Internal Server Error') : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'error',
					'error' => 'Server Error',
					'msg' => $msg
				],500,$this->getHeaders());
			}

			/**
			 * exceptionResponse()
			 * @param int    $code
			 * @param string $msg
			 *
			 * @return \Psr\Http\Message\ResponseInterface
			 */
			public function exceptionResponse(int $code, string $msg) : ResponseInterface
			{
				return new Diactoros\Response\JsonResponse([
					'status' => 'error',
					'error'  => $code,
					'msg'    => $msg
				],$code,$this->getHeaders());
			}
		}
	}
