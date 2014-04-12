<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\Patient document.
 */
abstract class Patient extends \Mandango\Document\Document
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
     * @return \Application\Entity\Patient The document (fluent interface).
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
        if (isset($data['firstname'])) {
            $this->data['fields']['firstname'] = (string) $data['firstname'];
        } elseif (isset($data['_fields']['firstname'])) {
            $this->data['fields']['firstname'] = null;
        }
        if (isset($data['lastname'])) {
            $this->data['fields']['lastname'] = (string) $data['lastname'];
        } elseif (isset($data['_fields']['lastname'])) {
            $this->data['fields']['lastname'] = null;
        }
        if (isset($data['email'])) {
            $this->data['fields']['email'] = (string) $data['email'];
        } elseif (isset($data['_fields']['email'])) {
            $this->data['fields']['email'] = null;
        }
        if (isset($data['user'])) {
            $this->data['fields']['user_reference_field'] = $data['user'];
        } elseif (isset($data['_fields']['user'])) {
            $this->data['fields']['user_reference_field'] = null;
        }
        if (isset($data['institution'])) {
            $this->data['fields']['institution_reference_field'] = $data['institution'];
        } elseif (isset($data['_fields']['institution'])) {
            $this->data['fields']['institution_reference_field'] = null;
        }
        if (isset($data['doctor'])) {
            $this->data['fields']['doctor_reference_field'] = $data['doctor'];
        } elseif (isset($data['_fields']['doctor'])) {
            $this->data['fields']['doctor_reference_field'] = null;
        }
        if (isset($data['schedule'])) {
            $embedded = $this->getMandango()->create('Application\Entity\Schedule');
            $embedded->setRootAndPath($this, 'schedule');
            if (isset($data['_fields']['schedule'])) {
                $data['schedule']['_fields'] = $data['_fields']['schedule'];
            }
            $embedded->setDocumentData($data['schedule']);
            $this->data['embeddedsOne']['schedule'] = $embedded;
        }

        return $this;
    }

    /**
     * Set the "firstname" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     */
    public function setFirstname($value)
    {
        if (!isset($this->data['fields']['firstname'])) {
            if (!$this->isNew()) {
                $this->getFirstname();
                if ($this->isFieldEqualTo('firstname', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['firstname'] = null;
                $this->data['fields']['firstname'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('firstname', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['firstname']) && !array_key_exists('firstname', $this->fieldsModified)) {
            $this->fieldsModified['firstname'] = $this->data['fields']['firstname'];
        } elseif ($this->isFieldModifiedEqualTo('firstname', $value)) {
            unset($this->fieldsModified['firstname']);
        }

        $this->data['fields']['firstname'] = $value;

        return $this;
    }

    /**
     * Returns the "firstname" field.
     *
     * @return mixed The $name field.
     */
    public function getFirstname()
    {
        if (!isset($this->data['fields']['firstname'])) {
            if ($this->isNew()) {
                $this->data['fields']['firstname'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('firstname', $this->data['fields'])) {
                $this->addFieldCache('firstname');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('firstname' => 1));
                if (isset($data['firstname'])) {
                    $this->data['fields']['firstname'] = (string) $data['firstname'];
                } else {
                    $this->data['fields']['firstname'] = null;
                }
            }
        }

        return $this->data['fields']['firstname'];
    }

    /**
     * Set the "lastname" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     */
    public function setLastname($value)
    {
        if (!isset($this->data['fields']['lastname'])) {
            if (!$this->isNew()) {
                $this->getLastname();
                if ($this->isFieldEqualTo('lastname', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['lastname'] = null;
                $this->data['fields']['lastname'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('lastname', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['lastname']) && !array_key_exists('lastname', $this->fieldsModified)) {
            $this->fieldsModified['lastname'] = $this->data['fields']['lastname'];
        } elseif ($this->isFieldModifiedEqualTo('lastname', $value)) {
            unset($this->fieldsModified['lastname']);
        }

        $this->data['fields']['lastname'] = $value;

        return $this;
    }

    /**
     * Returns the "lastname" field.
     *
     * @return mixed The $name field.
     */
    public function getLastname()
    {
        if (!isset($this->data['fields']['lastname'])) {
            if ($this->isNew()) {
                $this->data['fields']['lastname'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('lastname', $this->data['fields'])) {
                $this->addFieldCache('lastname');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('lastname' => 1));
                if (isset($data['lastname'])) {
                    $this->data['fields']['lastname'] = (string) $data['lastname'];
                } else {
                    $this->data['fields']['lastname'] = null;
                }
            }
        }

        return $this->data['fields']['lastname'];
    }

    /**
     * Set the "email" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     */
    public function setEmail($value)
    {
        if (!isset($this->data['fields']['email'])) {
            if (!$this->isNew()) {
                $this->getEmail();
                if ($this->isFieldEqualTo('email', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['email'] = null;
                $this->data['fields']['email'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('email', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['email']) && !array_key_exists('email', $this->fieldsModified)) {
            $this->fieldsModified['email'] = $this->data['fields']['email'];
        } elseif ($this->isFieldModifiedEqualTo('email', $value)) {
            unset($this->fieldsModified['email']);
        }

        $this->data['fields']['email'] = $value;

        return $this;
    }

    /**
     * Returns the "email" field.
     *
     * @return mixed The $name field.
     */
    public function getEmail()
    {
        if (!isset($this->data['fields']['email'])) {
            if ($this->isNew()) {
                $this->data['fields']['email'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('email', $this->data['fields'])) {
                $this->addFieldCache('email');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('email' => 1));
                if (isset($data['email'])) {
                    $this->data['fields']['email'] = (string) $data['email'];
                } else {
                    $this->data['fields']['email'] = null;
                }
            }
        }

        return $this->data['fields']['email'];
    }

    /**
     * Set the "user_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
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

    /**
     * Set the "institution_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
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
     * Set the "doctor_reference_field" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     */
    public function setDoctor_reference_field($value)
    {
        if (!isset($this->data['fields']['doctor_reference_field'])) {
            if (!$this->isNew()) {
                $this->getDoctor_reference_field();
                if ($this->isFieldEqualTo('doctor_reference_field', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['doctor_reference_field'] = null;
                $this->data['fields']['doctor_reference_field'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('doctor_reference_field', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['doctor_reference_field']) && !array_key_exists('doctor_reference_field', $this->fieldsModified)) {
            $this->fieldsModified['doctor_reference_field'] = $this->data['fields']['doctor_reference_field'];
        } elseif ($this->isFieldModifiedEqualTo('doctor_reference_field', $value)) {
            unset($this->fieldsModified['doctor_reference_field']);
        }

        $this->data['fields']['doctor_reference_field'] = $value;

        return $this;
    }

    /**
     * Returns the "doctor_reference_field" field.
     *
     * @return mixed The $name field.
     */
    public function getDoctor_reference_field()
    {
        if (!isset($this->data['fields']['doctor_reference_field'])) {
            if ($this->isNew()) {
                $this->data['fields']['doctor_reference_field'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('doctor_reference_field', $this->data['fields'])) {
                $this->addFieldCache('doctor');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('doctor' => 1));
                if (isset($data['doctor'])) {
                    $this->data['fields']['doctor_reference_field'] = $data['doctor'];
                } else {
                    $this->data['fields']['doctor_reference_field'] = null;
                }
            }
        }

        return $this->data['fields']['doctor_reference_field'];
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
     * Set the "user" reference.
     *
     * @param \Application\Entity\User|null $value The reference, or null.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
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
     * Set the "institution" reference.
     *
     * @param \Application\Entity\Institution|null $value The reference, or null.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
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
     * Set the "doctor" reference.
     *
     * @param \Application\Entity\Doctor|null $value The reference, or null.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the class is not an instance of Application\Entity\Doctor.
     */
    public function setDoctor($value)
    {
        if (null !== $value && !$value instanceof \Application\Entity\Doctor) {
            throw new \InvalidArgumentException('The "doctor" reference is not an instance of Application\Entity\Doctor.');
        }

        $this->setDoctor_reference_field((null === $value || $value->isNew()) ? null : $value->getId());

        $this->data['referencesOne']['doctor'] = $value;

        return $this;
    }

    /**
     * Returns the "doctor" reference.
     *
     * @return \Application\Entity\Doctor|null The reference or null if it does not exist.
     */
    public function getDoctor()
    {
        if (!isset($this->data['referencesOne']['doctor'])) {
            if (!$this->isNew()) {
                $this->addReferenceCache('doctor');
            }
            if (!$id = $this->getDoctor_reference_field()) {
                return null;
            }
            if (!$document = $this->getMandango()->getRepository('Application\Entity\Doctor')->findOneById($id)) {
                throw new \RuntimeException('The reference "doctor" does not exist.');
            }
            $this->data['referencesOne']['doctor'] = $document;
        }

        return $this->data['referencesOne']['doctor'];
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
        if (isset($this->data['referencesOne']['user']) && !isset($this->data['fields']['user_reference_field'])) {
            $this->setUser_reference_field($this->data['referencesOne']['user']->getId());
        }
        if (isset($this->data['referencesOne']['institution']) && !isset($this->data['fields']['institution_reference_field'])) {
            $this->setInstitution_reference_field($this->data['referencesOne']['institution']->getId());
        }
        if (isset($this->data['referencesOne']['doctor']) && !isset($this->data['fields']['doctor_reference_field'])) {
            $this->setDoctor_reference_field($this->data['referencesOne']['doctor']->getId());
        }
        if (isset($this->data['embeddedsOne']['schedule'])) {
            $this->data['embeddedsOne']['schedule']->updateReferenceFields();
        }
    }

    /**
     * Save the references.
     */
    public function saveReferences()
    {
        if (isset($this->data['referencesOne']['user'])) {
            $this->data['referencesOne']['user']->save();
        }
        if (isset($this->data['referencesOne']['institution'])) {
            $this->data['referencesOne']['institution']->save();
        }
        if (isset($this->data['referencesOne']['doctor'])) {
            $this->data['referencesOne']['doctor']->save();
        }
        if (isset($this->data['embeddedsOne']['schedule'])) {
            $this->data['embeddedsOne']['schedule']->saveReferences();
        }
    }

    /**
     * Set the "schedule" embedded one.
     *
     * @param \Application\Entity\Schedule|null $value The "schedule" embedded one.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     *
     * @throws \InvalidArgumentException If the value is not an instance of Application\Entity\Schedule or null.
     */
    public function setSchedule($value)
    {
        if (null !== $value && !$value instanceof \Application\Entity\Schedule) {
            throw new \InvalidArgumentException('The "schedule" embedded one is not an instance of Application\Entity\Schedule.');
        }
        if (null !== $value) {
            if ($this instanceof \Mandango\Document\Document) {
                $value->setRootAndPath($this, 'schedule');
            } elseif ($rap = $this->getRootAndPath()) {
                $value->setRootAndPath($rap['root'], $rap['path'].'.schedule');
            }
        }

        if (!\Mandango\Archive::has($this, 'embedded_one.schedule')) {
            $originalValue = isset($this->data['embeddedsOne']['schedule']) ? $this->data['embeddedsOne']['schedule'] : null;
            \Mandango\Archive::set($this, 'embedded_one.schedule', $originalValue);
        } elseif (\Mandango\Archive::get($this, 'embedded_one.schedule') === $value) {
            \Mandango\Archive::remove($this, 'embedded_one.schedule');
        }

        $this->data['embeddedsOne']['schedule'] = $value;

        return $this;
    }

    /**
     * Returns the "schedule" embedded one.
     *
     * @return \Application\Entity\Schedule|null The "schedule" embedded one.
     */
    public function getSchedule()
    {
        if (!isset($this->data['embeddedsOne']['schedule'])) {
            if ($this->isNew()) {
                $this->data['embeddedsOne']['schedule'] = null;
            } elseif (!isset($this->data['embeddedsOne']) || !array_key_exists('schedule', $this->data['embeddedsOne'])) {
                $exists = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId(), 'schedule' => array('$exists' => 1)));
                if ($exists) {
                    $embedded = new \Application\Entity\Schedule($this->getMandango());
                    $embedded->setRootAndPath($this, 'schedule');
                    $this->data['embeddedsOne']['schedule'] = $embedded;
                } else {
                    $this->data['embeddedsOne']['schedule'] = null;
                }
            }
        }

        return $this->data['embeddedsOne']['schedule'];
    }

    /**
     * Resets the groups of the document.
     */
    public function resetGroups()
    {
        if (isset($this->data['embeddedsOne']['schedule'])) {
            $this->data['embeddedsOne']['schedule']->resetGroups();
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
        if ('firstname' == $name) {
            return $this->setFirstname($value);
        }
        if ('lastname' == $name) {
            return $this->setLastname($value);
        }
        if ('email' == $name) {
            return $this->setEmail($value);
        }
        if ('user_reference_field' == $name) {
            return $this->setUser_reference_field($value);
        }
        if ('institution_reference_field' == $name) {
            return $this->setInstitution_reference_field($value);
        }
        if ('doctor_reference_field' == $name) {
            return $this->setDoctor_reference_field($value);
        }
        if ('user' == $name) {
            return $this->setUser($value);
        }
        if ('institution' == $name) {
            return $this->setInstitution($value);
        }
        if ('doctor' == $name) {
            return $this->setDoctor($value);
        }
        if ('schedule' == $name) {
            return $this->setSchedule($value);
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
        if ('firstname' == $name) {
            return $this->getFirstname();
        }
        if ('lastname' == $name) {
            return $this->getLastname();
        }
        if ('email' == $name) {
            return $this->getEmail();
        }
        if ('user_reference_field' == $name) {
            return $this->getUser_reference_field();
        }
        if ('institution_reference_field' == $name) {
            return $this->getInstitution_reference_field();
        }
        if ('doctor_reference_field' == $name) {
            return $this->getDoctor_reference_field();
        }
        if ('user' == $name) {
            return $this->getUser();
        }
        if ('institution' == $name) {
            return $this->getInstitution();
        }
        if ('doctor' == $name) {
            return $this->getDoctor();
        }
        if ('schedule' == $name) {
            return $this->getSchedule();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\Patient The document (fluent interface).
     */
    public function fromArray(array $array)
    {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        }
        if (isset($array['firstname'])) {
            $this->setFirstname($array['firstname']);
        }
        if (isset($array['lastname'])) {
            $this->setLastname($array['lastname']);
        }
        if (isset($array['email'])) {
            $this->setEmail($array['email']);
        }
        if (isset($array['user_reference_field'])) {
            $this->setUser_reference_field($array['user_reference_field']);
        }
        if (isset($array['institution_reference_field'])) {
            $this->setInstitution_reference_field($array['institution_reference_field']);
        }
        if (isset($array['doctor_reference_field'])) {
            $this->setDoctor_reference_field($array['doctor_reference_field']);
        }
        if (isset($array['user'])) {
            $this->setUser($array['user']);
        }
        if (isset($array['institution'])) {
            $this->setInstitution($array['institution']);
        }
        if (isset($array['doctor'])) {
            $this->setDoctor($array['doctor']);
        }
        if (isset($array['schedule'])) {
            $embedded = new \Application\Entity\Schedule($this->getMandango());
            $embedded->fromArray($array['schedule']);
            $this->setSchedule($embedded);
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

        $array['firstname'] = $this->getFirstname();
        $array['lastname'] = $this->getLastname();
        $array['email'] = $this->getEmail();
        if ($withReferenceFields) {
            $array['user_reference_field'] = $this->getUser_reference_field();
        }
        if ($withReferenceFields) {
            $array['institution_reference_field'] = $this->getInstitution_reference_field();
        }
        if ($withReferenceFields) {
            $array['doctor_reference_field'] = $this->getDoctor_reference_field();
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
                if (isset($this->data['fields']['firstname'])) {
                    $query['firstname'] = (string) $this->data['fields']['firstname'];
                }
                if (isset($this->data['fields']['lastname'])) {
                    $query['lastname'] = (string) $this->data['fields']['lastname'];
                }
                if (isset($this->data['fields']['email'])) {
                    $query['email'] = (string) $this->data['fields']['email'];
                }
                if (isset($this->data['fields']['user_reference_field'])) {
                    $query['user'] = $this->data['fields']['user_reference_field'];
                }
                if (isset($this->data['fields']['institution_reference_field'])) {
                    $query['institution'] = $this->data['fields']['institution_reference_field'];
                }
                if (isset($this->data['fields']['doctor_reference_field'])) {
                    $query['doctor'] = $this->data['fields']['doctor_reference_field'];
                }
            } else {
                if (isset($this->data['fields']['firstname']) || array_key_exists('firstname', $this->data['fields'])) {
                    $value = $this->data['fields']['firstname'];
                    $originalValue = $this->getOriginalFieldValue('firstname');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['firstname'] = (string) $this->data['fields']['firstname'];
                        } else {
                            $query['$unset']['firstname'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['lastname']) || array_key_exists('lastname', $this->data['fields'])) {
                    $value = $this->data['fields']['lastname'];
                    $originalValue = $this->getOriginalFieldValue('lastname');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['lastname'] = (string) $this->data['fields']['lastname'];
                        } else {
                            $query['$unset']['lastname'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['email']) || array_key_exists('email', $this->data['fields'])) {
                    $value = $this->data['fields']['email'];
                    $originalValue = $this->getOriginalFieldValue('email');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['email'] = (string) $this->data['fields']['email'];
                        } else {
                            $query['$unset']['email'] = 1;
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
                if (isset($this->data['fields']['doctor_reference_field']) || array_key_exists('doctor_reference_field', $this->data['fields'])) {
                    $value = $this->data['fields']['doctor_reference_field'];
                    $originalValue = $this->getOriginalFieldValue('doctor_reference_field');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['doctor'] = $this->data['fields']['doctor_reference_field'];
                        } else {
                            $query['$unset']['doctor'] = 1;
                        }
                    }
                }
            }
        }
        if (true === $reset) {
            $reset = 'deep';
        }
        if (isset($this->data['embeddedsOne'])) {
            $originalValue = $this->getOriginalEmbeddedOneValue('schedule');
            if (isset($this->data['embeddedsOne']['schedule'])) {
                $resetValue = $reset ? $reset : (!$isNew && $this->data['embeddedsOne']['schedule'] !== $originalValue);
                $query = $this->data['embeddedsOne']['schedule']->queryForSave($query, $isNew, $resetValue);
            } elseif (array_key_exists('schedule', $this->data['embeddedsOne'])) {
                if ($originalValue) {
                    $rap = $originalValue->getRootAndPath();
                    $query['$unset'][$rap['path']] = 1;
                }
            }
        }

        return $query;
    }
}