<?php

namespace RealDebrid\Request\Torrents;

use RealDebrid\Auth\Token;
use RealDebrid\Request\AbstractRequest;
use RealDebrid\Request\RequestType;

/**
 * Class AddMagnet
 *
 * @package RealDebrid\Request\Torrents
 * @author Valentin GOT
 */
class AddMagnet extends AbstractRequest {
    private $body = array();

    /**
     * Add a magnet link to download
     *
     * @param Token $token Access token
     * @param string $magnet Magnet link
     * @param int|null $host Hoster domain (retrieved from /torrents/availableHosts)
     * @param int|null $split Split size (under max_split_size of concerned hoster retrieved from /torrents/availableHosts)
     */
    public function __construct(Token $token, $magnet, $host = null, $split = null) {
        parent::__construct();

        $this->setToken($token);
        $body['magnet'] = $magnet;
        if (!empty($host))
            $body['host'] = $host;
        if (!empty($split))
            $body['split'] = $split;
    }

    public function getRequestType() {
        return RequestType::POST;
    }

    public function getUri() {
        return "torrents/addMagnet";
    }

    public function getPostBody() {
        return $this->body;
    }
}