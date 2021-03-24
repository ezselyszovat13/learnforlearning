<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\User;

use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->truncate();
        DB::table('subject_user')->truncate();
        DB::table('users')->truncate();

        Subject::create(['name' => 'Adatbázisok 1 Ea',
        'code' => 'IP-18AB1E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1051/Adatb%C3%A1zisok%20I..pdf']);

        Subject::create(['name' => 'Adatbázisok 1 Gy',
        'code' => 'IP-18AB1G',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1051/Adatb%C3%A1zisok%20I..pdf']);

        Subject::create(['name' => 'Algoritmusok és adatszerkezetek 1 Ea',
        'code' => 'IP-18AA1E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1046/Algoritmusok%20%C3%A9s%20adatszerkezetek%20I.pdf']);

        Subject::create(['name' => 'Algoritmusok és adatszerkezetek 1 Gy',
        'code' => 'IP-18AA1G',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1046/Algoritmusok%20%C3%A9s%20adatszerkezetek%20I.pdf']);

        Subject::create(['name' => 'Algoritmusok és adatszerkezetek 2 Ea',
        'code' => 'IP-18AA2E',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1049/Algoritmusok%20%C3%A9s%20adatszerkezetek%20II..pdf']);

        Subject::create(['name' => 'Algoritmusok és adatszerkezetek 2 Gy',
        'code' => 'IP-18AA2G',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1049/Algoritmusok%20%C3%A9s%20adatszerkezetek%20II..pdf']);

        Subject::create(['name' => 'Analízis 1 Ea',
        'code' => 'IP-18AN1E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1048/Anal%C3%ADzis%20I.pdf']);

        Subject::create(['name' => 'Analízis 1 Gy',
        'code' => 'IP-18AN1G',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1048/Anal%C3%ADzis%20I.pdf']);

        Subject::create(['name' => 'Diszkrét matematika 1. Ea',
        'code' => 'IP-18DM1E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1047/Diszkr%C3%A9t%20matematika%20I.pdf']);

        Subject::create(['name' => 'Diszkrét matematika 1. Gy',
        'code' => 'IP-18DM1G',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1047/Diszkr%C3%A9t%20matematika%20I.pdf']);

        Subject::create(['name' => 'Funkcionális programozás Ea+Gy',
        'code' => 'IP-18FUNPEG',
        'credit_points' => 5,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1038/Funkcion%C3%A1lis%20programoz%C3%A1s.pdf']);

        Subject::create(['name' => 'Imperatív programozás Ea+Gy',
        'code' => 'IP-18IMPROGEG',
        'credit_points' => 5,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1031/Imperativ%20programoz%C3%A1s.pdf']);

        Subject::create(['name' => 'Konkurrens programozás Ea+Gy',
        'code' => 'IP-18KPROGEG ',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1052/Konkurens%20programoz%C3%A1s.pdf']);

        Subject::create(['name' => 'Mesterséges intelligencia Ea',
        'code' => 'IP-18MIAE',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1054/Mesters%C3%A9ges%20intelligencia.pdf']);
        
        Subject::create(['name' => 'Objektumelvű programozás Ea+Gy',
        'code' => 'IP-18OEPROGEG',
        'credit_points' => 6,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1044/Objektum%20elv%C5%B1%20programoz%C3%A1s.pdf']);

        Subject::create(['name' => 'Operációs rendszerek Ea+Gy',
        'code' => 'IP-18OPREG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1050/Oper%C3%A1ci%C3%B3s%20rendszerek.pdf']);

        Subject::create(['name' => 'Programozás Ea+Gy',
        'code' => 'IP-18PROGEG',
        'credit_points' => 6,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1030/Programoz%C3%A1s.pdf']);

        Subject::create(['name' => 'Programozási nyelvek 1 Ea+Gy',
        'code' => 'IP-18PNY1EG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1042/Programoz%C3%A1si%20nyelvek%20I..pdf']);

        Subject::create(['name' => 'Programozási nyelvek 2 Ea+Gy',
        'code' => 'IP-18PNY2EG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1043/Programoz%C3%A1si%20nyelvek%20II..pdf']);

        Subject::create(['name' => 'Számítógépes rendszerek Ea+Gy',
        'code' => 'IP-18SZGREG',
        'credit_points' => 5,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1029/Sz%C3%A1m%C3%ADt%C3%B3g%C3%A9pes%20rendszerek.pdf']);

        Subject::create(['name' => 'Telekommunikációs hálózatok Ea',
        'code' => 'IP-18TKHE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1053/Telekommunik%C3%A1ci%C3%B3s%20h%C3%A1l%C3%B3zatok.pdf']);
    
        Subject::create(['name' => 'Telekommunikációs hálózatok Gy',
        'code' => 'IP-18TKHG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1053/Telekommunik%C3%A1ci%C3%B3s%20h%C3%A1l%C3%B3zatok.pdf']);
    
        Subject::create(['name' => 'Web-fejlesztés Ea+Gy',
        'code' => 'IP-18WF1EG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1045/Web%20fejleszt%C3%A9s.pdf']);

        Subject::create(['name' => 'Adatbázisok 2 Ea',
        'code' => 'IP-18*AB2E',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1081/Adatb%C3%A1zisok%20II..pdf']);

        Subject::create(['name' => 'Adatbázisok 2 Gy',
        'code' => 'IP-18*AB2G',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1081/Adatb%C3%A1zisok%20II..pdf']);

        Subject::create(['name' => 'Analízis 2 Ea',
        'code' => 'IP-18*AN2E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1056/Anal%C3%ADzis%20II.pdf']);

        Subject::create(['name' => 'Analízis 2 Gy',
        'code' => 'IP-18*AN2E',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1056/Anal%C3%ADzis%20II.pdf']);
    
        Subject::create(['name' => 'Diszkrét matematika 2. Ea',
        'code' => 'IP-18*DM2E',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1057/Diszkr%C3%A9t%20matematika%20II.pdf']);
    
        Subject::create(['name' => 'Diszkrét matematika 2. Gy',
        'code' => 'IP-18*DM2G',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1057/Diszkr%C3%A9t%20matematika%20II.pdf']);
    
        Subject::create(['name' => 'Eseményvezérelt alkalmazások Ea+Gy',
        'code' => 'IP-18*EVALKEG',
        'credit_points' => 5,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1032/Esem%C3%A9nyvez%C3%A9relt%20alkalmaz%C3%A1sok.pdf']);

        Subject::create(['name' => 'Formális nyelvek és a fordítóprogramok alapjai Ea',
        'code' => 'IP-18bFNYFPRE',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1068/Form%C3%A1lis%20nyelvek%20%C3%A9s%20a%20ford%C3%ADt%C3%B3programok%20alapjai.pdf']);

        Subject::create(['name' => 'Formális nyelvek és a fordítóprogramok alapjai Gy',
        'code' => 'IP-18bFNYFPRG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1068/Form%C3%A1lis%20nyelvek%20%C3%A9s%20a%20ford%C3%ADt%C3%B3programok%20alapjai.pdf']);

        Subject::create(['name' => 'Numerikus módszerek 1. Ea',
        'code' => 'IP-18*NM1E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1059/Numerikus%20m%C3%B3dszerek%20I-T.pdf']);

        Subject::create(['name' => 'Numerikus módszerek 1. Gy',
        'code' => 'IP-18*NM1G',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1059/Numerikus%20m%C3%B3dszerek%20I-T.pdf']);

        Subject::create(['name' => 'Programozáselmélet Ea',
        'code' => 'IP-18*PREE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1034/Programoz%C3%A1selm%C3%A9let.pdf']);
    
        Subject::create(['name' => 'Programozáselmélet Gy',
        'code' => 'IP-18*PREG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1034/Programoz%C3%A1selm%C3%A9let.pdf']);
    
        Subject::create(['name' => 'Számításelmélet Ea',
        'code' => 'IP-18bSZEE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1074/Sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9let.pdf']);

        Subject::create(['name' => 'Számításelmélet Gy',
        'code' => 'IP-18bSZEG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1074/Sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9let.pdf']);

        Subject::create(['name' => 'Numerikus módszerek 2 Ea',
        'code' => 'IP-18aNM2EE ',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1060/Numerikus%20m%C3%B3dszerek%20II%20%28T%29.pdf']);

        Subject::create(['name' => 'Numerikus módszerek 2 Gy',
        'code' => 'IP-18*NM2EG ',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1060/Numerikus%20m%C3%B3dszerek%20II%20%28T%29.pdf']);
    
        Subject::create(['name' => 'Szoftvertechnológia Ea+Gy',
        'code' => 'IP-18*SZTEG',
        'credit_points' => 5,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1060/Numerikus%20m%C3%B3dszerek%20II%20%28T%29.pdf']);
    
        Subject::create(['name' => 'Többváltozós függvénytan Ea+Gy',
        'code' => 'IP-18bTVFTEG',
        'credit_points' => 4,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1071/T%C3%B6bbv%C3%A1ltoz%C3%B3s%20f%C3%BCggv%C3%A9nytan.pdf']);
    
        Subject::create(['name' => 'Valószínűségszámítás és statisztika Ea+Gy',
        'code' => 'IP-18bVSZEG',
        'credit_points' => 4,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1070/Val%C3%B3sz%C3%ADn%C5%B1s%C3%A9gsz%C3%A1m%C3%ADt%C3%A1s%20%C3%A9s%20statisztika%20%28T%29.pdf']);
    
        Subject::create(['name' => 'Valószínűségszámítás és statisztika Ea+Gy (F)',
        'code' => 'IP-18cVSZG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1083/Val%C3%B3sz%C3%ADn%C5%B1s%C3%A9gsz%C3%A1m%C3%ADt%C3%A1s%20%C3%A9s%20statisztika%20%28F%29.pdf']);

        Subject::create(['name' => 'Valószínűségszámítás',
        'code' => 'IP-18aVSZEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1106/Val%C3%B3sz%C3%ADn%C5%B1s%C3%A9gsz%C3%A1m%C3%ADt%C3%A1s.pdf']);
    
        Subject::create(['name' => 'Matematikai statisztika',
        'code' => 'IP-18aMSAEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1064/Matematikai%20statisztika.pdf']);
    
        Subject::create(['name' => 'Bevezetés a gépi tanulásba Ea',
        'code' => 'IP-18KVSZBGTE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1097/Bevezet%C3%A9s%20a%20g%C3%A9pi%20tanul%C3%A1sba.pdf']);
    
        Subject::create(['name' => 'Big Data architektúrák és elemző módszerek Ea',
        'code' => 'IP-18KVIBDAE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1093/Big%20Data%20architekt%C3%BAr%C3%A1k%20%C3%A9s%20elemz%C5%91%20m%C3%B3dszerek.pdf']);

        Subject::create(['name' => 'Big Data architektúrák és elemző módszerek Gy',
        'code' => 'IP-18KVIBDAG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1093/Big%20Data%20architekt%C3%BAr%C3%A1k%20%C3%A9s%20elemz%C5%91%20m%C3%B3dszerek.pdf']);

        Subject::create(['name' => 'Full stack webprogramozás Ea+Gy',
        'code' => 'IP-18KVIFSWPROGG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1091/Full-stack%20webprogramoz%C3%A1s.pdf']);
    
        Subject::create(['name' => 'Funkcionális nyelvek Ea+Gy',
        'code' => 'IP-18KVFPNYEG',
        'credit_points' => 5,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1474/Funkcion%C3%A1lis%20nyelvek.pdf']);
    
        Subject::create(['name' => 'GPU programozás Ea+Gy',
        'code' => 'IP-18KVIGPUEG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1087/GPU%20programoz%C3%A1s.pdf']);
    
        Subject::create(['name' => 'Haladó Java Ea+Gy',
        'code' => 'IP-18KVIHJEG',
        'credit_points' => 5,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1095/Halad%C3%B3%20Java.pdf']);
    
        Subject::create(['name' => 'Kliensoldali webprogramozás Ea+Gy',
        'code' => 'IP-18KVIKWPROGEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1089/Kliensoldali%20webprogramoz%C3%A1s.pdf']);   
        
        Subject::create(['name' => 'Kriptográfia és biztonság Ea',
        'code' => 'IP-18KVSZKRBE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1086/Kriptogr%C3%A1fia%20%C3%A9s%20biztons%C3%A1g.pdf']);  
        
        Subject::create(['name' => 'Kriptográfia és biztonság Gy',
        'code' => 'IP-18KVSZKRBG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1086/Kriptogr%C3%A1fia%20%C3%A9s%20biztons%C3%A1g.pdf']); 

        Subject::create(['name' => 'Logika Ea',
        'code' => 'IP-18KVELE',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1105/Logika.pdf']); 

        Subject::create(['name' => 'Logika Gy',
        'code' => 'IP-18KVELG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1105/Logika.pdf']);
        
        Subject::create(['name' => 'Mély neuronhálók algoritmusai és fajtái Ea+Gy',
        'code' => 'IP-18KVIMNFEG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1100/BSc_Mely_neuronhalok_algoritmusai_es_fajtai_tematika.pdf']); 
    
        Subject::create(['name' => 'Numerikus algoritmusok Ea+Gy',
        'code' => 'IP-18KVMNMALEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1908/Numerikus%20algoritmusok%20ea+gy.pdf']);
        
        Subject::create(['name' => 'Osztott rendszerek specifikációja és implementációja Ea',
        'code' => 'IP-18KVSZORSIE',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1147/Osztott%20rendszerek%20specifik%C3%A1ci%C3%B3ja%20%C3%A9s%20implement%C3%A1ci%C3%B3ja.pdf']); 
    
        Subject::create(['name' => 'Osztott rendszerek specifikációja és implementációja Gy',
        'code' => 'IP-18KVSZORSIG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1147/Osztott%20rendszerek%20specifik%C3%A1ci%C3%B3ja%20%C3%A9s%20implement%C3%A1ci%C3%B3ja.pdf']);
    
        Subject::create(['name' => 'Programozási módszertan Ea',
        'code' => 'IP-18KVSZPME',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1102/Programoz%C3%A1si%20m%C3%B3dszertan1.pdf']);

        Subject::create(['name' => 'Programozási módszertan Gy',
        'code' => 'IP-18KVSZPMG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1102/Programoz%C3%A1si%20m%C3%B3dszertan1.pdf']);

        Subject::create(['name' => 'Projekteszközök (Tools of software projects)',
        'code' => 'IP-18KVPRJG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/567/Projekteszkozok_C_hun.pdf']);
    
        Subject::create(['name' => 'Számítási modellek Ea',
        'code' => 'IP-18KVSZSZME',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1103/Sz%C3%A1m%C3%ADt%C3%A1si%20modellek.pdf']);
    
        Subject::create(['name' => 'Számítási modellek Gy',
        'code' => 'IP-18KVSZSZMG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1103/Sz%C3%A1m%C3%ADt%C3%A1si%20modellek.pdf']);
    
        Subject::create(['name' => 'Számítógépes grafika Ea',
        'code' => 'IP-18KVISZGE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1084/Sz%C3%A1m%C3%ADt%C3%B3g%C3%A9pes%20grafika.pdf']);
    
        Subject::create(['name' => 'Számítógépes grafika Gy',
        'code' => 'IP-18KVISZGG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1084/Sz%C3%A1m%C3%ADt%C3%B3g%C3%A9pes%20grafika.pdf']);
    
        Subject::create(['name' => 'Szerveroldali webprogramozás Ea+Gy',
        'code' => 'IP-18KVISZWPROGEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1090/Szerveroldali%20webprogramoz%C3%A1s.pdf']);
    
        Subject::create(['name' => 'Szoftver mély neuronhálók alkalmazásához Gy',
        'code' => 'IP-18KVISZMNAGE',
        'credit_points' => 4,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1099/BSc_Szoftver_mely_neuronhalok_alkalmazasahoz_tematika.pdf']);

        Subject::create(['name' => 'Típuselmélet Ea',
        'code' => 'IP-18KVSZTME',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1104/T%C3%ADpuselm%C3%A9let.pdf']);
    
        Subject::create(['name' => 'Típuselmélet Gy',
        'code' => 'IP-18KVSZTMG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1104/T%C3%ADpuselm%C3%A9let.pdf']);
    
        Subject::create(['name' => 'Vállalati információs rendszerek és architektúrák Ea',
        'code' => 'IP-18KVIVISZE',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1092/V%C3%A1llalati%20inform%C3%A1ci%C3%B3s%20rendszerek%20%C3%A9s%20architekt%C3%BAr%C3%A1k.pdf']);

        Subject::create(['name' => 'Vállalati információs rendszerek és architektúrák Gy',
        'code' => 'IP-18KVIVISZG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => true,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1092/V%C3%A1llalati%20inform%C3%A1ci%C3%B3s%20rendszerek%20%C3%A9s%20architekt%C3%BAr%C3%A1k.pdf']);
    
        Subject::create(['name' => 'Web-es alkalmazások fejlesztése Ea+Gy',
        'code' => 'IP-18KVIWAFEG',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1085/Webes%20alkalmaz%C3%A1sok%20fejleszt%C3%A9se.pdf']);

        Subject::create(['name' => 'Webprogramozás Ea+Gy',
        'code' => 'IP-18KWEBPROGEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => true,
        'optionalOnB' => true,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1088/Webprogramoz%C3%A1s.pdf']);

        Subject::create(['name' => 'Webprogramozás',
        'code' => 'IP-18cWEBPROGEG',
        'credit_points' => 4,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1036/Webprogramoz%C3%A1s.pdf']);
    
        Subject::create(['name' => 'Bevezetés a számításelméletbe Ea',
        'code' => 'IP-18aBSZEE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1058/Bevezet%C3%A9s%20a%20sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9letbe.pdf']);

        Subject::create(['name' => 'Bevezetés a számításelméletbe Gy',
        'code' => 'IP-18aBSZEG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1058/Bevezet%C3%A9s%20a%20sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9letbe.pdf']);
    
        Subject::create(['name' => 'Analízis 3 Ea',
        'code' => 'IP-18aAN3E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1061/Anal%C3%ADzis%20III.pdf']);

        Subject::create(['name' => 'Analízis 3 Gy',
        'code' => 'IP-18aAN3G',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1061/Anal%C3%ADzis%20III.pdf']);
   
        Subject::create(['name' => 'Analízis alkalmazásai Ea',
        'code' => 'IP-18aANA1E',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1065/Anal%C3%ADzis%20alkalmaz%C3%A1sai.pdf']);

        Subject::create(['name' => 'Analízis alkalmazásai Gy',
        'code' => 'IP-18aANA1G',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1065/Anal%C3%ADzis%20alkalmaz%C3%A1sai.pdf']);
    
        Subject::create(['name' => 'Programozási technológia Ea+Gy',
        'code' => 'IP-18cPROGTEG',
        'credit_points' => 5,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1035/Programoz%C3%A1si%20technol%C3%B3gia.pdf']);
    
        Subject::create(['name' => 'Diszkrét modellek alkalmazásai Gy',
        'code' => 'IP-18cDMAG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1077/Diszkr%C3%A9t%20modellek%20alkalmaz%C3%A1sai.pdf']);

        Subject::create(['name' => 'A számításelmélet alapjai 1 Ea',
        'code' => 'IP-18cSZÁMEA1E',
        'credit_points' => 2,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1078/A%20sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9let%20alapjai%20I..pdf']);
    
        Subject::create(['name' => 'A számításelmélet alapjai 1 Gy',
        'code' => 'IP-18cSZÁMEA1G',
        'credit_points' => 3,
        'even_semester'=> true,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1078/A%20sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9let%20alapjai%20I..pdf']);
    
        Subject::create(['name' => 'A számításelmélet alapjai 2 Ea',
        'code' => 'IP-18cSZÁMEA2E',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1082/A%20sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9let%20alapjai%20II..pdf']);

        Subject::create(['name' => 'A számításelmélet alapjai 2 Gy',
        'code' => 'IP-18cSZÁMEA2G',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => false,
        'existsOnB' => false,
        'existsOnC' => true,
        'url' => 'https://www.inf.elte.hu/dstore/document/1082/A%20sz%C3%A1m%C3%ADt%C3%A1selm%C3%A9let%20alapjai%20II..pdf']);
    
        for($x = 1; $x < 11; $x++){
            User::factory()->create( ['name' => "Felhasználó ".$x,
                                      'email' => 'user'.$x.'@tanulas.hu',
                                      'spec' => 'A']);
        }

        //User ID 1
        $user = User::where('id',1)->first();

        $user->subjects()->attach(3,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(57,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(58,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(72,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(73,['grade' => 5, 'created_at' => Carbon::now()]);

        //User ID 2
        $user = User::where('id',2)->first();

        $user->subjects()->attach(3,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(57,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(58,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(70,['grade' => 4, 'created_at' => Carbon::now()]);

        //User ID 3
        $user = User::where('id',3)->first();

        $user->subjects()->attach(3,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(57,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(58,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(68,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(69,['grade' => 4, 'created_at' => Carbon::now()]);

        //User ID 4
        $user = User::where('id',4)->first();

        $user->subjects()->attach(3,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(70,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(72,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(73,['grade' => 3, 'created_at' => Carbon::now()]);

        //User ID 5
        $user = User::where('id',5)->first();

        $user->subjects()->attach(3,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(57,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(58,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(68,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(69,['grade' => 5, 'created_at' => Carbon::now()]);

        //User ID 6
        $user = User::where('id',6)->first();

        $user->subjects()->attach(3,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 2, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(70,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(72,['grade' => 2, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(73,['grade' => 2, 'created_at' => Carbon::now()]);

        //User ID 7
        $user = User::where('id',7)->first();

        $user->subjects()->attach(3,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(57,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(58,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(72,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(73,['grade' => 3, 'created_at' => Carbon::now()]);

        //User ID 8
        $user = User::where('id',8)->first();

        $user->subjects()->attach(3,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 4, 'created_at' => Carbon::now()]);

        //User ID 9
        $user = User::where('id',9)->first();

        $user->subjects()->attach(3,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(68,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(69,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(72,['grade' => 3, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(73,['grade' => 5, 'created_at' => Carbon::now()]);

        //User ID 10
        $user = User::where('id',10)->first();

        $user->subjects()->attach(3,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(4,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(11,['grade' => 4, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(57,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(58,['grade' => 5, 'created_at' => Carbon::now()]);
        $user->subjects()->attach(70,['grade' => 5, 'created_at' => Carbon::now()]);

    }

    //kihagyottak:
    //Jogi ismeretek Ea
    //Vállalkozás menedzsment
}
