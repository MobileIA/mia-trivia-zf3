<?php

namespace MIATrivia\Controller;

class TriviaController extends \MIABase\Controller\CrudController
{
    protected $tableName = \MIATrivia\Table\TriviaTable::class;

    protected $formName = \MIATrivia\Form\Trivia::class;

    protected $template = 'mia-layout-elite';

    protected $route = 'trivia';

    public function columns()
    {
        return array(
          array('type' => 'int', 'title' => 'ID', 'field' => 'id', 'is_search' => true),
          array('type' => 'string', 'title' => 'Title', 'field' => 'title', 'is_search' => true),
          array('type' => 'string', 'title' => 'Caption', 'field' => 'caption', 'is_search' => true),
          array('type' => 'string', 'title' => 'Photo', 'field' => 'photo', 'is_search' => true),
          array('type' => 'datetime', 'title' => 'Start date', 'field' => 'start_date', 'is_search' => true),
          array('type' => 'datetime', 'title' => 'End date', 'field' => 'end_date', 'is_search' => true),
          array('type' => 'actions', 'title' => 'Acciones')
        );
    }

    public function fields()
    {
    }
}