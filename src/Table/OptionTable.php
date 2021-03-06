<?php

namespace MIATrivia\Table;

class OptionTable extends \MIABase\Table\Base
{
    protected $tableName = 'trivia_option';

    protected $entityClass = \MIATrivia\Entity\Option::class;
    /**
     * Crea un registro de opcion
     * @param int $triviaId
     * @param string $title
     * @param int $isCorrect
     * @return int
     */
    public function add($triviaId, $title, $isCorrect = 0)
    {
        $entity = new \MIATrivia\Entity\Option();
        $entity->trivia_id = $triviaId;
        $entity->title = $title;
        $entity->total = 0;
        $entity->is_correct = $isCorrect;
        return $this->save($entity);
    }
    
    public function edit($optionId, $title, $isCorrect = 0)
    {
        $entity = $this->fetchById($optionId);
        $entity->title = $title;
        $entity->is_correct = $isCorrect;
        return $this->save($entity);
    }
    /**
     * Suma un voto a la opción
     * @param int $optionId
     * @return int
     */
    public function sumVote($optionId)
    {
        return $this->tableGateway->update(array('total' => new \Zend\Db\Sql\Predicate\Expression('total+1')), array('id' => $optionId));
    }
    /**
     * 
     * @param int $triviaId
     * @return \MIATrivia\Entity\Option
     */
    public function fetchCorrect($triviaId)
    {
        return $this->tableGateway->select(array('trivia_id' => $triviaId, 'is_correct' => 1))->current();
    }
    /**
     * Obtiene todos las opciones de la trivia
     * @param int $triviaId
     * @return array
     */
    public function fetchAllByTrivia($triviaId)
    {
        return $this->tableGateway->select(array('trivia_id' => $triviaId));
    }
    /**
     * Elimina todos las opciones de la trivia
     * @param int $triviaId
     * @return int
     */
    public function deleteByTrivia($triviaId)
    {
        return $this->tableGateway->delete(array('trivia_id' => $triviaId));
    }
}