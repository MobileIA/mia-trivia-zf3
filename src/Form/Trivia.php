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
                    'label' => 'Titulo de la trivia'
                ],
                'attributes' => [
                    'placeholder' => 'Escribe el titulo'
                ]
            ]);
        $this->add([
                'name' => 'caption',
                'type' => 'hidden',
                'options' => [
                    'label' => 'Caption'
                ],
                'attributes' => [
                    'placeholder' => 'Escribe un Caption'
                ]
            ]);
        $this->add([
                'name' => 'photo',
                'type' => 'hidden',
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
                    'label' => 'Fecha de inicio',
                    'format' => 'Y-m-d'
                ]
            ]);
        $this->add([
                'name' => 'end_date',
                'type' => 'datetime',
                'options' => [
                    'label' => 'Fecha de finalización',
                    'format' => 'Y-m-d'
                ]
            ]);
        $this->add([
            'type' => \Zend\Form\Element\Collection::class,
            'name' => 'options',
            'options' => [
                'label' => 'Opciones de la trivia:',
                //'count' => 1,
                // Do not allow adding:
                //'allow_add' => false,
                //'should_create_template' => false,
                //'template_placeholder' => '__placeholder__',
                'target_element' => [
                    'type' => Element\OptionFieldSet::class,
                ],
            ],
        ]);
        $this->add([
                    'name' => 'submit',
                    'type' => 'submit',
            'options' => [
                'label' => 'Guardar'
                ],
                    'attributes' => [
                        'value' => 'Enviar',
                        'id'    => 'submitbutton',
                    ],
                ]);
    }
}