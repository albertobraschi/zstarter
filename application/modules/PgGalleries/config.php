<?php
return array (
  0 => 
  array (
    'FieldName' => 'ID',
    'FieldType' => 'primary',
  ),
  1 => 
  array (
    'FieldName' => 'Name',
    'FieldType' => 'text',
  ),
  2 => 
  array (
    'FieldName' => 'Alias',
    'FieldType' => 'text',
  ),
  3 => 
  array (
    'FieldName' => 'Date_creation',
    'FieldType' => 'creation_date',
    'd_creation_date_template' => '%Y.%m.%d %H:%i',
  ),
  4 => 
  array (
    'FieldName' => 'Date_modification',
    'FieldType' => 'date_',
    'd_date_template' => '%Y.%m.%d %H:%i',
  ),
  5 => 
  array (
    'FieldName' => 'Description',
    'FieldType' => 'textarea',
  ),
  6 => 
  array (
    'FieldName' => 'DefaultPhotoID',
    'FieldType' => 'select_from_database',
    's_tables' => 'pg_photos',
    's_tables_id' => 'ID',
    's_tables_description' => 'Description',
  ),
  7 => 
  array (
    'FieldName' => 'Raiting',
    'FieldType' => 'text',
  ),
  8 => 
  array (
    'FieldName' => 'Hidden',
    'FieldType' => 'checkbox',
  ),
  'tablename' => 'pg_galleries',
);
