<?php

namespace MIATrivia\Controller;

/**
 * Description of ApiController
 *
 * @author matiascamiletti
 */
class ApiController extends \MIAAuthentication\Controller\AuthCrudController
{
    /**
     * Servicio para realizar una votacion
     * @return \Zend\View\Model\JsonModel
     */
    public function voteAction()
    {
        // Verificar los parametros obligatorios
        $this->checkRequiredParams(array('trivia_id', 'option_id'));
        // Obtener Id de la trivia
        $triviaId = $this->getParam('trivia_id', 0);
        // Obtener ID de la opcion
        $optionId = $this->getParam('option_id', 0);
        // Verificar si ya ha votado en la trivia
        if($this->getVoteTable()->alreadyInTrivia($this->getUser()->id, $triviaId)){
            return $this->executeError(\MIABase\Controller\Api\Error::REQUIRED_PARAMS);
        }
        // Agregamos voto
        $this->getVoteTable()->add($this->getUser()->id, $optionId);
        // Sumamos al total
        $this->getOptionTable()->sumVote($optionId);
        // Devolvemos respuesta correcta
        return $this->executeSuccess(true);
    }
    /**
     * Servicio para obtener las trivias disponibles
     * @return \Zend\View\Model\JsonModel
     */
    public function listAction()
    {
        // Obtenemos las trivias
        $trivias = $this->getTriviaTable()->fetchAllCurrent();
        // recorremos las trivias
        for($i = 0; $i < count($trivias); $i++){
            // Buscar opciones
            $trivias[$i]['options'] = $this->getOptionTable()->fetchAllByTrivia($trivias[$i]['id'])->toArray();
            // Buscar si el usuario ya voto
            $trivias[$i]['vote'] = $this->getVoteTable()->voteByTrivia($this->getUser()->id, $trivias[$i]['id']);
        }
        
        return $this->executeSuccess($trivias);
    }
    
    /**
     * 
     * @return \MIATrivia\Table\TriviaTable
     */
    protected function getTriviaTable()
    {
        return $this->getServiceManager()->get(\MIATrivia\Table\TriviaTable::class);
    }
    /**
     * 
     * @return \MIATrivia\Table\OptionTable
     */
    protected function getOptionTable()
    {
        return $this->getServiceManager()->get(\MIATrivia\Table\OptionTable::class);
    }
    /**
     * 
     * @return \MIATrivia\Table\VoteTable
     */
    protected function getVoteTable()
    {
        return $this->getServiceManager()->get(\MIATrivia\Table\VoteTable::class);
    }
}