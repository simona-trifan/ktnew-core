<?php
namespace Insurant\Services;

use Insurant\Models\Insurant;
use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Filter;

class InsurantService implements InjectionAwareInterface
{
    /**
     * @var DiInterface
     */
    protected $di;

    public function setDi(DiInterface $di)
    {
        $this->di = $di;
    }

    public function getDi()
    {
        return $this->di;
    }

    /**
     * @param int $id
     *
     * @return Insurant|false
     */
    public function getInsurant($id)
    {
        $filter = new Filter;
        return Insurant::getInsurant($filter->sanitize($id, 'int'));
    }

    /**
     * @param \stdClass $insurantData
     *
     * @return Insurant
     */
    public function saveInsurant(\stdClass $insurantData)
    {
        $insurat = new Insurant();
        $filter = new Filter;
        if (isset($insurantData->firstname)) {
            $insurat->setFirstname($filter->sanitize(
                $insurantData->firstname,
                ['striptags', 'trim']
            ));
        }
        if (isset($insurantData->lastname)) {
            $insurat->setLastname($filter->sanitize(
                $insurantData->lastname,
                ['striptags', 'trim']
            ));
        }
        if (isset($insurantData->gender)) {
            $insurat->setGender($filter->sanitize(
                $insurantData->gender,
                ['striptags', 'trim']
            ));
        }
        if (isset($insurantData->birthdate)) {
            $insurat->setBirthdate($filter->sanitize(
                $insurantData->birthdate,
                ['striptags', 'trim']
            ));
        }
        $insurat->setCreated(date('Y-m-d H:i:s'));
        $insurat->save();

        return $insurat;
    }
}
