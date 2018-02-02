<?php

namespace MIATrivia\Form;

class Trivia extends \MIABase\Form\Base
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct('trivia', $options);

        $this->add([
                'name' => 'title',
                'type' => 'text',
                'options' => [
                    'label' => 'Title'
                ],
                'attributes' => [
                    'placeholder' => 'Escribe un Title'
                ]
            ]);
        $this->add([
                'name' => 'caption',
                'type' => 'text',
                'options' => [
                    'label' => 'Caption'
                ],
                'attributes' => [
                    'placeholder' => 'Escribe un Caption'
                ]
            ]);
        $this->add([
                'name' => 'photo',
                'type' => 'text',
                'options' => [
                    'label' => 'Photo'
                ],
                'attributes' => [
                    'placeholder' => 'Escribe un Photo'
                ]
            ]);
        $this->add([
                'name' => 'start_date',
                'type' => 'datetime',
                'options' => [
                    'label' => 'Start date',
                    'format' => 'Y-m-d H:i:s'
                ]
            ]);
        $this->add([
                'name' => 'end_date',
                'type' => 'datetime',
                'options' => [
                    'label' => 'End date',
                    'format' => 'Y-m-d H:i:s'
                ]
            ]);
        $this->add([
                    'name' => 'submit',
                    'type' => 'submit',
                    'attributes' => [
                        'value' => 'Enviar',
                        'id'    => 'submitbutton',
                    ],
                ]);
    }
}