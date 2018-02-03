<?php

namespace MIATrivia\Entity;

class Option extends \MIABase\Entity\Base implements \Zend\InputFilter\InputFilterAwareInterface
{
    /**
     * @var int
     */
    public $trivia_id = null;

    /**
     * @var string
     */
    public $title = null;

    /**
     * @var int
     */
    public $total = null;

    /**
     * @var int
     */
    public $is_correct = null;
    /**
     *
     * @var boolean
     */
    protected $hasCreatedAt = false;
    /**
     *
     * @var boolean
     */
    protected $hasUpdatedAt = false;

    public function toArray()
    {
        $data = parent::toArray();
        $data['trivia_id'] = $this->trivia_id;
        $data['title'] = $this->title;
        $data['total'] = $this->total;
        $data['is_correct'] = $this->is_correct;
        return $data;
    }

    public function exchangeArray(array $data)
    {
        parent::exchangeArray($data);
        $this->trivia_id = (!empty($data['trivia_id'])) ? $data['trivia_id'] : 0;
        $this->title = (!empty($data['title'])) ? $data['title'] : '';
        $this->total = (!empty($data['total'])) ? $data['total'] : 0;
        $this->is_correct = (!empty($data['is_correct'])) ? $data['is_correct'] : 0;
    }

    public function exchangeObject($data)
    {
        parent::exchangeObject($data);
        $this->trivia_id = $data->trivia_id;
        $this->title = $data->title;
        $this->total = $data->total;
        $this->is_correct = $data->is_correct;
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }
                
        $inputFilter = new \Zend\InputFilter\InputFilter();
        $inputFilter->add([
                    'name' => 'trivia_id',
                    'required' => true,
                    'filters' => [
                        ['name' => \Zend\Filter\ToInt::class],
                    ],
                ]);
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
                                'max' => 100,
                            ],
                        ],
                    ],
                ]);
        $inputFilter->add([
                    'name' => 'total',
                    'required' => false,
                    'filters' => [
                        ['name' => \Zend\Filter\ToInt::class],
                    ],
                ]);
        $inputFilter->add([
                    'name' => 'is_correct',
                    'required' => false,
                    'filters' => [
                        ['name' => \Zend\Filter\ToInt::class],
                    ],
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