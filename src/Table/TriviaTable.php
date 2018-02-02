<?php

namespace MIATrivia\Table;

class TriviaTable extends \MIABase\Table\Base
{
    protected $tableName = 'trivia';

    protected $entityClass = \MIATrivia\Entity\Trivia::class;
}