<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Schedule document.
 */
abstract class Schedule extends \Mandango\Document\EmbeddedDocument
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

        if (isset($data['days'])) {
            $embedded = new \Mandango\Group\EmbeddedGroup('Application\Entity\Day');
            if ($rap = $this->getRootAndPath()) {
                $embedded->setRootAndPath($rap['root'], $rap['path'].'.days');
            }
            $embedded->setSavedData($data['days']);
            $this->data['embeddedsMany']['days'] = $embedded;
        }

        return $this;
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
     * Returns the "days" embedded many.
     *
     * @return \Mandango\Group\EmbeddedGroup The "days" embedded many.
     */
    public function getDays()
    {
        if (!isset($this->data['embeddedsMany']['days'])) {
            $this->data['embeddedsMany']['days'] = $embedded = new \Mandango\Group\EmbeddedGroup('Application\Entity\Day');
            if ($rap = $this->getRootAndPath()) {
                $embedded->setRootAndPath($rap['root'], $rap['path'].'.days');
            }
        }

        return $this->data['embeddedsMany']['days'];
    }

    /**
     * Adds documents to the "days" embeddeds many.
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
     * Removes documents to the "days" embeddeds many.
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
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['embeddedsMany']['days'])) {
            $group = $this->data['embeddedsMany']['days'];
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
        if (isset($array['days'])) {
            $embeddeds = array();
            foreach ($array['days'] as $documentData) {
                $embeddeds[] = $embedded = new \Application\Entity\Day($this->getMandango());
                $embedded->setDocumentData($documentData);
            }
            $this->getDays()->replace($embeddeds);
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


        return $array;
    }

    /**
     * Query for save.
     */
    public function queryForSave($query, $isNew, $reset = false)
    {
        if (true === $reset) {
            $reset = 'deep';
        }
        if (isset($this->data['embeddedsMany'])) {
            if ($isNew) {
                if (isset($this->data['embeddedsMany']['days'])) {
                    foreach ($this->data['embeddedsMany']['days']->getAdd() as $document) {
                        $query = $document->queryForSave($query, $isNew);
                    }
                }
            } else {
                if (isset($this->data['embeddedsMany']['days'])) {
                    $group = $this->data['embeddedsMany']['days'];
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