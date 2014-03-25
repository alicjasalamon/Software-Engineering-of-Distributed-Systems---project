<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Event document.
 */
abstract class Event extends \Mandango\Document\EmbeddedDocument
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
        if (isset($data['time'])) {
            $this->data['fields']['time'] = (string) $data['time'];
        } elseif (isset($data['_fields']['time'])) {
            $this->data['fields']['time'] = null;
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
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
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
            if (
                (!isset($this->data['fields']) || !array_key_exists('title', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.title';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['title'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['title'])) {
                $this->data['fields']['title'] = null;
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
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
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
            if (
                (!isset($this->data['fields']) || !array_key_exists('details', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.details';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['details'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['details'])) {
                $this->data['fields']['details'] = null;
            }
        }

        return $this->data['fields']['details'];
    }

    /**
     * Set the "time" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Event The document (fluent interface).
     */
    public function setTime($value)
    {
        if (!isset($this->data['fields']['time'])) {
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
                $this->getTime();
                if ($this->isFieldEqualTo('time', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['time'] = null;
                $this->data['fields']['time'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('time', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['time']) && !array_key_exists('time', $this->fieldsModified)) {
            $this->fieldsModified['time'] = $this->data['fields']['time'];
        } elseif ($this->isFieldModifiedEqualTo('time', $value)) {
            unset($this->fieldsModified['time']);
        }

        $this->data['fields']['time'] = $value;

        return $this;
    }

    /**
     * Returns the "time" field.
     *
     * @return mixed The $name field.
     */
    public function getTime()
    {
        if (!isset($this->data['fields']['time'])) {
            if (
                (!isset($this->data['fields']) || !array_key_exists('time', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.time';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['time'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['time'])) {
                $this->data['fields']['time'] = null;
            }
        }

        return $this->data['fields']['time'];
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
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
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
            if (
                (!isset($this->data['fields']) || !array_key_exists('duration', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.duration';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['duration'] = (int) $data;
                }
            }
            if (!isset($this->data['fields']['duration'])) {
                $this->data['fields']['duration'] = null;
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
            if (($rap = $this->getRootAndPath()) && !$rap['root']->isNew()) {
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
            if (
                (!isset($this->data['fields']) || !array_key_exists('state', $this->data['fields']))
                &&
                ($rap = $this->getRootAndPath())
                &&
                !$this->isEmbeddedOneChangedInParent()
                &&
                !$this->isEmbeddedManyNew()
            ) {
                $field = $rap['path'].'.state';
                $rap['root']->addFieldCache($field);
                $collection = $this->getMandango()->getRepository(get_class($rap['root']))->getCollection();
                $data = $collection->findOne(array('_id' => $rap['root']->getId()), array($field => 1));
                foreach (explode('.', $field) as $key) {
                    if (!isset($data[$key])) {
                        $data = null;
                        break;
                    }
                    $data = $data[$key];
                }
                if (null !== $data) {
                    $this->data['fields']['state'] = (string) $data;
                }
            }
            if (!isset($this->data['fields']['state'])) {
                $this->data['fields']['state'] = null;
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
        if ('time' == $name) {
            return $this->setTime($value);
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
        if ('time' == $name) {
            return $this->getTime();
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
        if (isset($array['title'])) {
            $this->setTitle($array['title']);
        }
        if (isset($array['details'])) {
            $this->setDetails($array['details']);
        }
        if (isset($array['time'])) {
            $this->setTime($array['time']);
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
        $array = array();

        $array['title'] = $this->getTitle();
        $array['details'] = $this->getDetails();
        $array['time'] = $this->getTime();
        $array['duration'] = $this->getDuration();
        $array['state'] = $this->getState();

        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave($query, $isNew, $reset = false)
    {
        if (isset($this->data['fields'])) {
            if ($isNew || $reset) {
                $rootQuery = $query;
                $query =& $rootQuery;
                $rap = $this->getRootAndPath();
                if (true === $reset) {
                    $path = array('$set', $rap['path']);
                } elseif ('deep' == $reset) {
                    $path = explode('.', '$set.'.$rap['path']);
                } else {
                    $path = explode('.', $rap['path']);
                }
                foreach ($path as $name) {
                    if (0 === strpos($name, '_add')) {
                        $name = substr($name, 4);
                    }
                    if (!isset($query[$name])) {
                        $query[$name] = array();
                    }
                    $query =& $query[$name];
                }
                if (isset($this->data['fields']['title'])) {
                    $query['title'] = (string) $this->data['fields']['title'];
                }
                if (isset($this->data['fields']['details'])) {
                    $query['details'] = (string) $this->data['fields']['details'];
                }
                if (isset($this->data['fields']['time'])) {
                    $query['time'] = (string) $this->data['fields']['time'];
                }
                if (isset($this->data['fields']['duration'])) {
                    $query['duration'] = (int) $this->data['fields']['duration'];
                }
                if (isset($this->data['fields']['state'])) {
                    $query['state'] = (string) $this->data['fields']['state'];
                }
                unset($query);
                $query = $rootQuery;
            } else {
                $rap = $this->getRootAndPath();
                $documentPath = $rap['path'];
                if (isset($this->data['fields']['title']) || array_key_exists('title', $this->data['fields'])) {
                    $value = $this->data['fields']['title'];
                    $originalValue = $this->getOriginalFieldValue('title');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.title'] = (string) $this->data['fields']['title'];
                        } else {
                            $query['$unset'][$documentPath.'.title'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['details']) || array_key_exists('details', $this->data['fields'])) {
                    $value = $this->data['fields']['details'];
                    $originalValue = $this->getOriginalFieldValue('details');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.details'] = (string) $this->data['fields']['details'];
                        } else {
                            $query['$unset'][$documentPath.'.details'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['time']) || array_key_exists('time', $this->data['fields'])) {
                    $value = $this->data['fields']['time'];
                    $originalValue = $this->getOriginalFieldValue('time');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.time'] = (string) $this->data['fields']['time'];
                        } else {
                            $query['$unset'][$documentPath.'.time'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['duration']) || array_key_exists('duration', $this->data['fields'])) {
                    $value = $this->data['fields']['duration'];
                    $originalValue = $this->getOriginalFieldValue('duration');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.duration'] = (int) $this->data['fields']['duration'];
                        } else {
                            $query['$unset'][$documentPath.'.duration'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['state']) || array_key_exists('state', $this->data['fields'])) {
                    $value = $this->data['fields']['state'];
                    $originalValue = $this->getOriginalFieldValue('state');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set'][$documentPath.'.state'] = (string) $this->data['fields']['state'];
                        } else {
                            $query['$unset'][$documentPath.'.state'] = 1;
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