<?php

namespace MIATrivia\Controller;

class TriviaController extends \MIABase\Controller\CrudController
{
    protected $tableName = \MIATrivia\Table\TriviaTable::class;

    protected $formName = \MIATrivia\Form\Trivia::class;

    protected $template = 'mia-layout-elite';

    protected $route = 'trivia';
    
    /**
     * Funcion que se llama despues de guardar 
     * @param \MIATrivia\Entity\Trivia $trivia
     */
    public function modelSaved($trivia)
    {
        // Obtenemos datos enviados
        $data = $this->getRequest()->getPost();
        // Procesamos los dias
        $this->processOptions($data, $trivia->id);
    }
    /**
     * Procesa en el POST las opciones de la trivia
     * @param object $data
     * @param int $triviaId
     */
    protected function processOptions($data, $triviaId)
    {
        // Verificamos si se envio la data correcta y el total
        $count = $data->options_fieldset_count;
        if(!$count){
            return false;
        }
        // Eliminamos las listas
        if($data->options_fieldset_delete != ''){
            // Obtenemos ids
            $ids = explode(',', $data->options_fieldset_delete);
            // Eliminamos
            foreach($ids as $optionId){
                $this->getOptionTable()->deleteById($optionId);
            }
        }
        // Recorremos las opciones enviados
        for($i = 0; $i < $count; $i++){
            // Creamos nombre de la variable
            $var = 'options_fieldset_' . $i;
            // Obtenemos parametros de la entrada
            $params = $data->{$var};
            // verificar si se completaron los datos
            if($params['title'] == ''){
                continue;
            }
            // Buscamos si se esta editando una opcion
            $optionIdEdit = $params['id'];
            // Verificamos si se esta editando
            if($optionIdEdit != ''){
                // Guardamos en la DB la lista
                $this->getOptionTable()->edit($optionIdEdit, $params['title'], $params['is_correct']);
            }else{
                // Guardamos en la DB la lista
                $optionId = $this->getOptionTable()->add($triviaId, $params['title'], $params['is_correct']);
            }
        }
    }
    /**
     * Funcion que se llama despues de editar un registro
     * @param \MIATrivia\Entity\Trivia $old
     * @param \MIATrivia\Entity\Trivia $trivia
     */
    public function modelEdited($old, $trivia)
    {
        // Procesamos los datos extras
        $this->modelSaved($trivia);
    }
    /**
     * Funcion que se ejecuta para configurar el formulario antes de la acción requerida
     * @param \MIABase\Action\Edit $action
     * @param \MIATrivia\Form\Trivia $form
     */
    public function prepareCustomForm($action, $form)
    {
        // Verificamos si es el formulario de edición
        if($action instanceof \MIABase\Action\Edit){
            // Obtenemos el ID de la trivia
            $triviaId = $form->get('id')->getValue();
            // Agregamos las categorias
            $form->get('options')->setValue($this->getOptionTable()->fetchAllByTrivia($triviaId)->toArray());
        }
    }
    /**
     * Funcion que se llama antes de eliminar un registro
     * @param \MIATrivia\Entity\Trivia $trivia
     */
    public function modelDeleted($trivia)
    {
        // Eliminar las opciones de la trivia
        $this->getOptionTable()->deleteByTrivia($trivia->id);
    }
    
    public function columns()
    {
        return array(
          array('type' => 'int', 'title' => 'ID', 'field' => 'id', 'is_search' => true),
          array('type' => 'string', 'title' => 'Titulo', 'field' => 'title', 'is_search' => true),
          //array('type' => 'string', 'title' => 'Caption', 'field' => 'caption', 'is_search' => true),
          //array('type' => 'string', 'title' => 'Photo', 'field' => 'photo', 'is_search' => true),
          array('type' => 'datetime', 'title' => 'Fecha de inicio', 'field' => 'start_date', 'is_search' => true),
          array('type' => 'datetime', 'title' => 'Fecha de finalización', 'field' => 'end_date', 'is_search' => true),
          array('type' => 'actions', 'title' => 'Acciones')
        );
    }

    public function fields()
    {
    }
    
    protected function getStrings()
    {
        return array(
            'title_page' => 'Trivias - Backend',
            'main_title' => 'Trivias',
            'main_caption' => 'Administración de las trivias que se mostraran dentro de la aplicación.',
            'title' => 'Listado de trivias',
            'main_title_add' => 'Crear nueva Trivia',
            'main_caption_add' => 'Completa los campos requeridos.',
        );
    }
    
    /**
     * 
     * @param \MIATrivia\Entity\Trivia $model
     */
    protected function getStringsEdit($model)
    {
        return array(
            'title_page' => 'Trivias - Backend',
            'main_title' => 'Trivias',
            'main_caption' => 'Administración de las trivias que se mostraran dentro de la aplicación.',
            'title' => 'Listado de trivias',
            'main_title_add' => 'Editar Trivia: ' . $model->title,
            'main_caption_add' => 'Completa o edita los campos de la trivia.',
        );
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