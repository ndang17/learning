<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'c_home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['logOut'] = 'c_home/logOut';

$route['soal/(:num)'] = 'c_home/loadSoal/$1';
$route['siswa'] = 'c_home/siswa';

$route['guru/list-soal'] = 'c_home/listSoal';
$route['guru/list-siswa'] = 'c_home/listSiswa';

$route['guru/buatsoal'] = 'c_home/buatsoal';

$route['__crudUser'] = 'c_rest/crudUser';

$route['__crudSoal'] = 'c_rest/crudSoal';


