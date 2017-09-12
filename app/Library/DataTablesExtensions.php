<?php

namespace App\Library;

/*
 * Extensão PHP que trabalha em conjunto com /js/client/DataTablesExtensions.JS
 * */

trait DataTablesExtensions {

    private $tableButtons = [];

    public $dataTables;
    public $data_info;
    public $data_cols;

    public function __construct()
    {
        $this->dataTablesInit();
    }

    public function dataTablesInit()
    {
        $this->dataTablesConfig();
        $this->setData();
    }

    /*
     * Adicionar parametros em array (que será convertido para json) e trabalhar em conjunto com o Js
     * */
    protected function add($element)
    {
        array_push($this->tableButtons, $element);
        return $this;
    }

    protected function setData()
    {
        $this->dataTables = [
            'columns' => json_encode($this->data_cols),
            'info' => json_encode($this->data_info)
        ];
    }

}