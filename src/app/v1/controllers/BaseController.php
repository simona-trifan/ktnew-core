<?php
namespace Insurant\Controllers;

use Phalcon\Mvc\Controller;

class BaseController extends Controller
{
    /**
     * @param array $jsonData
     * @param int $statusCode
     * @param string $statusText
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    protected function buildResponse(array $jsonData, $statusCode = 200, $statusText = '')
    {
        $response = $this->response;

        $response->setStatusCode($statusCode, $statusText)
                 ->setContentType('application/json', 'UTF-8')
                 ->setJsonContent($jsonData);

        return $response;
    }
}
