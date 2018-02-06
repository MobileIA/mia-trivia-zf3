<?php

namespace MIATrivia\Entity;

class Trivia extends \MIABase\Entity\Base implements \Zend\InputFilter\InputFilterAwareInterface
{
    /**
     * @var string
     */
    public $title = null;

    /**
     * @var string
     */
    public $caption = null;

    /**
     * @var string
     */
    public $photo = null;

    /**
     * @var \Datetime
     */
    public $start_date = null;

    /**
     * @var \Datetime
     */
    public $end_date = null;

    public function toArray()
    {
        $data = parent::toArray();
        $data['title'] = $this->title;
        $data['caption'] = $this->caption;
        $data['photo'] = $this->photo;
        $data['start_date'] = $this->start_date;
        $data['end_date'] = $this->end_date;
        return $data;
    }

    public function exchangeArray(array $data)
    {
        parent::exchangeArray($data);
        $this->title = (!empty($data['title'])) ? $data['title'] : '';
        $this->caption = (!empty($data['caption'])) ? $data['caption'] : '';
        $this->photo = (!empty($data['photo'])) ? $data['photo'] : '';
        $this->start_date = (!empty($data['start_date'])) ? $data['start_date'] : '';
        $this->end_date = (!empty($data['end_date'])) ? $data['end_date'] : '';
    }

    public function exchangeObject($data)
    {
        parent::exchangeObject($data);
        $this->title = $data->title;
        $this->caption = $data->caption;
        $this->photo = $data->photo;
        $this->start_date = $data->start_date;
        $this->end_date = $data->end_date;
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }
                
        $inputFilter = new \Zend\InputFilter\InputFilter();
        $inputFilter->add([
                    'name' => 'title',
                    'required' => true,
                    'filters' => [
                        ['name' => \Zend\Filter\StripTags::class],
                        ['name' => \Zend\Filter\StringTrim::class],
                    ],
                    'validators' => [
                        [
                            'name' => \Zend\Validator\StringLength::class,
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 1000,
                            ],
                        ],
                    ],
                ]);
        $inputFilter->add([
                    'name' => 'caption',
                    'required' => false,
                    'filters' => [
                        ['name' => \Zend\Filter\StripTags::class],
                        ['name' => \Zend\Filter\StringTrim::class],
                    ],
                    'validators' => [
                        [
                            'name' => \Zend\Validator\StringLength::class,
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                    ],
                ]);
        $inputFilter->add([
                    'name' => 'photo',
                    'required' => false,
                    'filters' => [
                        ['name' => \Zend\Filter\StripTags::class],
                        ['name' => \Zend\Filter\StringTrim::class],
                    ],
                    'validators' => [
                        [
                            'name' => \Zend\Validator\StringLength::class,
                            'options' => [
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 100,
                            ],
                        ],
                    ],
                ]);
        $inputFilter->add([
                    'name' => 'start_date',
                    'required' => true
                ]);
        $inputFilter->add([
                    'name' => 'end_date',
                    'required' => true
                ]);
        $inputFilter->add([
                    'name' => 'options',
                    'required' => false
                ]);
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }

    public function setInputFilter(\Zend\InputFilter\InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
                    '%s does not allow injection of an alternate input filter',
                    __CLASS__
                ));
    }
}