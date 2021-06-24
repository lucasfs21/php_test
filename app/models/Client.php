<?php

namespace App\models;

use Config\Db;

class Client {
    static function all() {
        try {
            $connection = Db::connection();
            $select = "select c.id, c.name, c.gender, c.birth_date, a.id as address_id, a.zip_code, a.street, a.number, a.neighborhood, a.add_address_details, a.state, a.city, a.client_id 
                        from clients as c 
                        inner join address as a
                        where c.id = a.client_id";
            $return = $connection->query($select);
            $clients = $return->fetchAll(\PDO::FETCH_ASSOC);
    
            return $clients;
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    static function find($id) {
        try {
            $obj = new self;
            $connection = Db::connection();
            $select = "select c.id, c.name, c.gender, c.birth_date, a.id as address_id, a.zip_code, a.street, a.number, a.neighborhood, a.add_address_details, a.state, a.city, a.client_id 
                        from clients as c 
                        join address as a on c.id = a.client_id 
                        where c.id = :id and c.id = a.client_id";
            $stmt = $connection->prepare($select);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $client = $stmt->fetch(\PDO::FETCH_OBJ);
            foreach ($client as $key => $value) {
                $obj->{$key} = $value;
            }
            return $obj;
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function save() {
        try {
            $connection = Db::connection();
            if (isset($this->id)) {
                $update = "update clients set `name` = ?, `gender` = ?, `birth_date` = ? WHERE `id` = ?";
                $stmt = $connection->prepare($update);
                $stmt->bindValue(1, $this->name);
                $stmt->bindValue(2, $this->gender);
                $stmt->bindValue(3, $this->birthDate);
                $stmt->bindValue(4, $this->id);
            } else {
                $insert = "insert into clients (`name`,`gender`,`birth_date`) values (?,?,?)";
                $stmt = $connection->prepare($insert);
                $stmt->bindValue(1, $this->name);
                $stmt->bindValue(2, $this->gender);
                $stmt->bindValue(3, $this->birthDate);
            }
            $stmt->execute();
            $clientId = $connection->lastInsertId();
            $this->addressSave($clientId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete() {
        try {
            $connection = Db::connection();
            $delete = "delete from clients where `id`= ?";
            $stmt = $connection->prepare($delete);
            $stmt->bindValue(1, $this->id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function addressSave($clientId) {
        try {
            $connection = Db::connection();
            if (isset($this->address_id)) {
                $update = "update address set `zip_code` = ?,`street` = ?,`number` = ?,`neighborhood` = ?,`add_address_details` = ?,`state` = ?,`city` = ? WHERE `id` = ?";
                $stmt = $connection->prepare($update);
                $stmt->bindValue(1, $this->zipCode);
                $stmt->bindValue(2, $this->street);
                $stmt->bindValue(3, $this->number);
                $stmt->bindValue(4, $this->neighboorhood);
                $stmt->bindValue(5, $this->addAddressDetails);
                $stmt->bindValue(6, $this->state);
                $stmt->bindValue(7, $this->city);
                $stmt->bindValue(8, $this->address_id);
            } else {
                $insert = "insert into address (`zip_code`,`street`,`number`,`neighborhood`,`add_address_details`,`state`,`city`,`client_id`) values (?,?,?,?,?,?,?,?)";
                $stmt = $connection->prepare($insert);
                $stmt->bindValue(1, $this->zipCode);
                $stmt->bindValue(2, $this->street);
                $stmt->bindValue(3, $this->number);
                $stmt->bindValue(4, $this->neighboorhood);
                $stmt->bindValue(5, $this->addAddressDetails);
                $stmt->bindValue(6, $this->state);
                $stmt->bindValue(7, $this->city);
                $stmt->bindValue(8, $clientId);
            }
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    
    }

}