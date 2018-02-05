<?php

namespace MIATrivia\Entity;

class Vote extends \MIABase\Entity\Base implements \Zend\InputFilter\InputFilterAwareInterface
{
    /**
     * @var int
     */
    public $user_id = null;
    /**
     * @var int
     */
    public $option_id = null;
    /**
     *
     * @var boolean
     */
    protected $hasUpdatedAt = false;

    public function toArray()
    {
        $data = parent::toArray();
        $data['user_id'] = $this->user_id;
        $data['option_id'] = $this->option_id;
        return $data;
    }

    public function exchangeArray(array $data)
    {
        parent::exchangeArray($data);
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : 0;
        $this->option_id = (!empty($data['option_id'])) ? $data['option_id'] : 0;
    }

    public function exchangeObject($data)
    {
        parent::exchangeObject($data);
        $this->user_id = $data->user_id;
        $this->option_id = $data->option_id;
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }
                
        $inputFilter = new \Zend\InputFilter\InputFilter();
        $inputFilter->add([
                    'name' => 'user_id',
                    'required' => true,
                    'filters' => [
                        ['name' => \Zend\Filter\ToInt::class],
                    ],
                ]);
        $inputFilter->add([
                    'name' => 'option_id',
                    'required' => true,
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