<?php

namespace Application\Entity;

/**
 * Application\Entity\Day document.
 */
class Day extends \Application\Entity\Base\Day
{
    
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => (string)$this->getId());

        $array['date'] = $this->getDate();
        
        $mandango = $this->getMandango();
        $streamRepository = new StreamRepository($mandango);
        $streamsReferences = $this->getStreams_reference_field();
        $streams = [];
        if($streamsReferences) {
            foreach ($streamsReferences as $streamReference) {
                $stream = $streamRepository->findOneById($streamReference);
                array_push($streams, $stream->toArray(true));
            }
        }
        $array['streams'] = $streams;

        return $array;
    }
    
}