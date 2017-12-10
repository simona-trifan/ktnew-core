<?php
namespace Insurant\Models\Validators;

use Phalcon\Validation;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Date;
use Phalcon\Validation\Validator\StringLength;

class InsurantValidator extends Validation
{
    public function initialize()
    {
        $this->add(
            'gender',
            new InclusionIn(
                [
                    'domain' => ['m', 'f'],
                    'message' => 'Gender must be "m" or "f"'
                ]
            )
        );

        $this->add(
            ['birthdate', 'created'],
            new Date(
                [
                    'format' => [
                        'birthdate' => 'Y-m-d',
                        'created' => 'Y-m-d H:i:s'
                    ],
                    'message' => [
                        'birthdate' => 'Invalid birthdate',
                        'created' => 'Invalid created time'
                    ],
                    'allowEmpty' => true
                ]
            )
        );

        $this->add(
            ['firstname', 'lastname'],
            new StringLength(
                [
                    'max' => [
                        'firstname' => 255,
                        'lastname' => 255
                    ],
                    'min' => [
                        'firstname' => 2,
                        'lastname' => 2
                    ],
                    'messageMaximum' => [
                        'firstname' => 'Firstname cannot be longer that 255 characters',
                        'lastname' => 'Lastname cannot be longer that 255 characters'
                    ],
                    'messageMinimum' => [
                        'firstname' => 'Firstname should be longer than 2 characters',
                        'lastname' => 'Lastname should be longer than 2 characters'
                    ]
                ]
            )
        );
    }
}