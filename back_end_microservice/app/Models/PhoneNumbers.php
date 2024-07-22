<?php

namespace App\Models;

use MongoDB\Client as MongoClient;

class PhoneNumbers
{
    protected $client;
    protected $collection;

    public function __construct()
    {
        $this->client = new MongoClient(env('MONGO_DB_URI'));
        $this->collection = $this->client->selectCollection('phone_numbers', 'numbers');
    }

    //show all saved results
    public function getAll()
    {
            try {
        		return $this->collection->find([], ['projection' => []]); 
		    } catch (\Exception $e) {
		        // Handle specific MongoDB errors if needed
		        throw new \Exception('Failed to retrieve data: ' . $e->getMessage());
		    }
    }

    ///save an individual phone number
    public function savePhoneNumber($phoneNumberData)
    {
        try {
            $this->collection->insertOne($phoneNumberData);
        } catch (\Exception $e) {
            throw new \Exception('Failed to save phone number: ' . $e->getMessage());
        }

    }

    public function deletePhoneNumber($id)
    {
        try {
            $result = $this->collection->deleteOne(['_id' => $id]);
            return $result->getDeletedCount() > 0;
        } catch (\Exception $e) {
            throw new \Exception('Failed to delete phone number: ' . $e->getMessage());
        }
    }

    // Other methods to interact with MongoDB collections can be defined here
}
