<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Stream document.
 */
abstract class Stream extends \Mandango\Document\Document
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
     * @return \Application\Entity\Stream The document (fluent interface).
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
        if (isset($data['activity'])) {
            $this->data['fields']['activity'] = (string) $data['activity'];
        } elseif (isset($data['_fields']['activity'])) {
            $this->data['fields']['activity'] = null;
        }
        if (isset($data['events'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Application\Entity\Event');
            $embedded->setRootAndPath($this, 'events');
            $embedded->setSavedData($data['events']);
            $this->data['embeddedsMany']['events'] = $embedded;
        }

        return $this;
    }

    /**
     * Set the "activity" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Stream The document (fluent interface).
     */
    public function setActivity($value)
    {
        if (!isset($this->data['fields']['activity'])) {
            if (!$this->isNew()) {
                $this->getActivity();
                if ($this->isFieldEqualTo('activity', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['activity'] = null;
                $this->data['fields']['activity'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('activity', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['activity']) && !array_key_exists('activity', $this->fieldsModified)) {
            $this->fieldsModified['activity'] = $this->data['fields']['activity'];
        } elseif ($this->isFieldModifiedEqualTo('activity', $value)) {
            unset($this->fieldsModified['activity']);
        }

        $this->data['fields']['activity'] = $value;

        return $this;
    }

    /**
     * Returns the "activity" field.
     *
     * @return mixed The $name field.
     */
    public function getActivity()
    {
        if (!isset($this->data['fields']['activity'])) {
            if ($this->isNew()) {
                $this->data['fields']['activity'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('activity', $this->data['fields'])) {
                $this->addFieldCache('activity');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('activity' => 1));
                if (isset($data['activity'])) {
                    $this->data['fields']['activity'] = (string) $data['activity'];
                } else {
                    $this->data['fields']['activity'] = null;
                }
            }
        }

        return $this->data['fields']['activity'];
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
     * Returns the "events" embedded many.
     *
     * @return \Mandango\Group\EmbeddedGroup The "events" embedded many.
     */
    public function getEvents()
    {
        if (!isset($this->data['embeddedsMany']['events'])) {
            $this->data['embeddedsMany']['events'] = $embedded = new \Mandango\Group\EmbeddedGroup('Application\Entity\Event');
            $embedded->setRootAndPath($this, 'events');
        }

        return $this->data['embeddedsMany']['events'];
    }

    /**
     * Adds documents to the "events" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Application\Entity\Stream The document (fluent interface).
     */
    public function addEvents($documents)
    {
        $this->getEvents()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "events" embeddeds many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Application\Entity\Stream The document (fluent interface).
     */
    public function removeEvents($documents)
    {
        $this->getEvents()->remove($documents);

        return $this;
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['embeddedsMany']['events'])) {
            $this->data['embeddedsMany']['events']->reset();
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
        if ('activity' == $name) {
            return $this->setActivity($value);
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
        if ('activity' == $name) {
            return $this->getActivity();
        }
        if ('events' == $name) {
            return $this->getEvents();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\Stream The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['activity'])) {
            $this->setActivity($array['activity']);
        }
        if (isset($array['events'])) {
            $embeddeds = array();
            foreach ($array['events'] as $documentData) {
                $embeddeds[] = $embedded = new \Application\Entity\Event($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getEvents()->replace($embeddeds);
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

        $array['activity'] = $this->getActivity();

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
                if (isset($this->data['fields']['activity'])) {
                    $query['activity'] = (string) $this->data['fields']['activity'];
                }
            } else {
                if (isset($this->data['fields']['activity']) || array_key_exists('activity', $this->data['fields'])) {
                    $value = $this->data['fields']['activity'];
                    $originalValue = $this->getOriginalFieldValue('activity');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['activity'] = (string) $this->data['fields']['activity'];
                        } else {
                            $query['$unset']['activity'] = 1;
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
                if (isset($this->data['embeddedsMany']['events'])) {
                    foreach ($this->data['embeddedsMany']['events']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
            } else {
                if (isset($this->data['embeddedsMany']['events'])) {
                    $group = $this->data['embeddedsMany']['events'];
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