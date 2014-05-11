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
                'login' => array(
                    'type' => 'string',
                    'dbName' => 'login',
                ),
                'password' => array(
                    'type' => 'string',
                    'dbName' => 'password',
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
                'firstname' => array(
                    'type' => 'string',
                    'dbName' => 'firstname',
                ),
                'lastname' => array(
                    'type' => 'string',
                    'dbName' => 'lastname',
                ),
                'email' => array(
                    'type' => 'string',
                    'dbName' => 'email',
                ),
                'user_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'user',
                    'referenceField' => true,
                ),
                'institution_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'institution',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'user' => array(
                    'class' => 'Application\\Entity\\User',
                    'field' => 'user_reference_field',
                ),
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
                'email' => array(
                    'type' => 'string',
                    'dbName' => 'email',
                ),
                'user_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'user',
                    'referenceField' => true,
                ),
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
                'schedule_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'schedule',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(
                'user' => array(
                    'class' => 'Application\\Entity\\User',
                    'field' => 'user_reference_field',
                ),
                'institution' => array(
                    'class' => 'Application\\Entity\\Institution',
                    'field' => 'institution_reference_field',
                ),
                'doctor' => array(
                    'class' => 'Application\\Entity\\Doctor',
                    'field' => 'doctor_reference_field',
                ),
                'schedule' => array(
                    'class' => 'Application\\Entity\\Schedule',
                    'field' => 'schedule_reference_field',
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
                'days_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'days',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(

            ),
            'referencesMany' => array(
                'days' => array(
                    'class' => 'Application\\Entity\\Day',
                    'field' => 'days_reference_field',
                ),
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
                'streams_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'streams',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(

            ),
            'referencesMany' => array(
                'streams' => array(
                    'class' => 'Application\\Entity\\Stream',
                    'field' => 'streams_reference_field',
                ),
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
                'events_reference_field' => array(
                    'type' => 'raw',
                    'dbName' => 'events',
                    'referenceField' => true,
                ),
            ),
            '_has_references' => true,
            'referencesOne' => array(

            ),
            'referencesMany' => array(
                'events' => array(
                    'class' => 'Application\\Entity\\Event',
                    'field' => 'events_reference_field',
                ),
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
                'time' => array(
                    'type' => 'string',
                    'dbName' => 'time',
                ),
                'duration' => array(
                    'type' => 'integer',
                    'dbName' => 'duration',
                ),
                'state' => array(
                    'type' => 'string',
                    'dbName' => 'state',
                ),
                'measurement' => array(
                    'type' => 'string',
                    'dbName' => 'measurement',
                ),
                'measurementvalue' => array(
                    'type' => 'string',
                    'dbName' => 'measurementvalue',
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