<?php

namespace RealDebrid\Api;
use RealDebrid\Request\Torrents\AddMagnet;
use RealDebrid\Request\Torrents\AvailableHostsRequest;
use RealDebrid\Request\Torrents\InfoRequest;
use RealDebrid\Request\Torrents\TorrentsRequest;

/**
 * Class Torrents
 *
 * @package RealDebrid\Api
 * @author Valentin GOT
 */
class Torrents extends EndPoint {

    /**
     * Get user torrents list
     * Warning: You can not use both offset and page at the same time, page is prioritzed in case it happens.
     *
     * @param bool|false $filter TRUE to list only active torrents; FALSE otherwise
     * @param int $page Pagination system
     * @param int $limit Entries returned per page / request (must be within 0 and 100, default: 50)
     * @param int|null $offset Starting offset (must be within 0 and X-Total-Count HTTP header)
     * @return \stdClass User torrents list
     */
    public function get($filter = false, $page = 1, $limit = 50, $offset = null) {
        return $this->request(new TorrentsRequest($this->token, $filter, $page, $limit, $offset));
    }

    /**
     * Get all informations on the asked torrent
     *
     * @param string $id Torrent ID
     * @return \stdClass Torrent information
     */
    public function torrent($id) {
        return $this->request(new InfoRequest($this->token, $id));
    }

    /**
     * Get available hosts to upload the torrent to
     *
     * @return \stdClass Available hosts
     */
    public function availableHosts() {
        return $this->request(new AvailableHostsRequest($this->token));
    }

    public function addTorrent() {
        //return $this->request();
    }

    /**
     * Add a magnet link to download
     *
     * @param string $magnet Magnet link
     * @param int|null $host Hoster domain (retrieved from /torrents/availableHosts)
     * @param int|null $split Split size (under max_split_size of concerned hoster retrieved from /torrents/availableHosts)
     * @return \stdClass Magnet information
     */
    public function addMagnet($magnet, $host = null, $split = null) {
        return $this->request(new AddMagnet($this->token, $magnet, $host, $split));
    }

    public function selectFiles() {

    }

    public function delete($id) {

    }
}