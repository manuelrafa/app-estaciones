<?php

include_once 'database.php';

class Station extends DataBase {
    public $currentStation;

    
    public function GetStation(int $chipid) {
        return $this->selectQuery("SELECT * FROM estaciones WHERE chipId = " . $chipid)[0];
    }


    public function GetStationList() {
        return $this->selectQuery("SELECT * FROM estaciones");
    }


    public function GetStationData(int $chipid, int $limit) {
        return $this->selectQuery("SELECT * FROM tiempo WHERE chipId = " . $chipid . " ORDER BY fecha DESC LIMIT " . $limit);
    }
}

?> public function NewStation() {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $body = array(
                'errno' => 400,
                'error' => 'Función no válida para el método ' . $_SERVER['REQUEST_METHOD']
            );
            return $body;
        }

        $data = $_POST;
        if (GetStation($data['chipId'])) {
            $body = array(
                'errno' => 400,
                'error' => 'El chipId ya existe.'
            );
            return $body;
        }

        $this->insertQuery('estaciones', $data);
        $body = array(
            'errno' => 200,
            'error' => 'Insertado con éxito.'
        );
        return $body;
            /* if ($this->response->err) {
                # code...
            }
            var_dump($this->response); */
        
    }


    public function NewStationData() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $body = array(
                'errno' => 400,
                'error' => 'Función no válida para el método ' . $_SERVER['REQUEST_METHOD']
            );
            return $body;
        }

        $data = $_POST;
        if (! GetStation($data['chipId'])) {
            $body = array(
                'errno' => 404,
                'error' => 'La estación no existe.'
            );
            return $body;
        }

        $this->insertQuery('tiempo', $data);
        $body = array(
            'errno' => 200,
            'error' => 'Insertado con éxito.'
        );
        return $body;
    }

}

?>