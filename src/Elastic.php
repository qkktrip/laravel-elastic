<?php


namespace Qkktrip\LaravelElastic;


use Elasticsearch\ClientBuilder;

class Elastic
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

    /**
     * @param $body
     * @return array
     */
    public function search($body)
    {
        $params = [
            'index' => $this->_index,
            'body' => $body
        ];

        return $this->getClient()->search($params);
    }

    /**
     * @param $params
     * @return array
     * @throws \Exception
     */
    public function bulk($params)
    {
        try {
            $params = [
                'index' => $this->_index,
                'body' => $params
            ];

            return $this->getClient()->bulk($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @param $body
     * @return array
     * @throws \Exception
     */
    public function update($id, $body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'id' => $id,
                'body' => $body
            ];
            return $this->getClient()->update($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @param $body
     * @return array
     * @throws \Exception
     */
    public function index($id, $body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'id' => $id,
                'body' => $body
            ];

            return $this->getClient()->index($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getMapping()
    {
        try {
            $params = [
                'index' => $this->_index
            ];

            return $this->getClient()->indices()->getMapping($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $body
     * @return array
     * @throws \Exception
     */
    public function putMapping($body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'body' => $body
            ];

            return $this->getClient()->indices()->putMapping($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $body
     * @return array
     * @throws \Exception
     */
    public function putSettings($body)
    {
        try {
            $params = [
                'index' => $this->_index,
                'body' => $body
            ];
            return $this->getClient()->indices()->putSettings($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function close()
    {
        try {
            $params = [
                'index' => $this->_index,
            ];

            $this->getClient()->indices()->close($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function open()
    {
        try {
            $params = [
                'index' => $this->_index,
            ];

            $this->getClient()->indices()->open($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param array $body
     * @return array
     * @throws \Exception
     */
    public function createIndex($body = [])
    {
        try {
            $params = [
                'index' => $this->_index,
                'body' => $body
            ];

            return $this->getClient()->indices()->create($params);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @return array
     * @throws \Exception
     */
    public function deleteIndex()
    {
        try {
            $params = [
                'index' => $this->_index
            ];

            return $this->getClient()->indices()->delete($params);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @param string $index
     * @return $this
     */
    public function indices($index = '')
    {
        if (!empty($index)) {
            $this->_index = $index;
        }

        return $this;
    }

    /**
     * @return \Elasticsearch\Client
     */
    protected function getClient()
    {
        if (!$this->_client) {
            $this->_client = ClientBuilder::create()->setHosts($this->_host)->build();
        }
        return $this->_client;
    }


}