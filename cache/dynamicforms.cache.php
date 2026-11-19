<?php
// Auto-generated cache file — do not edit manually.
// Generated: 2026-11-19 18:44:08
return array (
  'moduledev' => 
  array (
    'Id' => 1,
    'Name' => 'moduledev',
    'Title' => 'Module Definition',
    'Description' => 'this is the module definition form',
    'Details' => 
    array (
      'table' => 'ModuleDefinition',
      'fields' => 
      array (
        0 => 
        array (
          'id' => 'modName',
          'name' => 'ModuleName',
          'label' => 'Module Name',
          'type' => 'text',
          'col' => 12,
          'val' => 'required|maxlen:100',
          'placeholder' => 'e.g. Human Resources',
        ),
        1 => 
        array (
          'id' => 'modCode',
          'name' => 'ModuleCode',
          'label' => 'Module Code',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|alphanum|maxlen:100',
          'placeholder' => 'e.g. HR',
        ),
        2 => 
        array (
          'id' => 'modIcon',
          'name' => 'Icon',
          'label' => 'Icon (FontAwesome Class)',
          'type' => 'text',
          'col' => 6,
          'val' => 'maxlen:100',
          'placeholder' => 'e.g. fa-solid fa-users',
        ),
        3 => 
        array (
          'id' => 'modDesc',
          'name' => 'Description',
          'label' => 'Description',
          'type' => 'textarea',
          'col' => 12,
          'val' => 'maxlen:256',
          'placeholder' => 'Brief description of this module...',
        ),
        4 => 
        array (
          'id' => 'modStatus',
          'name' => 'Status',
          'label' => 'Status',
          'type' => 'select',
          'col' => 12,
          'val' => 'required',
          'options' => 
          array (
            0 => 
            array (
              'value' => '1',
              'label' => 'Active',
            ),
            1 => 
            array (
              'value' => '0',
              'label' => 'Inactive',
            ),
          ),
        ),
      ),
    ),
  ),
);