<?php
namespace Insurant\Controllers;

use Insurant\Models\Insurant;
use Insurant\Services\InsurantService;
use Insurant\Exceptions\InsurantException;

/**
 * Class InsurantController
 * @package Insurant\Controllers
 */
class InsurantController extends BaseController
{
    /**
     * @SWG\Get(
     *     path="/get/{insurantId}",
     *     summary="Info for a specific insurant",
     *     operationId="showInsurantById",
     *     tags={"insurants"},
     *     @SWG\Parameter(
     *         name="insurantId",
     *         in="path",
     *         required=true,
     *         description="The id of the insurant to retrieve",
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Expected response to a valid request",
     *         @SWG\Schema(ref="#/definitions/Insurant"),
     *         examples={
     *              "insurant": {
     *                  "id": 123,
     *                  "firstname": "John",
     *                  "lastname": "Doe",
     *                  "gender": "m",
     *                  "birthdate": "1985-02-13",
     *                  "created": "2017-12-09 12:23:02",
     *                  "updated": "2017-12-09 13:23:02"
     *              }
     *         }
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Insurant not found",
     *         @SWG\Schema(ref="#/definitions/Error"),
     *         examples={
     *             "error": {
     *                  "code": 404,
     *                  "message": "Insurant not found"
     *             }
     *         }
     *     ),
     *     @SWG\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *         @SWG\Schema(ref="#/definitions/Error"),
     *         examples={
     *             "error": {
     *                  "code": 400,
     *                  "message": "Invalid ID supplied"
     *             }
     *         }
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="Unexpected error",
     *         @SWG\Schema(ref="#/definitions/Error")
     *     )
     * )
     *
     * @param int $id
     *
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function get($id)
    {
        /** @var InsurantService $insurantService */
        $insurantService = $this->getDI()->get('InsurantService');

        try {
            $insurant = $insurantService->getInsurant($id);

            if ($insurant instanceof Insurant) {
                return $this->buildResponse($insurant->toArray(), 200, 'OK');
            }

            return $this->buildResponse(['Insurant not found'], 404, 'error');

        } catch (InsurantException $e) {
            return $this->buildResponse(['Invalid ID supplied'], 400, 'error');
        } catch (\Exception $e) {
            return $this->buildResponse(['Unexpected error'], 499, 'error');
        }
    }

    /**
     * @SWG\Post(
     *     path="/add",
     *     operationId="addInsurant",
     *     description="Creates a new insurant. Duplicates are allowed",
     *     produces={"application/json"},
     *     consumes={"application/json"},
     *     @SWG\Parameter(
     *         name="insurant",
     *         in="body",
     *         description="Insurant to add to the store",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewInsurant"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="pet response",
     *         @SWG\Schema(ref="#/definitions/Insurant")
     *     ),
     *     @SWG\Response(
     *         response="default",
     *         description="unexpected error",
     *         @SWG\Schema(ref="#/definitions/Error")
     *     )
     * )
     *
     * swagger --output D:/dev/htdocs/phalcon-ms/src/public/v1/api-spec --exclude vendor D:/dev/htdocs/phalcon-ms/src
     * curl -i -X POST -d "{\"firstname\":\"Simona  \",\"lastname\":\"Trifan\",\"gender\":\"f\",\"birthdate\":\"1988-01-01\"}" http://phalcon.insurant.ms/v1/insurant/add
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function add()
    {
        // Check if request has made with POST
        if ($this->request->isPost()) {
            // Access POST data
            $customerBorn = $this->request->getPost('born');
        }
        $insurantData = $this->request->getJsonRawBody();

        /** @var InsurantService $insurantService */
        $insurantService = $this->getDI()->get('InsurantService');

        try {
            $insurant = $insurantService->saveInsurant($insurantData);

            if ($insurant instanceof Insurant) {
                if ($insurant->validationHasFailed()) {
                    $messages = $insurant->getMessages();
                    $messageStr = [];
                    foreach ($messages as $message) {
                        $messageStr[] = $message->getMessage();
                    }

                    return $this->buildResponse(['Invalid data supplied: ' . implode('. ', $messageStr)], 400, 'error');
                }

                return $this->buildResponse($insurant->toArray(), 200, 'OK');
            }

            return $this->buildResponse(['Invalid data supplied'], 400, 'error');
        } catch (\Exception $e) {
            return $this->buildResponse(['Unexpected error: ' . $e->getMessage() . $e->getTraceAsString()], 499, 'error');
        }
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}
