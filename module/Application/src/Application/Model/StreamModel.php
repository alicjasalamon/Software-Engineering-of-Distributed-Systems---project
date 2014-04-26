<?php

namespace Application\Model;

class StreamModel extends EntityModel {
    
    public function clear() {
        $this->streamRepository()->remove();
    }
    
}
