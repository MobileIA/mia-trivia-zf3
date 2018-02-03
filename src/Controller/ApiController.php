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
     * Servicio para obtener las trivias disponibles
     * @return \Zend\View\Model\JsonModel
     */
    public function listAction()
    {
        // Obtenemos las trivias
        $trivias = $this->getTriviaTable()->fetchAllCurrent($this->getUser()->id);
        // recorremos las trivias
        for($i = 0; $i < count($trivias); $i++){
            $trivias[$i]['options'] = $this->getOptionTable()->fetchAllByTrivia($trivias[$i]['id'])->toArray();
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
}