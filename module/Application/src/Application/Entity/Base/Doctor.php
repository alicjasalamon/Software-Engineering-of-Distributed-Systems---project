<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Doctor document.
 */
abstract class Doctor extends \Mandango\Document\Document
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
     * @return \Application\Entity\Doctor The document (fluent interface).
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
        if (isset($data['institution'])) {
            $this->data['fields']['institution_reference_field'] = $data['institution'];
        } elseif (isset($data['_fields']['institution'])) {
            $this->data['fields']['institution_reference_field'] = null;
        }
        if (isset($data['user'])) {
            $this->data['fields']['user_reference_field'] = $data['user'];
        } elseif (isset($data['_fields']['user'])) {
            $this->data['fields']['user_reference_field'] = null;
        }

        return $this;
    }

    /**
     * Set the "institution_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Doctor The document (fluent interface).
     */
    public function setInstitution_reference_field($value)
    {
        if (!isset($this->data['fields']['institution_reference_field'])) {
            if (!$this->isNew()) {
                $this->getInstitution_reference_field();
                if ($this->isFieldEqualTo('institution_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['institution_reference_field'] = null;
                $this->data['fields']['institution_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('institution_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['institution_reference_field']) && !array_key_exists('institution_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['institution_reference_field'] = $this->data['fields']['institution_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('institution_reference_field', $value)) {
            unset($this->fieldsModified['institution_reference_field']);
        }

        $this->data['fields']['institution_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "institution_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getInstitution_reference_field()
    {
        if (!isset($this->data['fields']['institution_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['institution_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('institution_reference_field', $this->data['fields'])) {
                $this->addFieldCache('institution');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('institution' => 1));
                if (isset($data['institution'])) {
                    $this->data['fields']['institution_reference_field'] = $data['institution'];
                } else {
                    $this->data['fields']['institution_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['institution_reference_field'];
    }

    /**
     * Set the "user_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Doctor The document (fluent interface).
     */
    public function setUser_reference_field($value)
    {
        if (!isset($this->data['fields']['user_reference_field'])) {
            if (!$this->isNew()) {
                $this->getUser_reference_field();
                if ($this->isFieldEqualTo('user_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['user_reference_field'] = null;
                $this->data['fields']['user_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('user_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['user_reference_field']) && !array_key_exists('user_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['user_reference_field'] = $this->data['fields']['user_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('user_reference_field', $value)) {
            unset($this->fieldsModified['user_reference_field']);
        }

        $this->data['fields']['user_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "user_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getUser_reference_field()
    {
        if (!isset($this->data['fields']['user_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['user_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('user_reference_field', $this->data['fields'])) {
                $this->addFieldCache('user');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('user' => 1));
                if (isset($data['user'])) {
                    $this->data['fields']['user_reference_field'] = $data['user'];
                } else {
                    $this->data['fields']['user_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['user_reference_field'];
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
     * Set the "institution" reference.
     *
     * @param \Application\Entity\Institution|null $value The reference, or null.
     *
     * @return \Application\Entity\Doctor The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Application\Entity\Institution.
     */
    public function setInstitution($value)
    {
        if (null !== $value && !$value instanceof \Application\Entity\Institution) {
            throw new \InvalidArgumentException('The "institution" reference is not an instance of Application\Entity\Institution.');
        }

        $this->setInstitution_reference_field((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['institution'] = $value;

        return $this;
    }

    /**
     * Returns the "institution" reference.
     *
     * @return \Application\Entity\Institution|null The reference or null if it does not exist.
     */
    public function getInstitution()
    {
        if (!isset($this->data['referencesOne']['institution'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('institution');
            }
            if (!$id = $this->getInstitution_reference_field()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Application\Entity\Institution')->findOneById($id)) {
                throw new \RuntimeException('The reference "institution" does not exist.');
            }
            $this->data['referencesOne']['institution'] = $document;
        }

        return $this->data['referencesOne']['institution'];
    }

    /**
     * Set the "user" reference.
     *
     * @param \Application\Entity\User|null $value The reference, or null.
     *
     * @return \Application\Entity\Doctor The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Application\Entity\User.
     */
    public function setUser($value)
    {
        if (null !== $value && !$value instanceof \Application\Entity\User) {
            throw new \InvalidArgumentException('The "user" reference is not an instance of Application\Entity\User.');
        }

        $this->setUser_reference_field((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['user'] = $value;

        return $this;
    }

    /**
     * Returns the "user" reference.
     *
     * @return \Application\Entity\User|null The reference or null if it does not exist.
     */
    public function getUser()
    {
        if (!isset($this->data['referencesOne']['user'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('user');
            }
            if (!$id = $this->getUser_reference_field()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Application\Entity\User')->findOneById($id)) {
                throw new \RuntimeException('The reference "user" does not exist.');
            }
            $this->data['referencesOne']['user'] = $document;
        }

        return $this->data['referencesOne']['user'];
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
        if (isset($this->data['referencesOne']['institution']) && !isset($this->data['fields']['institution_reference_field'])) {
            $this->setInstitution_reference_field($this->data['referencesOne']['institution']->getId());
        }
        if (isset($this->data['referencesOne']['user']) && !isset($this->data['fields']['user_reference_field'])) {
            $this->setUser_reference_field($this->data['referencesOne']['user']->getId());
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesOne']['institution'])) {
            $this->data['referencesOne']['institution']->save();
        }
        if (isset($this->data['referencesOne']['user'])) {
            $this->data['referencesOne']['user']->save();
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
        if ('institution_reference_field' == $name) {
            return $this->setInstitution_reference_field($value);
        }
        if ('user_reference_field' == $name) {
            return $this->setUser_reference_field($value);
        }
        if ('institution' == $name) {
            return $this->setInstitution($value);
        }
        if ('user' == $name) {
            return $this->setUser($value);
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
        if ('institution_reference_field' == $name) {
            return $this->getInstitution_reference_field();
        }
        if ('user_reference_field' == $name) {
            return $this->getUser_reference_field();
        }
        if ('institution' == $name) {
            return $this->getInstitution();
        }
        if ('user' == $name) {
            return $this->getUser();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\Doctor The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['institution_reference_field'])) {
            $this->setInstitution_reference_field($array['institution_reference_field']);
        }
        if (isset($array['user_reference_field'])) {
            $this->setUser_reference_field($array['user_reference_field']);
        }
        if (isset($array['institution'])) {
            $this->setInstitution($array['institution']);
        }
        if (isset($array['user'])) {
            $this->setUser($array['user']);
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
            $array['institution_reference_field'] = $this->getInstitution_reference_field();
        }
        if ($withReferenceFields) {
            $array['user_reference_field'] = $this->getUser_reference_field();
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
                if (isset($this->data['fields']['institution_reference_field'])) {
                    $query['institution'] = $this->data['fields']['institution_reference_field'];
                }
                if (isset($this->data['fields']['user_reference_field'])) {
                    $query['user'] = $this->data['fields']['user_reference_field'];
                }
            } else {
                if (isset($this->data['fields']['institution_reference_field']) || array_key_exists('institution_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['institution_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('institution_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['institution'] = $this->data['fields']['institution_reference_field'];
                        } else {
                            $query['$unset']['institution'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['user_reference_field']) || array_key_exists('user_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['user_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('user_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['user'] = $this->data['fields']['user_reference_field'];
                        } else {
                            $query['$unset']['user'] = 1;
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