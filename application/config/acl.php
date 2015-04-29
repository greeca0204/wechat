<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  $acl = array(
        'adminx' => array(
                'add' => array('admin','register'),
                'html_all' => array('admin'),
                'remove_all' => array('admin'),
        ),
        
  );
 
  //set config 
  $config['acl'] = $acl;