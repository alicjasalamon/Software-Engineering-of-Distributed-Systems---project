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
                'group' => array(
                    'type' => 'string',
                    'dbName' => 'group',
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
                'institution_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'institution',
                    'referenceField' => true,
                ),
                'user_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'user',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'institution' => array(
                    'class' => 'Application\\Entity\\Institution',
                    'field' => 'institution_reference_field',
                ),
                'user' => array(
                    'class' => 'Application\\Entity\\User',
                    'field' => 'user_reference_field',
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
                'institution_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'institution',
                    'referenceField' => true,
                ),
                'doctor_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'doctor',
                    'referenceField' => true,
                ),
                'user_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'user',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'institution' => array(
                    'class' => 'Application\\Entity\\Institution',
                    'field' => 'institution_reference_field',
                ),
                'doctor' => array(
                    'class' => 'Application\\Entity\\Doctor',
                    'field' => 'doctor_reference_field',
                ),
                'user' => array(
                    'class' => 'Application\\Entity\\User',
                    'field' => 'user_reference_field',
                ),
            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(
                'schedule' => array(
                    'class' => 'Application\\Entity\\Schedule',
                ),
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

    public function getApplicationEntityScheduleClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_schedule',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(

            ),
            '_has_references' => false,
            'referencesOne' => array(

            ),
            'referencesMany' => array(

            ),
            'embeddedsOne' => array(

            ),
            'embeddedsMany' => array(
                'days' => array(
                    'class' => 'Application\\Entity\\Day',
                ),
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

    public function getApplicationEntityDayClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_day',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'date' => array(
                    'type' => 'string',
                    'dbName' => 'date',
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
                'streams' => array(
                    'class' => 'Application\\Entity\\Stream',
                ),
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

    public function getApplicationEntityStreamClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_stream',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'activity' => array(
                    'type' => 'string',
                    'dbName' => 'activity',
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
                'events' => array(
                    'class' => 'Application\\Entity\\Event',
                ),
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

    public function getApplicationEntityEventClass()
    {
        return array(
            'isEmbedded' => false,
            'mandango' => null,
            'connection' => '',
            'collection' => 'application_entity_event',
            'inheritable' => false,
            'inheritance' => false,
            'fields' => array(
                'title' => array(
                    'type' => 'string',
                    'dbName' => 'title',
                ),
                'details' => array(
                    'type' => 'string',
                    'dbName' => 'details',
                ),
                'start' => array(
                    'type' => 'string',
                    'dbName' => 'start',
                ),
                'duration' => array(
                    'type' => 'integer',
                    'dbName' => 'duration',
                ),
                'state' => array(
                    'type' => 'string',
                    'dbName' => 'state',
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
}