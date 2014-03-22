<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Event document.
 */
abstract class Event extends \Mandango\Document\Document
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
     * @return \Application\Entity\Event The document (fluent interface).
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
        if (isset($data['title'])) {
            $this->data['fields']['title'] = (string) $data['title'];
        } elseif (isset($data['_fields']['title'])) {
            $this->data['fields']['title'] = null;
        }
        if (isset($data['details'])) {
            $this->data['fields']['details'] = (string) $data['details'];
        } elseif (isset($data['_fields']['details'])) {
            $this->data['fields']['details'] = null;
        }
        if (isset($data['start'])) {
            $this->data['fields']['start'] = (string) $data['start'];
        } elseif (isset($data['_fields']['start'])) {
            $this->data['fields']['start'] = null;
        }
        if (isset($data['duration'])) {
            $this->data['fields']['duration'] = (int) $data['duration'];
        } elseif (isset($data['_fields']['duration'])) {
            $this->data['fields']['duration'] = null;
        }
        if (isset($data['state'])) {
            $this->data['fields']['state'] = (string) $data['state'];
        } elseif (isset($data['_fields']['state'])) {
            $this->data['fields']['state'] = null;
        }

        return $this;
    }

    /**
     * Set the "title" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function setTitle($value)
    {
        if (!isset($this->data['fields']['title'])) {
            if (!$this->isNew()) {
                $this->getTitle();
                if ($this->isFieldEqualTo('title', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['title'] = null;
                $this->data['fields']['title'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('title', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['title']) && !array_key_exists('title', $this->fieldsModified)) {
            $this->fieldsModified['title'] = $this->data['fields']['title'];
        } elseif ($this->isFieldModifiedEqualTo('title', $value)) {
            unset($this->fieldsModified['title']);
        }

        $this->data['fields']['title'] = $value;

        return $this;
    }

    /**
     * Returns the "title" field.
     *
     * @return mixed The $name field.
     */
    public function getTitle()
    {
        if (!isset($this->data['fields']['title'])) {
            if ($this->isNew()) {
                $this->data['fields']['title'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('title', $this->data['fields'])) {
                $this->addFieldCache('title');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('title' => 1));
                if (isset($data['title'])) {
                    $this->data['fields']['title'] = (string) $data['title'];
                } else {
                    $this->data['fields']['title'] = null;
                }
            }
        }

        return $this->data['fields']['title'];
    }

    /**
     * Set the "details" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function setDetails($value)
    {
        if (!isset($this->data['fields']['details'])) {
            if (!$this->isNew()) {
                $this->getDetails();
                if ($this->isFieldEqualTo('details', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['details'] = null;
                $this->data['fields']['details'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('details', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['details']) && !array_key_exists('details', $this->fieldsModified)) {
            $this->fieldsModified['details'] = $this->data['fields']['details'];
        } elseif ($this->isFieldModifiedEqualTo('details', $value)) {
            unset($this->fieldsModified['details']);
        }

        $this->data['fields']['details'] = $value;

        return $this;
    }

    /**
     * Returns the "details" field.
     *
     * @return mixed The $name field.
     */
    public function getDetails()
    {
        if (!isset($this->data['fields']['details'])) {
            if ($this->isNew()) {
                $this->data['fields']['details'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('details', $this->data['fields'])) {
                $this->addFieldCache('details');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('details' => 1));
                if (isset($data['details'])) {
                    $this->data['fields']['details'] = (string) $data['details'];
                } else {
                    $this->data['fields']['details'] = null;
                }
            }
        }

        return $this->data['fields']['details'];
    }

    /**
     * Set the "start" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function setStart($value)
    {
        if (!isset($this->data['fields']['start'])) {
            if (!$this->isNew()) {
                $this->getStart();
                if ($this->isFieldEqualTo('start', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['start'] = null;
                $this->data['fields']['start'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('start', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['start']) && !array_key_exists('start', $this->fieldsModified)) {
            $this->fieldsModified['start'] = $this->data['fields']['start'];
        } elseif ($this->isFieldModifiedEqualTo('start', $value)) {
            unset($this->fieldsModified['start']);
        }

        $this->data['fields']['start'] = $value;

        return $this;
    }

    /**
     * Returns the "start" field.
     *
     * @return mixed The $name field.
     */
    public function getStart()
    {
        if (!isset($this->data['fields']['start'])) {
            if ($this->isNew()) {
                $this->data['fields']['start'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('start', $this->data['fields'])) {
                $this->addFieldCache('start');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('start' => 1));
                if (isset($data['start'])) {
                    $this->data['fields']['start'] = (string) $data['start'];
                } else {
                    $this->data['fields']['start'] = null;
                }
            }
        }

        return $this->data['fields']['start'];
    }

    /**
     * Set the "duration" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function setDuration($value)
    {
        if (!isset($this->data['fields']['duration'])) {
            if (!$this->isNew()) {
                $this->getDuration();
                if ($this->isFieldEqualTo('duration', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['duration'] = null;
                $this->data['fields']['duration'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('duration', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['duration']) && !array_key_exists('duration', $this->fieldsModified)) {
            $this->fieldsModified['duration'] = $this->data['fields']['duration'];
        } elseif ($this->isFieldModifiedEqualTo('duration', $value)) {
            unset($this->fieldsModified['duration']);
        }

        $this->data['fields']['duration'] = $value;

        return $this;
    }

    /**
     * Returns the "duration" field.
     *
     * @return mixed The $name field.
     */
    public function getDuration()
    {
        if (!isset($this->data['fields']['duration'])) {
            if ($this->isNew()) {
                $this->data['fields']['duration'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('duration', $this->data['fields'])) {
                $this->addFieldCache('duration');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('duration' => 1));
                if (isset($data['duration'])) {
                    $this->data['fields']['duration'] = (int) $data['duration'];
                } else {
                    $this->data['fields']['duration'] = null;
                }
            }
        }

        return $this->data['fields']['duration'];
    }

    /**
     * Set the "state" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function setState($value)
    {
        if (!isset($this->data['fields']['state'])) {
            if (!$this->isNew()) {
                $this->getState();
                if ($this->isFieldEqualTo('state', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['state'] = null;
                $this->data['fields']['state'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('state', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['state']) && !array_key_exists('state', $this->fieldsModified)) {
            $this->fieldsModified['state'] = $this->data['fields']['state'];
        } elseif ($this->isFieldModifiedEqualTo('state', $value)) {
            unset($this->fieldsModified['state']);
        }

        $this->data['fields']['state'] = $value;

        return $this;
    }

    /**
     * Returns the "state" field.
     *
     * @return mixed The $name field.
     */
    public function getState()
    {
        if (!isset($this->data['fields']['state'])) {
            if ($this->isNew()) {
                $this->data['fields']['state'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('state', $this->data['fields'])) {
                $this->addFieldCache('state');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('state' => 1));
                if (isset($data['state'])) {
                    $this->data['fields']['state'] = (string) $data['state'];
                } else {
                    $this->data['fields']['state'] = null;
                }
            }
        }

        return $this->data['fields']['state'];
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
        if ('title' == $name) {
            return $this->setTitle($value);
        }
        if ('details' == $name) {
            return $this->setDetails($value);
        }
        if ('start' == $name) {
            return $this->setStart($value);
        }
        if ('duration' == $name) {
            return $this->setDuration($value);
        }
        if ('state' == $name) {
            return $this->setState($value);
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
        if ('title' == $name) {
            return $this->getTitle();
        }
        if ('details' == $name) {
            return $this->getDetails();
        }
        if ('start' == $name) {
            return $this->getStart();
        }
        if ('duration' == $name) {
            return $this->getDuration();
        }
        if ('state' == $name) {
            return $this->getState();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['details'])) {
            $this->setDetails($array['details']);
        }
        if (isset($array['start'])) {
            $this->setStart($array['start']);
        }
        if (isset($array['duration'])) {
            $this->setDuration($array['duration']);
        }
        if (isset($array['state'])) {
            $this->setState($array['state']);
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

        $array['title'] = $this->getTitle();
        $array['details'] = $this->getDetails();
        $array['start'] = $this->getStart();
        $array['duration'] = $this->getDuration();
        $array['state'] = $this->getState();

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
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
                if (isset($this->data['fields']['details'])) {
                    $query['details'] = (string) $this->data['fields']['details'];
                }
                if (isset($this->data['fields']['start'])) {
                    $query['start'] = (string) $this->data['fields']['start'];
                }
                if (isset($this->data['fields']['duration'])) {
                    $query['duration'] = (int) $this->data['fields']['duration'];
                }
                if (isset($this->data['fields']['state'])) {
                    $query['state'] = (string) $this->data['fields']['state'];
                }
            } else {
                if (isset($this->data['fields']['title']) || array_key_exists('title', $this->data['fields'])) {
                    $value = $this->data['fields']['title'];
                    $originalValue = $this->getOriginalFieldValue('title');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['title'] = (string) $this->data['fields']['title'];
                        } else {
                            $query['$unset']['title'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['details']) || array_key_exists('details', $this->data['fields'])) {
                    $value = $this->data['fields']['details'];
                    $originalValue = $this->getOriginalFieldValue('details');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['details'] = (string) $this->data['fields']['details'];
                        } else {
                            $query['$unset']['details'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['start']) || array_key_exists('start', $this->data['fields'])) {
                    $value = $this->data['fields']['start'];
                    $originalValue = $this->getOriginalFieldValue('start');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['start'] = (string) $this->data['fields']['start'];
                        } else {
                            $query['$unset']['start'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['duration']) || array_key_exists('duration', $this->data['fields'])) {
                    $value = $this->data['fields']['duration'];
                    $originalValue = $this->getOriginalFieldValue('duration');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['duration'] = (int) $this->data['fields']['duration'];
                        } else {
                            $query['$unset']['duration'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['state']) || array_key_exists('state', $this->data['fields'])) {
                    $value = $this->data['fields']['state'];
                    $originalValue = $this->getOriginalFieldValue('state');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['state'] = (string) $this->data['fields']['state'];
                        } else {
                            $query['$unset']['state'] = 1;
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