<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'c_home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['logOut'] = 'c_home';

$route['soal/(:num)'] = 'c_home/loadSoal/$1';
$route['hasil/(:num)'] = 'c_home/loadHasil/$1';
$route['siswa'] = 'c_home/siswa';

$route['upload_files'] = 'c_home/upload_files2';

$route['guru/list-soal'] = 'c_home/listSoal';
$route['guru/list-siswa'] = 'c_home/listSiswa';

$route['guru/buatsoal/(:num)/(:num)'] = 'c_home/buatsoal/$1/$2';
$route['guru/editsoal/(:num)/(:num)'] = 'c_home/editsoal/$1/$2';

$route['guru/listpembahasan/(:num)'] = 'c_home/listpembahasan/$1';

$route['guru/analisis-1/(:num)'] = 'c_home/analisis_1/$1';
$route['guru/analisis-2'] = 'c_home/analisis_2';
$route['guru/analisis-3/(:num)'] = 'c_home/analisis_3/$1';

$route['guru/analisis-4'] = 'c_home/analisis_4';

$route['guru/analisis-5'] = 'c_home/analisis_5';
$route['guru/analisis-6'] = 'c_home/analisis_6';

$route['admin'] = 'c_admin';
$route['admin/biodata'] = 'c_admin/biodata';
$route['admin/pengaturan'] = 'c_admin/pengaturan';
$route['admin/master-sekolah'] = 'c_admin/mastersekolah';
$route['admin/guru'] = 'c_admin/guru';
$route['admin/murid'] = 'c_admin/murid';
$route['admin/logout'] = 'c_admin/logout';


$route['__crudUser'] = 'c_rest/crudUser';

$route['__crudSoal'] = 'c_rest/crudSoal';

$route['__crudPembahasan'] = 'c_rest/crudPembahasan';

$route['__crudMenuAdmin'] = 'c_rest/crudMenuAdmin';
$route['__crudTimer'] = 'c_rest/crudTimer';
$route['__selectOption'] = 'c_rest/selectOption';

$route['__getAnalisis2/(:num)'] = 'c_rest/getAnalisis2/$1';
$route['__getAnalisis3/(:num)/(:num)/(:any)'] = 'c_rest/getAnalisis3/$1/$2/$3';
$route['__getAnalisis4'] = 'c_rest/getAnalisis4';
$route['__getAnalisis5/(:num)/(:num)'] = 'c_rest/getAnalisis5/$1/$2';
$route['__getAnalisis6/(:num)/(:num)'] = 'c_rest/getAnalisis6/$1/$2';

// Upload image
$route['post/upload_image'] = 'c_home/upload_image';
$route['post/delete_image'] = 'c_home/delete_image';
