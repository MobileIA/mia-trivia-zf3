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
     * @param int $userId
     * @param int $triviaId
     * @return boolean
     */
    public function alreadyInTrivia($userId, $triviaId)
    {
        $row = $this->fetchByTrivia($userId, $triviaId);
        if($row === null){
            return false;
        }
        return true;
    }
    /**
     * Devuelve el ID de la opcion seleccionada por el usuario
     * @param int $userId
     * @param int $triviaId
     * @return int
     */
    public function voteByTrivia($userId, $triviaId)
    {
        $row = $this->fetchByTrivia($userId, $triviaId);
        if($row === null){
            return -1;
        }
        return $row->option_id;
    }
    /**
     * Obtiene el registro de la votación del usuario
     * @param int $userId
     * @param int $triviaId
     * @return Vote
     */
    public function fetchByTrivia($userId, $triviaId)
    {
        return $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) use($userId, $triviaId) {
            $select->join('trivia_option', 'trivia_option.id = trivia_vote.option_id', array('trivia_id'));
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('trivia_vote.user_id = ?', $userId));
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('trivia_option.trivia_id = ?', $triviaId));
        })->current();
    }
    /**
     * Obtener las personas que votaron
     * @param int $triviaId
     * @param int $optionId
     * @return array
     */
    public function fetchAllByTrivia($triviaId, $optionId = -1)
    {
        // Crear Select
        $select = $this->tableGateway->getSql()->select();
        $select->join('mia_user', 'mia_user.id = trivia_vote.user_id', array('firstname', 'lastname', 'email'));
        $select->join('trivia_option', 'trivia_option.id = trivia_vote.option_id', array('trivia_id'));
        $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('trivia_id = ?', $triviaId));
        if($optionId > 0){
            $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('option_id = ?', $optionId));
        }
        $select->order('trivia_vote.id ASC');
        // Devolver resultado
        return $this->executeQuery($select);
    }
}