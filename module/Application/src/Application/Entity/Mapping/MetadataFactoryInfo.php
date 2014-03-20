<?php

namespace Application\Entity\Mapping;

class MetadataFactoryInfo
{
    public function getApplicationEntityUserClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_user',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'name' => array(
                    'type' => 'string',
                    'dbName' => 'name',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getApplicationEntityInstitutionClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_institution',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'name' => array(
                    'type' => 'string',
                    'dbName' => 'name',
                ),
            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getApplicationEntityDoctorClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_doctor',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'firstname' => array(
                    'type' => 'string',
                    'dbName' => 'firstname',
                ),
                'lastname' => array(
                    'type' => 'string',
                    'dbName' => 'lastname',
                ),
                'login' => array(
                    'type' => 'string',
                    'dbName' => 'login',
                ),
                'password' => array(
                    'type' => 'string',
                    'dbName' => 'password',
                ),
                'email' => array(
                    'type' => 'string',
                    'dbName' => 'email',
                ),
                'institution_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'institution',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'institution' => array(
                    'class' => 'Application\\Entity\\Institution',
                    'field' => 'institution_reference_field',
                ),
            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }

    public function getApplicationEntityPatientClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_patient',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'firstname' => array(
                    'type' => 'string',
                    'dbName' => 'firstname',
                ),
                'lastname' => array(
                    'type' => 'string',
                    'dbName' => 'lastname',
                ),
                'login' => array(
                    'type' => 'string',
                    'dbName' => 'login',
                ),
                'password' => array(
                    'type' => 'string',
                    'dbName' => 'password',
                ),
                'email' => array(
                    'type' => 'string',
                    'dbName' => 'email',
                ),
                'doctor_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'doctor',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'doctor' => array(
                    'class' => 'Application\\Entity\\Doctor',
                    'field' => 'doctor_reference_field',
                ),
            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(

            ),
            'relationsOne' => array(

            ),
            'relationsManyOne' => array(

            ),
            'relationsManyMany' => array(

            ),
            'relationsManyThrough' => array(

            ),
            'indexes' => array(

            ),
            '_indexes' => array(

            ),
        );
    }
}