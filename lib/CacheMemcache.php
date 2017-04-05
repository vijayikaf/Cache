<?php

class CacheMemcache {

    public $timeToLeave = 600;
    public $isEnabled = false;
    public $cache = null;

    /**
     * constructor
     * @param string $host
     * @param int $port
     * @param boolean $isEnabled required
     * @author Rajneesh Singh <rajneesh.hlm@gmail.com>
     */
    public function __construct($host = 'localhost', $port = 11211, $isEnabled) {
        if (class_exists('Memcached')) {
            $this->cache = new Memcached();
            $this->cache->addServer($host, $port);
            $this->isEnabled = true;
        }else{
            die('Memcached not installed');
        }
    }

    /**
     * get data from cache server
     * @param string $cacheKey required
     * @author Rajneesh Singh <rajneesh.hlm@gmail.com>
     * @return cachedData or null
     */
    public function getData($cacheKey) {
        if (empty($cacheKey)) {
            return null;
        }
        $cacheData = $this->cache->get($cacheKey);
        if (!$cacheData) {
            return null;
        } else {
            return $cacheData;
        }
    }

    /**
     * save data to cache server
     * @param string $cacheKey required
     * @param string $cacheData required
     * @author Rajneesh Singh <rajneesh.hlm@gmail.com>
     * @return collection or error
     */
    public function setData($cacheKey, $cacheData) {
        if (empty($cacheKey) || empty($cacheData)) {
            return false;
        }

        return $cacheData = $this->cache->set($cacheKey, $cacheData, $this->timeToLeave);
    }

    /**
     * delete data from cache server
     * @param string $cacheKey required
     * @author Rajneesh Singh <rajneesh.hlm@gmail.com>
     * @return collection or error
     */
    function delData($cacheKey) {
        if (empty($cacheKey)) {
            return false;
        }
        return $this->cache->delete($cacheKey);
    }

}
