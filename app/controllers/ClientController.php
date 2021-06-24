<?php

namespace App\controllers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\models\Client;

class ClientController extends DefaultController {
    public function index(ServerRequestInterface $request, ResponseInterface $response) {
        $clients = Client::all();
        $this->clients = $clients;
        
        return $this->view('client/index.php', $response);
    }

    public function new(ServerRequestInterface $request, ResponseInterface $response) {
        
        return $this->view('client/new.php', $response);
    }

    public function save(ServerRequestInterface $request, ResponseInterface $response) {
        $data = $request->getParsedBody();
        $client = new Client();
        $client->name = $data['name'];
        $client->birthDate = $data['birth_date'];
        $client->gender = $data['gender'];
        $client->zipCode = str_replace('-', '', $data['zip_code']);
        $client->street = $data['street'];
        $client->number = $data['number'];
        $client->neighboorhood = $data['neighboorhood'];
        $client->addAddressDetails = $data['add_address_detail'];
        $client->state = $data['state'];
        $client->city = $data['city'];
        $clientId = $client->save();

        return $response->withRedirect('/clients');
    }

    public function edit(ServerRequestInterface $request, ResponseInterface $response) {
        $clientId = $request->getAttribute('id');
        $client = Client::find($clientId);
        $this->client = $client;
        $birthDate = new \DateTime($this->client->birth_date);
        $birthDate = $birthDate->format('Y-m-d');
        $this->client->birth_date = $birthDate;
        return $this->view('client/edit.php', $response);
    }

    public function update(ServerRequestInterface $request, ResponseInterface $response) {
        $data = $request->getParsedBody();
        $id = $request->getAttribute('id');
        $client = Client::find($id);
        $client->name = $data['name'];
        $client->birthDate = $data['birth_date'];
        $client->gender = $data['gender'];
        $client->zipCode = str_replace('-', '', $data['zip_code']);
        $client->street = $data['street'];
        $client->number = $data['number'];
        $client->neighboorhood = $data['neighboorhood'];
        $client->addAddressDetails = $data['add_address_detail'];
        $client->state = $data['state'];
        $client->city = $data['city'];
        $clientId = $client->save();
        return $response->withRedirect('/clients');
    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response) {
        $id = $request->getAttribute('id');
        $client = Client::find($id);
        $client->delete();
        
        return $response->withRedirect('/clients');
    }
}