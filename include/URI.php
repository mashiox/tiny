<?php

/**
 * A URI hashing and hexify object.
 *
 * @author Matt Walther
 */
class URI {
    private $uri,
            $hash,
            $hex;
    
    public function __construct($s) {
        $this->uri = $s;
        $this->hash = hash('adler32', $this->uri);
        $this->hex = bin2hex($this->hash);
    }
     
    public function setURI($s) {
        $this->uri = $s;
    }
    
    public function getURI() {
        return $this->uri;
    }
    
    public function getHash() {
        return $this->hash;
    }
    
    public function getHex() {
        return $this->hex;
    }
}
