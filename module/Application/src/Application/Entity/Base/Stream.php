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
            $this->data['fields']['events_reference_field'] = $data['events'];
        } elseif (isset($data['_fields']['events'])) {
            $this->data['fields']['events_reference_field'] = null;
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

    /**
     * Set the "events_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Stream The document (fluent interface).
     */
    public function setEvents_reference_field($value)
    {
        if (!isset($this->data['fields']['events_reference_field'])) {
            if (!$this->isNew()) {
                $this->getEvents_reference_field();
                if ($this->isFieldEqualTo('events_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['events_reference_field'] = null;
                $this->data['fields']['events_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('events_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['events_reference_field']) && !array_key_exists('events_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['events_reference_field'] = $this->data['fields']['events_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('events_reference_field', $value)) {
            unset($this->fieldsModified['events_reference_field']);
        }

        $this->data['fields']['events_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "events_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getEvents_reference_field()
    {
        if (!isset($this->data['fields']['events_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['events_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('events_reference_field', $this->data['fields'])) {
                $this->addFieldCache('events');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('events' => 1));
                if (isset($data['events'])) {
                    $this->data['fields']['events_reference_field'] = $data['events'];
                } else {
                    $this->data['fields']['events_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['events_reference_field'];
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
     * Returns the "events" reference.
     *
     * @return \Mandango\Group\ReferenceGroup The reference.
     */
    public function getEvents()
    {
        if (!isset($this->data['referencesMany']['events'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('events');
            }
            $this->data['referencesMany']['events'] = new \Mandango\Group\ReferenceGroup('Application\Entity\Event', $this, 'events_reference_field');
        }

        return $this->data['referencesMany']['events'];
    }

    /**
     * Adds documents to the "events" reference many.
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
     * Removes documents to the "events" reference many.
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
        if (isset($this->data['referencesMany']['events'])) {
            $group = $this->data['referencesMany']['events'];
            $add = $group->getAdd();
            $remove = $group->getRemove();
            if ($add || $remove) {
                $ids = $this->getEvents_reference_field();
                foreach ($add as $document) {
                    $ids[] = $document->getId();
                }
                foreach ($remove as $document) {
                    if (false !== $key = array_search($document->getId(), $ids)) {
                        unset($ids[$key]);
                    }
                }
                $this->setEvents_reference_field($ids ? array_values($ids) : null);
            }
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesMany']['events'])) {
            $group = $this->data['referencesMany']['events'];
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
                $this->getMandango()->getRepository('Application\Entity\Event')->save($documents);
            }
        }
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['referencesMany']['events'])) {
            $this->data['referencesMany']['events']->reset();
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
        if ('events_reference_field' == $name) {
            return $this->setEvents_reference_field($value);
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
        if ('events_reference_field' == $name) {
            return $this->getEvents_reference_field();
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
        if (isset($array['events_reference_field'])) {
            $this->setEvents_reference_field($array['events_reference_field']);
        }
        if (isset($array['events'])) {
            $this->removeEvents($this->getEvents()->all());
            $this->addEvents($array['events']);
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
        if ($withReferenceFields) {
            $array['events_reference_field'] = $this->getEvents_reference_field();
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
                if (isset($this->data['fields']['activity'])) {
                    $query['activity'] = (string) $this->data['fields']['activity'];
                }
                if (isset($this->data['fields']['events_reference_field'])) {
                    $query['events'] = $this->data['fields']['events_reference_field'];
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
                if (isset($this->data['fields']['events_reference_field']) || array_key_exists('events_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['events_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('events_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['events'] = $this->data['fields']['events_reference_field'];
                        } else {
                            $query['$unset']['events'] = 1;
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