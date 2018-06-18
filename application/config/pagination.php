<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* pagination-sm = pequeño
* pagination-md = mediano
* pagination-lg = grande
*/

$config['enable_query_strings']=true;
$config['page_query_string'] = TRUE;
$config['use_page_numbers'] = TRUE;
$config['full_tag_open'] = '<ul class="pagination pagination-md">';
$config['full_tag_close'] = '</ul>';
$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active"> <span class="page-link">';
$config['cur_tag_close'] = '</span></li>';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';
$config['next_tag_open'] = '<li class="page-item"> ';
$config['next_tag_close'] = '</li>';;
$config['first_link'] = '«';
$config['prev_link'] = '‹';
$config['last_link'] = '»';
$config['next_link'] = '›';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';