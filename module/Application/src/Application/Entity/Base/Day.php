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
            $this->data['fields']['streams_reference_field'] = $data['streams'];
        } elseif (isset($data['_fields']['streams'])) {
            $this->data['fields']['streams_reference_field'] = null;
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

    /**
     * Set the "streams_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Day The document (fluent interface).
     */
    public function setStreams_reference_field($value)
    {
        if (!isset($this->data['fields']['streams_reference_field'])) {
            if (!$this->isNew()) {
                $this->getStreams_reference_field();
                if ($this->isFieldEqualTo('streams_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['streams_reference_field'] = null;
                $this->data['fields']['streams_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('streams_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['streams_reference_field']) && !array_key_exists('streams_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['streams_reference_field'] = $this->data['fields']['streams_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('streams_reference_field', $value)) {
            unset($this->fieldsModified['streams_reference_field']);
        }

        $this->data['fields']['streams_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "streams_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getStreams_reference_field()
    {
        if (!isset($this->data['fields']['streams_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['streams_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('streams_reference_field', $this->data['fields'])) {
                $this->addFieldCache('streams');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('streams' => 1));
                if (isset($data['streams'])) {
                    $this->data['fields']['streams_reference_field'] = $data['streams'];
                } else {
                    $this->data['fields']['streams_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['streams_reference_field'];
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
     * Returns the "streams" reference.
     *
     * @return \Mandango\Group\ReferenceGroup The reference.
     */
    public function getStreams()
    {
        if (!isset($this->data['referencesMany']['streams'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('streams');
            }
            $this->data['referencesMany']['streams'] = new \Mandango\Group\ReferenceGroup('Application\Entity\Stream', $this, 'streams_reference_field');
        }

        return $this->data['referencesMany']['streams'];
    }

    /**
     * Adds documents to the "streams" reference many.
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
     * Removes documents to the "streams" reference many.
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
     * Update the value of the reference fields.
     */
    public function updateReferenceFields()
    {
        if (isset($this->data['referencesMany']['streams'])) {
            $group = $this->data['referencesMany']['streams'];
            $add = $group->getAdd();
            $remove = $group->getRemove();
            if ($add || $remove) {
                $ids = $this->getStreams_reference_field();
                foreach ($add as $document) {
                    $ids[] = $document->getId();
                }
                foreach ($remove as $document) {
                    if (false !== $key = array_search($document->getId(), $ids)) {
                        unset($ids[$key]);
                    }
                }
                $this->setStreams_reference_field($ids ? array_values($ids) : null);
            }
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesMany']['streams'])) {
            $group = $this->data['referencesMany']['streams'];
            $documents = array();
            foreach ($group->getAdd() as $document) {
                $documents[] = $document;
            }
            if ($group->isSavedInitialized()) {
                foreach ($group->getSaved() as $document) {
                    $documents[] = $document;
                }
            }
            if ($documents) {
                $this->getMandango()->getRepository('Application\Entity\Stream')->save($documents);
            }
        }
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['referencesMany']['streams'])) {
            $this->data['referencesMany']['streams']->reset();
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
        if ('streams_reference_field' == $name) {
            return $this->setStreams_reference_field($value);
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
        if ('streams_reference_field' == $name) {
            return $this->getStreams_reference_field();
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
        if (isset($array['streams_reference_field'])) {
            $this->setStreams_reference_field($array['streams_reference_field']);
        }
        if (isset($array['streams'])) {
            $this->removeStreams($this->getStreams()->all());
            $this->addStreams($array['streams']);
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
        if ($withReferenceFields) {
            $array['streams_reference_field'] = $this->getStreams_reference_field();
        }

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
                if (isset($this->data['fields']['streams_reference_field'])) {
                    $query['streams'] = $this->data['fields']['streams_reference_field'];
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
                if (isset($this->data['fields']['streams_reference_field']) || array_key_exists('streams_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['streams_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('streams_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['streams'] = $this->data['fields']['streams_reference_field'];
                        } else {
                            $query['$unset']['streams'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }

        return $query;
    }
}