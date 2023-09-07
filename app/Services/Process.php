<?php
namespace TrueMe\Services;

class Process {
    protected $data = 'default';

    public function getData($param=null)
    {
        $second = 2;
        sleep($second);

        $this->data = "json string";

        return "Xử lý Api sleep ($second) and return data: ". $this->data ." - lan $param";
    }
}
