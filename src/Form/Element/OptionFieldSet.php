<?php

namespace MIATrivia\Form\Element;

/**
 * Description of OptionFieldSet
 *
 * @author matiascamiletti
 */
class OptionFieldSet extends \Zend\Form\Fieldset
{
    /**
     * @param  null|int|string  $name    Optional name for the element
     * @param  array            $options Optional options for the element
     */
    public function __construct($name = null, $options = [])
    {
        parent::__construct($name, $options);
        
        $this->add([
            'name' => 'id',
            'type' => 'hidden'
        ]);
        $this->add([
            'name' => 'title',
            'type' => 'text',
            'options' => [
                'label' => 'Titulo',
            ],
            'attributes' => [
                //'required' => 'required',
                'class' => 'input_option_title',
            ],
        ]);
        $this->add([
            'name' => 'is_correct',
            'type' => 'select',
            'options' => [
                'label' => '¿Es la respuesta correcta?',
                'value_options' => array(0 => 'NO', 1 => 'SI'),
            ],
            'attributes' => [
                'placeholder' => '',
                'class' => 'select_is_correct',
                'onchange' => 'return changeIsCorrect(this);'
            ]
        ]);
    }
    
    public function populateValues($data)
    {
        //parent::populateValues($data);
    }
}