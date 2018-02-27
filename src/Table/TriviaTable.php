<?php

namespace MIATrivia\Table;

class TriviaTable extends \MIABase\Table\Base
{
    protected $tableName = 'trivia';

    protected $entityClass = \MIATrivia\Entity\Trivia::class;
    /**
     * Devuelve las trivias disponibles en el momento
     * @param int $userId
     * @return array
     */
    public function fetchAllCurrent()
    {
        // Crear Select
        $select = $this->tableGateway->getSql()->select();
        // Buscar las disponibles
        $select->where->addPredicate(new \Zend\Db\Sql\Predicate\Expression('start_date <= NOW() AND end_date >= NOW()'));
        // Ordenar
        $select->order('id DESC');
        // Devolver resultado
        return $this->executeQuery($select);
    }
}