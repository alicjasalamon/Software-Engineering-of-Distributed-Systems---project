<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Schedule document.
 */
abstract class Schedule extends \Mandango\Document\Document
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
     * @return \Application\Entity\Schedule The document (fluent interface).
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
        if (isset($data['days'])) {
            $this->data['fields']['days_reference_field'] = $data['days'];
        } elseif (isset($data['_fields']['days'])) {
            $this->data['fields']['days_reference_field'] = null;
        }

        return $this;
    }

    /**
     * Set the "days_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Schedule The document (fluent interface).
     */
    public function setDays_reference_field($value)
    {
        if (!isset($this->data['fields']['days_reference_field'])) {
            if (!$this->isNew()) {
                $this->getDays_reference_field();
                if ($this->isFieldEqualTo('days_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['days_reference_field'] = null;
                $this->data['fields']['days_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('days_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['days_reference_field']) && !array_key_exists('days_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['days_reference_field'] = $this->data['fields']['days_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('days_reference_field', $value)) {
            unset($this->fieldsModified['days_reference_field']);
        }

        $this->data['fields']['days_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "days_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getDays_reference_field()
    {
        if (!isset($this->data['fields']['days_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['days_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('days_reference_field', $this->data['fields'])) {
                $this->addFieldCache('days');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('days' => 1));
                if (isset($data['days'])) {
                    $this->data['fields']['days_reference_field'] = $data['days'];
                } else {
                    $this->data['fields']['days_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['days_reference_field'];
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
     * Returns the "days" reference.
     *
     * @return \Mandango\Group\ReferenceGroup The reference.
     */
    public function getDays()
    {
        if (!isset($this->data['referencesMany']['days'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('days');
            }
            $this->data['referencesMany']['days'] = new \Mandango\Group\ReferenceGroup('Application\Entity\Day', $this, 'days_reference_field');
        }

        return $this->data['referencesMany']['days'];
    }

    /**
     * Adds documents to the "days" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Application\Entity\Schedule The document (fluent interface).
     */
    public function addDays($documents)
    {
        $this->getDays()->add($documents);

        return $this;
    }

    /**
     * Removes documents to the "days" reference many.
     *
     * @param mixed $documents A document or an array or documents.
     *
     * @return \Application\Entity\Schedule The document (fluent interface).
     */
    public function removeDays($documents)
    {
        $this->getDays()->remove($documents);

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
        if (isset($this->data['referencesMany']['days'])) {
            $group = $this->data['referencesMany']['days'];
            $add = $group->getAdd();
            $remove = $group->getRemove();
            if ($add || $remove) {
                $ids = $this->getDays_reference_field();
                foreach ($add as $document) {
                    $ids[] = $document->getId();
                }
                foreach ($remove as $document) {
                    if (false !== $key = array_search($document->getId(), $ids)) {
                        unset($ids[$key]);
                    }
                }
                $this->setDays_reference_field($ids ? array_values($ids) : null);
            }
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesMany']['days'])) {
            $group = $this->data['referencesMany']['days'];
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
                $this->getMandango()->getRepository('Application\Entity\Day')->save($documents);
            }
        }
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['referencesMany']['days'])) {
            $this->data['referencesMany']['days']->reset();
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
        if ('days_reference_field' == $name) {
            return $this->setDays_reference_field($value);
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
        if ('days_reference_field' == $name) {
            return $this->getDays_reference_field();
        }
        if ('days' == $name) {
            return $this->getDays();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\Schedule The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['days_reference_field'])) {
            $this->setDays_reference_field($array['days_reference_field']);
        }
        if (isset($array['days'])) {
            $this->removeDays($this->getDays()->all());
            $this->addDays($array['days']);
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

        if ($withReferenceFields) {
            $array['days_reference_field'] = $this->getDays_reference_field();
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
                if (isset($this->data['fields']['days_reference_field'])) {
                    $query['days'] = $this->data['fields']['days_reference_field'];
                }
            } else {
                if (isset($this->data['fields']['days_reference_field']) || array_key_exists('days_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['days_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('days_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['days'] = $this->data['fields']['days_reference_field'];
                        } else {
                            $query['$unset']['days'] = 1;
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