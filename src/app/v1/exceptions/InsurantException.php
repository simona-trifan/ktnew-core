<?php
namespace Insurant\Exceptions;

use Phalcon\Exception;

/**
 * Class InsurantException
 *
 * @SWG\Definition(
 *         definition="Error",
 *         type="object",
 *         required={"code", "message"}
 *     )
 *
 * @package Insurant\Exceptions
 */
class InsurantException extends Exception
{
    /**
     * @SWG\Property(type="string")
     * @var string
     */
    protected $message;

    /**
     * @SWG\Property(type="integer", format="int64")
     * @var int
     */
    protected $code;
}
