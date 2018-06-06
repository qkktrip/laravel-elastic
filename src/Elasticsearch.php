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
        try {
            $params = [
                'index' => $this->_index,
                'type'  => $type,
                'body'  => $body
            ];

            return $this->getClient()->search($params);
        } catch (\Exception $e) {
            return json_decode($e->getMessage(), true);
        }
    }

    public function index($type, $id, $body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'type'  => $type,
                'id'    => $id,
                'body'  => $body
            ];

            return $this->getClient()->index($params);
        } catch (\Exception $e) {
            return json_decode($e->getMessage(), true);
        }
    }

    public function getMapping($type)
    {
        try {
            $params = [
                'index' => $this->_index,
                'type'  => $type,
            ];

            return $this->getClient()->indices()->getMapping($params);
        } catch (\Exception $e) {
            return json_decode($e->getMessage(), true);
        }
    }

    public function putMapping($type, $body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'type'  => $type,
                'body'  => $body
            ];

            return $this->getClient()->indices()->putMapping($params);
        } catch (\Exception $e) {
            return json_decode($e->getMessage(), true);
        }
    }

    public function createIndex($index = null)
    {
        if (empty($index)) {
            $index = $this->_index;
        }

        try {
            $params = [
                'index' => $index
            ];

            return $this->getClient()->indices()->create($params);
        } catch (\Exception $e) {
            return json_decode($e->getMessage(), true);
        }

    }

    public function deleteIndex($index = null)
    {
        if (empty($index)) {
            $index = $this->_index;
        }

        try {
            $params = [
                'index' => $index
            ];

            return $this->getClient()->indices()->delete($params);
        } catch (\Exception $e) {
            return json_decode($e->getMessage(), true);
        }

    }

    public function indices($index)
    {
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