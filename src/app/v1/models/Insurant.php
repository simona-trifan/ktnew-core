<?php
namespace Insurant\Models;

use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Insurant\Exceptions\InsurantException;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Regex;
use Insurant\Models\Validators\InsurantValidator;

/**
 * Class Insurant
 *
 * @SWG\Definition(
 *     definition="NewInsurant",
 *     type="object",
 *     required={"firstname", "lastname", "gender"},
 *     @SWG\Property(property="firstname", type="string", description="Firstname", maxLength=255, minLength=2),
 *     @SWG\Property(property="lastname", type="string", description="Lastname", maxLength=255, minLength=2),
 *     @SWG\Property(property="gender", type="string", description="Gender: m, f", maxLength=1),
 *     @SWG\Property(property="birthdate", type="string", format="date", description="Birthdate, Y-m-d format")
 * )
 *
 * @SWG\Definition(
 *     definition="Insurant",
 *     type="object",
 *     required={"id", "firstname", "lastname", "gender", "birthday"}
 * )
 *
 * @package Insurant\Models
 */
class Insurant extends Model
{
    /**
     * @SWG\Property(type="integer", format="int64", description="Insurant unique ID")
     * @var int
     */
    protected $id;

    /**
     * @SWG\Property(type="string", description="Firstname", maxLength=255)
     * @var string
     */
    protected $firstname;

    /**
     * @SWG\Property(type="string", description="Lastname", maxLength=255)
     * @var string
     */
    protected $lastname;

    /**
     * @SWG\Property(type="string", description="Gender: m, f", maxLength=1)
     * @var string
     */
    protected $gender;

    /**
     * @SWG\Property(type="string", format="date", description="Birthdate, Y-m-d format")
     * @var string
     */
    protected $birthdate;

    /**
     * @SWG\Property(type="string", format="dateTime", description="Date and time when insurant was created, Y-m-d H:i:s format")
     * @var string
     */
    protected $created;

    /**
     * @SWG\Property(type="string", format="dateTime", description="Date and time when insurant was last updated, Y-m-d H:i:s format")
     * @var string
     */
    protected $updated;

    /**
     * Set table souce because it differs from the model name
     */
    public function initialize()
    {
        $this->setSource('insurants');
    }

    /**
     * @param int $id
     *
     * @return false|Insurant
     * @throws InsurantException
     */
    public static function getInsurant($id)
    {
        if (!is_numeric($id)) {
            throw new InsurantException('Invalid ID supplied');
        }

        $id = intval($id);
        if ($id <= 0) {
            throw new InsurantException('Invalid ID supplied');
        }

        return self::findFirst(
            [
                'conditions' => 'id = ?1',
                'bind'       => [
                    1 => $id,
                ],
                'bindTypes'  => [
                    Column::BIND_PARAM_INT
                ]
            ]
        );
    }

    public function validation()
    {
        $validation = new InsurantValidator();

        return $this->validate($validation);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Insurant
     */
    public function setId(int $id): Insurant
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     *
     * @return Insurant
     */
    public function setFirstname(string $firstname): Insurant
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     *
     * @return Insurant
     */
    public function setLastname(string $lastname): Insurant
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     *
     * @return Insurant
     */
    public function setGender($gender): Insurant
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param string $birthdate
     *
     * @return Insurant
     */
    public function setBirthdate($birthdate): Insurant
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @param string $created
     *
     * @return Insurant
     */
    public function setCreated(string $created): Insurant
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdated(): string
    {
        return $this->updated;
    }

    /**
     * @param string $updated
     *
     * @return Insurant
     */
    public function setUpdated(string $updated = ''): Insurant
    {
        $this->updated = $updated;

        return $this;
    }
}