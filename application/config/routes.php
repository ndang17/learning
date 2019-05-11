<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'c_home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['logOut'] = 'c_home/logOut';

$route['soal/(:num)'] = 'c_home/loadSoal/$1';
$route['hasil/(:num)'] = 'c_home/loadHasil/$1';
$route['siswa'] = 'c_home/siswa';

$route['upload_files'] = 'c_home/upload_filguru/list-soales';

$route['guru/list-soal'] = 'c_home/listSoal';
$route['guru/list-siswa'] = 'c_home/listSiswa';

$route['guru/buatsoal/(:num)/(:num)'] = 'c_home/buatsoal/$1/$2';
$route['guru/editsoal/(:num)/(:num)'] = 'c_home/editsoal/$1/$2';

$route['guru/listpembahasan/(:num)'] = 'c_home/listpembahasan/$1';

$route['__crudUser'] = 'c_rest/crudUser';

$route['__crudSoal'] = 'c_rest/crudSoal';

$route['__crudPembahasan'] = 'c_rest/crudPembahasan';


