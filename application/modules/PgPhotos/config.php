<?php
return array (
  0 => 
  array (
    'FieldName' => 'ID',
    'FieldType' => 'primary',
  ),
  1 => 
  array (
    'FieldName' => 'Filename',
    'FieldType' => 'file_',
  ),
  2 => 
  array (
    'FieldName' => 'Description',
    'FieldType' => 'textarea',
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
    'FieldType' => 'current_date',
    'd_current_date_template' => '%Y.%m.%d %H:%i',
  ),
  5 => 
  array (
    'FieldName' => 'Raiting',
    'FieldType' => 'text',
  ),
  6 => 
  array (
    'FieldName' => 'Gallery_id',
    'FieldType' => 'select_from_database',
    's_tables' => 'pg_galleries',
    's_tables_id' => 'ID',
    's_tables_description' => 'Description',
  ),
  7 => 
  array (
    'FieldName' => 'Hidden',
    'FieldType' => 'checkbox',
  ),
  8 => 
  array (
    'FieldName' => 'Comments',
    'FieldType' => 'checkbox',
  ),
  9 => 
  array (
    'FieldName' => 'Tags',
    'FieldType' => 'checkbox',
  ),
  'tablename' => 'pg_photos',
);
