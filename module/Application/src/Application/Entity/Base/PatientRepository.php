<?php

namespace Application\Entity\Base;

/**
 * Base class of repository of Application\Entity\Patient document.
 */
abstract class PatientRepository extends \Mandango\Repository
{
    /**
     * {@inheritdoc}
     */
    public function __construct(\Mandango\Mandango $mandango)
    {
        $this->documentClass = 'Application\Entity\Patient';
        $this->isFile = false;
        $this->collectionName = 'application_entity_patient';

        parent::__construct($mandango);
    }

    /**
     * {@inheritdoc}
     */
    public function idToMongo($id)
    {
        if (!$id instanceof \MongoId) {
            $id = new \MongoId($id);
        }

        return $id;
    }

    /**
     * Save documents.
     *
     * @param mixed $documents          A document or an array of documents.
     * @param array $batchInsertOptions The options for the batch insert operation (optional).
     * @param array $updateOptions      The options for the update operation (optional).
     */
    public function save($documents, array $batchInsertOptions = array(), array $updateOptions = array())
    {
        $repository = $this;

        if (!is_array($documents)) {
            $documents = array($documents);
        }

        $identityMap =& $this->getIdentityMap()->allByReference();
        $collection = $this->getCollection();

        $inserts = array();
        $updates = array();
        foreach ($documents as $document) {
            $document->saveReferences();
            $document->updateReferenceFields();
            if ($document->isNew()) {
                $inserts[spl_object_hash($document)] = $document;
            } else {
                $updates[] = $document;
            }
        }

        // insert
        if ($inserts) {
            foreach ($inserts as $oid => $document) {
                if (!$document->isModified()) {
                    continue;
                }
                $data = $document->queryForSave();
                $data['_id'] = new \MongoId();

                $collection->insert($data);

                $document->setId($data['_id']);
                $document->setIsNew(false);
                $document->clearModified();
                $identityMap[(string) $data['_id']] = $document;

            }
        }

        // updates
        foreach ($updates as $document) {
            if ($document->isModified()) {
                $query = $document->queryForSave();
                $collection->update(array('_id' => $this->idToMongo($document->getId())), $query, $updateOptions);
                $document->clearModified();
            }
        }
    }

    /**
     * Delete documents.
     *
     * @param mixed $documents A document or an array of documents.
     */
    public function delete($documents)
    {
        if (!is_array($documents)) {
            $documents = array($documents);
        }

        $ids = array();
        foreach ($documents as $document) {
            $ids[] = $id = $this->idToMongo($document->getId());
        }

        foreach ($documents as $document) {
            $document->processOnDelete();
        }

        $this->getCollection()->remove(array('_id' => array('$in' => $ids)));


        $identityMap =& $this->getIdentityMap()->allByReference();
        foreach ($documents as $document) {
            unset($identityMap[(string) $document->getId()]);
            $document->setIsNew(true);
            $document->setId(null);
        }
    }

    /**
     * Ensure the indexes.
     */
    public function ensureIndexes()
    {
    }

    /**
     * Fixes the missing references.
     */
    public function fixMissingReferences($documentsPerBatch = 1000)
    {
        $skip = 0;
        do {
            $cursor = $this->getCollection()->find(array('user' => array('$exists' => 1)), array('user' => 1))->limit($documentsPerBatch)->skip($skip);
            $ids = array_unique(array_values(array_map(function ($result) { return $result['user']; }, iterator_to_array($cursor))));
            if (count($ids)) {
                $collection = $this->getMandango()->getRepository('Application\Entity\User')->getCollection();
                $referenceCursor = $collection->find(array('_id' => array('$in' => $ids)), array('_id' => 1));
                $referenceIds =  array_values(array_map(function ($result) { return $result['_id']; }, iterator_to_array($referenceCursor)));

                if ($idsDiff = array_diff($ids, $referenceIds)) {
                    $this->remove(array('user' => array('$in' => $idsDiff)), array('multiple' => 1));
                }
            }

            $skip += $documentsPerBatch;
        } while(count($ids));
        $skip = 0;
        do {
            $cursor = $this->getCollection()->find(array('institution' => array('$exists' => 1)), array('institution' => 1))->limit($documentsPerBatch)->skip($skip);
            $ids = array_unique(array_values(array_map(function ($result) { return $result['institution']; }, iterator_to_array($cursor))));
            if (count($ids)) {
                $collection = $this->getMandango()->getRepository('Application\Entity\Institution')->getCollection();
                $referenceCursor = $collection->find(array('_id' => array('$in' => $ids)), array('_id' => 1));
                $referenceIds =  array_values(array_map(function ($result) { return $result['_id']; }, iterator_to_array($referenceCursor)));

                if ($idsDiff = array_diff($ids, $referenceIds)) {
                    $this->remove(array('institution' => array('$in' => $idsDiff)), array('multiple' => 1));
                }
            }

            $skip += $documentsPerBatch;
        } while(count($ids));
        $skip = 0;
        do {
            $cursor = $this->getCollection()->find(array('doctor' => array('$exists' => 1)), array('doctor' => 1))->limit($documentsPerBatch)->skip($skip);
            $ids = array_unique(array_values(array_map(function ($result) { return $result['doctor']; }, iterator_to_array($cursor))));
            if (count($ids)) {
                $collection = $this->getMandango()->getRepository('Application\Entity\Doctor')->getCollection();
                $referenceCursor = $collection->find(array('_id' => array('$in' => $ids)), array('_id' => 1));
                $referenceIds =  array_values(array_map(function ($result) { return $result['_id']; }, iterator_to_array($referenceCursor)));

                if ($idsDiff = array_diff($ids, $referenceIds)) {
                    $this->remove(array('doctor' => array('$in' => $idsDiff)), array('multiple' => 1));
                }
            }

            $skip += $documentsPerBatch;
        } while(count($ids));
        $skip = 0;
        do {
            $cursor = $this->getCollection()->find(array('schedule' => array('$exists' => 1)), array('schedule' => 1))->limit($documentsPerBatch)->skip($skip);
            $ids = array_unique(array_values(array_map(function ($result) { return $result['schedule']; }, iterator_to_array($cursor))));
            if (count($ids)) {
                $collection = $this->getMandango()->getRepository('Application\Entity\Schedule')->getCollection();
                $referenceCursor = $collection->find(array('_id' => array('$in' => $ids)), array('_id' => 1));
                $referenceIds =  array_values(array_map(function ($result) { return $result['_id']; }, iterator_to_array($referenceCursor)));

                if ($idsDiff = array_diff($ids, $referenceIds)) {
                    $this->remove(array('schedule' => array('$in' => $idsDiff)), array('multiple' => 1));
                }
            }

            $skip += $documentsPerBatch;
        } while(count($ids));
    }
}