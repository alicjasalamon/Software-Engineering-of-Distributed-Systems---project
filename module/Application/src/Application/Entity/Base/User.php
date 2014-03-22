<?php

namespace Application\Entity\Base;

/**
 * Base class of Application\Entity\User document.
 */
abstract class User extends \Mandango\Document\Document
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
     * @return \Application\Entity\User The document (fluent interface).
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
        if (isset($data['login'])) {
            $this->data['fields']['login'] = (string) $data['login'];
        } elseif (isset($data['_fields']['login'])) {
            $this->data['fields']['login'] = null;
        }
        if (isset($data['password'])) {
            $this->data['fields']['password'] = (string) $data['password'];
        } elseif (isset($data['_fields']['password'])) {
            $this->data['fields']['password'] = null;
        }
        if (isset($data['email'])) {
            $this->data['fields']['email'] = (string) $data['email'];
        } elseif (isset($data['_fields']['email'])) {
            $this->data['fields']['email'] = null;
        }
        if (isset($data['group'])) {
            $this->data['fields']['group'] = (string) $data['group'];
        } elseif (isset($data['_fields']['group'])) {
            $this->data['fields']['group'] = null;
        }

        return $this;
    }

    /**
     * Set the "firstname" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\User The document (fluent interface).
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
     * @return \Application\Entity\User The document (fluent interface).
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
     * Set the "login" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\User The document (fluent interface).
     */
    public function setLogin($value)
    {
        if (!isset($this->data['fields']['login'])) {
            if (!$this->isNew()) {
                $this->getLogin();
                if ($this->isFieldEqualTo('login', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['login'] = null;
                $this->data['fields']['login'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('login', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['login']) && !array_key_exists('login', $this->fieldsModified)) {
            $this->fieldsModified['login'] = $this->data['fields']['login'];
        } elseif ($this->isFieldModifiedEqualTo('login', $value)) {
            unset($this->fieldsModified['login']);
        }

        $this->data['fields']['login'] = $value;

        return $this;
    }

    /**
     * Returns the "login" field.
     *
     * @return mixed The $name field.
     */
    public function getLogin()
    {
        if (!isset($this->data['fields']['login'])) {
            if ($this->isNew()) {
                $this->data['fields']['login'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('login', $this->data['fields'])) {
                $this->addFieldCache('login');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('login' => 1));
                if (isset($data['login'])) {
                    $this->data['fields']['login'] = (string) $data['login'];
                } else {
                    $this->data['fields']['login'] = null;
                }
            }
        }

        return $this->data['fields']['login'];
    }

    /**
     * Set the "password" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\User The document (fluent interface).
     */
    public function setPassword($value)
    {
        if (!isset($this->data['fields']['password'])) {
            if (!$this->isNew()) {
                $this->getPassword();
                if ($this->isFieldEqualTo('password', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['password'] = null;
                $this->data['fields']['password'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('password', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['password']) && !array_key_exists('password', $this->fieldsModified)) {
            $this->fieldsModified['password'] = $this->data['fields']['password'];
        } elseif ($this->isFieldModifiedEqualTo('password', $value)) {
            unset($this->fieldsModified['password']);
        }

        $this->data['fields']['password'] = $value;

        return $this;
    }

    /**
     * Returns the "password" field.
     *
     * @return mixed The $name field.
     */
    public function getPassword()
    {
        if (!isset($this->data['fields']['password'])) {
            if ($this->isNew()) {
                $this->data['fields']['password'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('password', $this->data['fields'])) {
                $this->addFieldCache('password');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('password' => 1));
                if (isset($data['password'])) {
                    $this->data['fields']['password'] = (string) $data['password'];
                } else {
                    $this->data['fields']['password'] = null;
                }
            }
        }

        return $this->data['fields']['password'];
    }

    /**
     * Set the "email" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\User The document (fluent interface).
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
     * Set the "group" field.
     *
     * @param mixed $value The value.
     *
     * @return \Application\Entity\User The document (fluent interface).
     */
    public function setGroup($value)
    {
        if (!isset($this->data['fields']['group'])) {
            if (!$this->isNew()) {
                $this->getGroup();
                if ($this->isFieldEqualTo('group', $value)) {
                    return $this;
                }
            } else {
                if (null === $value) {
                    return $this;
                }
                $this->fieldsModified['group'] = null;
                $this->data['fields']['group'] = $value;
                return $this;
            }
        } elseif ($this->isFieldEqualTo('group', $value)) {
            return $this;
        }

        if (!isset($this->fieldsModified['group']) && !array_key_exists('group', $this->fieldsModified)) {
            $this->fieldsModified['group'] = $this->data['fields']['group'];
        } elseif ($this->isFieldModifiedEqualTo('group', $value)) {
            unset($this->fieldsModified['group']);
        }

        $this->data['fields']['group'] = $value;

        return $this;
    }

    /**
     * Returns the "group" field.
     *
     * @return mixed The $name field.
     */
    public function getGroup()
    {
        if (!isset($this->data['fields']['group'])) {
            if ($this->isNew()) {
                $this->data['fields']['group'] = null;
            } elseif (!isset($this->data['fields']) || !array_key_exists('group', $this->data['fields'])) {
                $this->addFieldCache('group');
                $data = $this->getRepository()->getCollection()->findOne(array('_id' => $this->getId()), array('group' => 1));
                if (isset($data['group'])) {
                    $this->data['fields']['group'] = (string) $data['group'];
                } else {
                    $this->data['fields']['group'] = null;
                }
            }
        }

        return $this->data['fields']['group'];
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
        if ('firstname' == $name) {
            return $this->setFirstname($value);
        }
        if ('lastname' == $name) {
            return $this->setLastname($value);
        }
        if ('login' == $name) {
            return $this->setLogin($value);
        }
        if ('password' == $name) {
            return $this->setPassword($value);
        }
        if ('email' == $name) {
            return $this->setEmail($value);
        }
        if ('group' == $name) {
            return $this->setGroup($value);
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
        if ('login' == $name) {
            return $this->getLogin();
        }
        if ('password' == $name) {
            return $this->getPassword();
        }
        if ('email' == $name) {
            return $this->getEmail();
        }
        if ('group' == $name) {
            return $this->getGroup();
        }

        throw new \InvalidArgumentException(sprintf('The document data "%s" is not valid.', $name));
    }

    /**
     * Imports data from an array.
     *
     * @param array $array An array.
     *
     * @return \Application\Entity\User The document (fluent interface).
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
        if (isset($array['login'])) {
            $this->setLogin($array['login']);
        }
        if (isset($array['password'])) {
            $this->setPassword($array['password']);
        }
        if (isset($array['email'])) {
            $this->setEmail($array['email']);
        }
        if (isset($array['group'])) {
            $this->setGroup($array['group']);
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
        $array['login'] = $this->getLogin();
        $array['password'] = $this->getPassword();
        $array['email'] = $this->getEmail();
        $array['group'] = $this->getGroup();

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
                if (isset($this->data['fields']['login'])) {
                    $query['login'] = (string) $this->data['fields']['login'];
                }
                if (isset($this->data['fields']['password'])) {
                    $query['password'] = (string) $this->data['fields']['password'];
                }
                if (isset($this->data['fields']['email'])) {
                    $query['email'] = (string) $this->data['fields']['email'];
                }
                if (isset($this->data['fields']['group'])) {
                    $query['group'] = (string) $this->data['fields']['group'];
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
                if (isset($this->data['fields']['login']) || array_key_exists('login', $this->data['fields'])) {
                    $value = $this->data['fields']['login'];
                    $originalValue = $this->getOriginalFieldValue('login');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['login'] = (string) $this->data['fields']['login'];
                        } else {
                            $query['$unset']['login'] = 1;
                        }
                    }
                }
                if (isset($this->data['fields']['password']) || array_key_exists('password', $this->data['fields'])) {
                    $value = $this->data['fields']['password'];
                    $originalValue = $this->getOriginalFieldValue('password');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['password'] = (string) $this->data['fields']['password'];
                        } else {
                            $query['$unset']['password'] = 1;
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
                if (isset($this->data['fields']['group']) || array_key_exists('group', $this->data['fields'])) {
                    $value = $this->data['fields']['group'];
                    $originalValue = $this->getOriginalFieldValue('group');
                    if ($value !== $originalValue) {
                        if (null !== $value) {
                            $query['$set']['group'] = (string) $this->data['fields']['group'];
                        } else {
                            $query['$unset']['group'] = 1;
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