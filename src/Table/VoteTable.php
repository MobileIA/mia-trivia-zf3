<?php

namespace MIATrivia\Table;

class VoteTable extends \MIABase\Table\Base
{
    protected $tableName = 'trivia_vote';

    protected $entityClass = \MIATrivia\Entity\Vote::class;
    /**
     * Crea un registro de votación
     * @param int $userId
     * @param int $optionId
     * @return int
     */
    public function add($userId, $optionId)
    {
        $entity = new \MIATrivia\Entity\Vote();
        $entity->user_id = $userId;
        $entity->option_id = $optionId;
        return $this->save($entity);
    }
    /**
     * Devuelve si ya se ha votado en la trivia
     * @param int $triviaId
     * @return boolean
     */
    public function alreadyInTrivia($triviaId)
    {
        $row = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use($triviaId) {
            $select->join('trivia_option', 'trivia_option.id = trivia_vote.option_id', array('trivia_id'));
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('trivia_option.trivia_id = ?', $triviaId));
        })->current();
        if($row === null){
            return false;
        }
        return true;
    }
}