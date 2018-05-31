<?php


namespace Qkktrip\LaravelElastic;


use Elasticsearch\ClientBuilder;

class Elasticsearch
{
    private $_client;
    private $_config;
    private $_index = 'default';
    private $_host = ['http://localhost:9200'];

    public function __construct($config)
    {
        $this->_config = $config;
        $this->_index = $this->_config['index'] ?? 'default';
        $this->_host = $this->_config['hosts'] ?? ['http://localhost:9200'];
    }

    public function search($type, $body)
    {
        $params = [
            'index' => $this->_index,
            'type' => $type,
            'body' => $body
        ];

        return $this->getClient()->search($params);
    }

    public function index($type, $id, $body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'type' => $type,
                'id' => $id,
                'body' => $body
            ];

            return $this->getClient()->index($params);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getMapping($type)
    {
        try {
            $params = [
                'index' => $this->_index,
                'type' => $type,
            ];

            return $this->getClient()->indices()->getMapping($params);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function putMapping($type, $body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'type' => $type,
                'body' => $body
            ];

            $this->getClient()->indices()->putMapping($params);
            return true;
        } catch (\Exception $e) {
            throw $e;
            return false;
        }
    }

    public function createIndex($index)
    {
        try {
            $params = [
                'index' => $index
            ];

            $this->getClient()->indices()->create($params);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function deleteIndex($index)
    {
        try {
            $params = [
                'index' => $index
            ];

            $this->getClient()->indices()->delete($params);
            return true;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function indices($index){
        $this->index = $index;
    }

    protected function getClient()
    {
        if (!$this->_client) {
            $this->_client = ClientBuilder::create()->setHosts($this->_host)->build();
        }
        return $this->_client;
    }


}