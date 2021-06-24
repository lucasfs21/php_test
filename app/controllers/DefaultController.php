<?php

namespace App\controllers;

class DefaultController {
    public function view($view, $response) {
        $page = include "../app/views/$view";
        return $response->getBody()->getContents($page);
    }
}