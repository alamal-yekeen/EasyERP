<?php
// Auto-generated cache file — do not edit manually.
// Generated: 2026-11-20 16:38:06
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
  'role_definition' => 
  array (
    'Id' => 3,
    'Name' => 'role_definition',
    'Title' => 'Role Definition',
    'Description' => 'this is the role definition form',
    'Details' => 
    array (
      'table' => 'roledefinition',
      'fields' => 
      array (
        0 => 
        array (
          'id' => 'roleName',
          'name' => 'rolename',
          'label' => 'Role Name',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|maxlen:100',
        ),
        1 => 
        array (
          'id' => 'roleCode',
          'name' => 'rolecode',
          'label' => 'Role Code',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|alphanum|maxlen:50',
        ),
        2 => 
        array (
          'id' => 'roleDesc',
          'name' => 'description',
          'label' => 'Description',
          'type' => 'textarea',
          'col' => 12,
          'val' => 'maxlen:255',
        ),
        3 => 
        array (
          'id' => 'roleMail',
          'name' => 'groupmail',
          'label' => 'Group Email',
          'type' => 'email',
          'col' => 12,
          'val' => 'email|maxlen:100',
        ),
      ),
    ),
  ),
  'route_definition' => 
  array (
    'Id' => 2,
    'Name' => 'route_definition',
    'Title' => 'Route Definition',
    'Description' => 'This is the menu definition form',
    'Details' => 
    array (
      'table' => 'routedefinition',
      'fields' => 
      array (
        0 => 
        array (
          'id' => 'menuName',
          'name' => 'MenuName',
          'label' => 'Menu Name',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|maxlen:100',
          'placeholder' => 'e.g. User Management',
        ),
        1 => 
        array (
          'id' => 'menuIcon',
          'name' => 'Icon',
          'label' => 'Icon (FontAwesome)',
          'type' => 'text',
          'col' => 6,
          'val' => 'maxlen:100',
          'placeholder' => 'e.g. fa-solid fa-users',
        ),
        2 => 
        array (
          'id' => 'menuRoute',
          'name' => 'Route',
          'label' => 'Route Slug',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|alphanum|maxlen:100',
          'placeholder' => 'e.g. users',
        ),
        3 => 
        array (
          'id' => 'menuPage',
          'name' => 'Page',
          'label' => 'Page Filename',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|maxlen:100',
          'placeholder' => 'e.g. user_management.php',
        ),
        4 => 
        array (
          'id' => 'menuModule',
          'name' => 'Module',
          'label' => 'Assign to Module',
          'type' => 'select',
          'col' => 12,
          'val' => 'required',
          'options' => 
          array (
          ),
        ),
        5 => 
        array (
          'id' => 'menuType',
          'name' => 'Type',
          'label' => 'Route Type',
          'type' => 'select',
          'col' => 6,
          'val' => 'required',
          'options' => 
          array (
            0 => 
            array (
              'value' => '0',
              'label' => 'Backend Engine (engine/)',
            ),
            1 => 
            array (
              'value' => '1',
              'label' => 'Frontend Page (pages/)',
            ),
          ),
        ),
        6 => 
        array (
          'id' => 'menuSideMenu',
          'name' => 'SideMenu',
          'label' => 'Show in Sidebar',
          'type' => 'select',
          'col' => 6,
          'val' => 'required',
          'options' => 
          array (
            0 => 
            array (
              'value' => '1',
              'label' => 'Yes',
            ),
            1 => 
            array (
              'value' => '0',
              'label' => 'No',
            ),
          ),
        ),
        7 => 
        array (
          'id' => 'menuStatus',
          'name' => 'Status',
          'label' => 'Status',
          'type' => 'select',
          'col' => 6,
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
        8 => 
        array (
          'id' => 'menuDesc',
          'name' => 'MenuDescription',
          'label' => 'Description',
          'type' => 'textarea',
          'col' => 12,
          'val' => 'maxlen:255',
          'placeholder' => 'Brief description of this route',
        ),
      ),
    ),
  ),
  'staff_definition' => 
  array (
    'Id' => 4,
    'Name' => 'staff_definition',
    'Title' => 'Staff to role mapping',
    'Description' => 'this is to map staff to a role',
    'Details' => 
    array (
      'table' => 'users',
      'fields' => 
      array (
        0 => 
        array (
          'id' => 'staffId',
          'name' => 'staffid',
          'label' => 'Staff ID',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|maxlen:50',
        ),
        1 => 
        array (
          'id' => 'fullName',
          'name' => 'full_name',
          'label' => 'Full Name',
          'type' => 'text',
          'col' => 6,
          'val' => 'required|maxlen:100',
        ),
        2 => 
        array (
          'id' => 'email',
          'name' => 'email',
          'label' => 'Email',
          'type' => 'email',
          'col' => 12,
          'val' => 'required|email|maxlen:100',
        ),
      ),
    ),
  ),
);