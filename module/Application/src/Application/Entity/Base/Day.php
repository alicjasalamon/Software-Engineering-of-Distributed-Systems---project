<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Day document.
 */
abstract class Day extends \Mandango\Document\Document
{
    /**
     * Initializes the document defaults.
     */
    public function initializeDefaults()
    {
    }

    /**
     * Set the document data (hydrate).
     *
     * @param array $data  The document data.
     * @param bool  $clean Whether clean the document.
     *
     * @return \Application\Entity\Day The document (fluent interface).
     */
    public function setDocumentData($data, $clean = false)
    {
        if ($clean) {
            $this->data = array();
            $this->fieldsModified = array();
        }

        if (isset($data['_query_hash'])) {
            $this->addQueryHash($data['_query_hash']);
        }
        if (isset($data['_id'])) {
            $this->setId($data['_id']);
            $this->setIsNew(false);
        }
        if (isset($data['date'])) {
            $this->data['fields']['date'] = (string) $data['date'];
        } elseif (isset($data['_fields']['date'])) {
            $this->data['fields']['date'] = null;
        }
        if (isset($data['streams'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Application\Entity\Stream');
            $embedded->setRootAndPath($this, 'streams');
            $embedded->setSavedData($data['streams']);
            $this->data['embeddedsMany']['streams'] = $embedded;
        }

        return $this;
    }

    /**
     * Set the "date" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Day The document (fluent interface).
     */
    public function setDate($value)
    {
        if (!isset($this->data['fields']['date'])) {
            if (!$this->isNew()) {
                $this->getDate();
                if ($this->isFieldEqualTo('date', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['date'] = null;
                $this->data['fields']['date'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('date', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['date']) && !array_key_exists('date', $this->fieldsModified)) {
            $this->fieldsModified['date'] = $this->data['fields']['date'];
        } elseif ($this->isFieldModifiedEqualTo('date', $value)) {
            unset($this->fieldsModified['date']);
        }

        $this->data['fields']['date'] = $value;

        return $this;
    }

    /**
     * Returns the "date" field.
     *
     * @return mixed The $name field.
     */
    public function getDate()
    {
        if (!isset($this->data['fields']['date'])) {
            if ($this->isNew()) {
                $this->data['fields']['date'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('date', $this->data['fields'])) {
                $this->addFieldCache('date');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('date' => 1));
                if (isset($data['date'])) {
                    $this->data['fields']['date'] = (string) $data['date'];
                } else {
                    $this->data['fields']['date'] = null;
                }
            }
        }

        return $this->data['fields']['date'];
    }

    private function isFieldEqualTo($field, $otherValue)
    {
        $value = $this->data['fields'][$field];

        return $this->isFieldValueEqualTo($value, $otherValue);
    }

    private function isFieldModifiedEqualTo($field, $otherValue)
    {
        $value = $this->fieldsModified[$field];

        return $this->isFieldValueEqualTo($value, $otherValue);
    }

    protected function isFieldValueEqualTo($value, $otherValue)
    {
        if (is_object($value)) {
            return $value == $otherValue;
        }

        return $value === $otherValue;
    }

    /**
     * Process onDelete.
     */
    public function processOnDelete()
    {
    }

    private function processOnDeleteCascade($class, array $criteria)
    {
        $repository = $this->getMandango()->getRepository($class);
        $documents = $repository->createQuery($criteria)->all();
        if (count($documents)) {
            $repository->delete($documents);
        }
    }

    private function processOnDeleteUnset($class, array $criteria, array $update)
    {
        $this->getMandango()->getRepository($class)->update($criteria, $update, array('multiple' => true));
    }

    /**
     * Returns the "streams" embedded many.
     *
     * @return \Mandango\Group\EmbeddedGroup The "streams" embedded many.
     */
    public function getStreams()
    {
        if (!isset($this->data['embeddedsMany']['streams'])) {
            $this->data['embeddedsMany']['streams'] = $embedded = new \Mandango\Group\EmbeddedGroup('Application\Entity\Stream');
            $embedded->setRootAndPath($this, 'streams');
        }

        return $this->data['embeddedsMany']['streams'];
    }

    /**
     * Adds documents to the "streams" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Application\Entity\Day The document (fluent interface).
     */
    public function addStreams($documents)
    {
        $this->getStreams()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "streams" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Application\Entity\Day The document (fluent interface).
     */
    public function removeStreams($documents)
    {
        $this->getStreams()->remove($documents);

        return $this;
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['embeddedsMany']['streams'])) {
            $group = $this->data['embeddedsMany']['streams'];
            foreach (array_merge($group->getAdd(), $group->getRemove()) as $document) {
                $document->resetGroups();
            }
            if ($group->isSavedInitialized()) {
                foreach ($group->getSaved() as $document) {
                    $document->resetGroups();
                }
            }
            $group->reset();
        }
    }

    /**
     * Set a document data value by data name as string.
     *
     * @param string $name  The data name.
     * @param mixed  $value The value.
     *
     * @return mixed the data name setter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function set($name, $value)
    {
        if ('date' == $name) {
            return $this->setDate($value);
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Returns a document data by data name as string.
     *
     * @param string $name The data name.
     *
     * @return mixed The data name getter return value.
     *
     * @throws \InvalidArgumentException If the data name is not valid.
     */
    public function get($name)
    {
        if ('date' == $name) {
            return $this->getDate();
        }
        if ('streams' == $name) {
            return $this->getStreams();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\Day The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['date'])) {
            $this->setDate($array['date']);
        }
        if (isset($array['streams'])) {
            $embeddeds = array();
            foreach ($array['streams'] as $documentData) {
                $embeddeds[] = $embedded = new \Application\Entity\Stream($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getStreams()->replace($embeddeds);
        }

        return $this;
    }

    /**
     * Export the document data to an array.
     *
     * @param Boolean $withReferenceFields Whether include the fields of references or not (false by default).
     *
     * @return array An array with the document data.
     */
    public function toArray($withReferenceFields = false)
    {
        $array = array('id' => $this->getId());

        $array['date'] = $this->getDate();

        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave()
    {
        $isNew = $this->isNew();
        $query = array();
        $reset = false;

        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                if (isset($this->data['fields']['date'])) {
                    $query['date'] = (string) $this->data['fields']['date'];
                }
            } else {
                if (isset($this->data['fields']['date']) || array_key_exists('date', $this->data['fields'])) {
                    $value = $this->data['fields']['date'];
                    $originalValue = $this->getOriginalFieldValue('date');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['date'] = (string) $this->data['fields']['date'];
                        } else {
                            $query['$unset']['date'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }
        if (isset($this->data['embeddedsMany'])) {
            if ($isNew) {
                if (isset($this->data['embeddedsMany']['streams'])) {
                    foreach ($this->data['embeddedsMany']['streams']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
            } else {
                if (isset($this->data['embeddedsMany']['streams'])) {
                    $group = $this->data['embeddedsMany']['streams'];
                    foreach ($group->getSaved() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                    $groupRap = $group->getRootAndPath();
                    foreach ($group->getAdd() as $document) {
                        $q = $document->queryForSave(array(), true);
                        $rap = $document->getRootAndPath();
                        foreach (explode('.', $rap['path']) as $name) {
                            if (0 === strpos($name, '_add')) {
                                $name = substr($name, 4);
                            }
                            $q = $q[$name];
                        }
                        $query['$pushAll'][$groupRap['path']][] = $q;
                    }
                    foreach ($group->getRemove() as $document) {
                        $rap = $document->getRootAndPath();
                        $query['$unset'][$rap['path']] = 1;
                    }
                }
            }
        }

        return $query;
    }
}