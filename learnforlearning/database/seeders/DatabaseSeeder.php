<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\User;
use App\Models\Teacher;

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
        DB::table('teachers')->truncate();
        DB::table('subject_teacher')->truncate();
        DB::table('teacher_user')->truncate();

        $subject = Subject::create(['name' => 'Adatbázisok 1 Ea',
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

        $teachers = array("Vincellér Zoltán","Szalai-Gindl János Márk","Brányi László","Dr. Hajas Csilla",
         "Vörös Péter", "Dr. Nikovits Tibor", "Bokros Ferenc", "Lehotay-Kéry Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Adatbázisok 1 Gy',
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

        $teachers = array("Vincellér Zoltán","Szalai-Gindl János Márk","Brányi László","Dr. Hajas Csilla", 
        "Vörös Péter", "Dr. Nikovits Tibor", "Bokros Ferenc", "Lehotay-Kéry Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Algoritmusok és adatszerkezetek 1 Ea',
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

        $teachers = array("Nagy Sára", "Dr. Ásványi Tibor", "Kovácsné Pusztai Kinga Emese", "Veszprémi Anna",
         "Bartalis Dávid", "Torvinen Aili Szonja", "Nagy Ádám", "Dorogi Benjamin", "Bene Fruzsina", 
         "Borbély Dávid Márk", "Kotroczó Roland", "Vadász Péter", "Ciuciu-Kiss Jenifer Tabita", "Dr. Szabó László Ferenc",
          "Tukszár Ákos", "Orosz Bálint Dominik","Várszegi Márk");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Algoritmusok és adatszerkezetek 1 Gy',
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

        $teachers = array("Nagy Sára", "Dr. Ásványi Tibor", "Kovácsné Pusztai Kinga Emese", "Veszprémi Anna",
         "Bartalis Dávid", "Torvinen Aili Szonja", "Nagy Ádám", "Dorogi Benjamin", "Bene Fruzsina", 
         "Borbély Dávid Márk", "Kotroczó Roland", "Vadász Péter", "Ciuciu-Kiss Jenifer Tabita", "Dr. Szabó László Ferenc",
          "Tukszár Ákos", "Orosz Bálint Dominik","Várszegi Márk");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Algoritmusok és adatszerkezetek 2 Ea',
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

        $teachers = array("Dr. Szabó László Ferenc", "Dr. Ásványi Tibor", "Zsakó László", "Nagy Sára", "Vadász Péter",
            "Bereczky Péter", "Szita Balázs", "Veszprémi Anna", "Megyesi Attila", "Nagy Ádám", "Kovácsné Pusztai Kinga Emese");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Algoritmusok és adatszerkezetek 2 Gy',
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

        $teachers = array("Dr. Szabó László Ferenc", "Dr. Ásványi Tibor", "Zsakó László", "Nagy Sára", "Vadász Péter",
            "Bereczky Péter", "Szita Balázs", "Veszprémi Anna", "Megyesi Attila", "Nagy Ádám", "Kovácsné Pusztai Kinga Emese");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Analízis 1 Ea',
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

        $teachers = array("Dr. Weisz Ferenc");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Analízis 1 Gy',
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

        $teachers = array("Filipp Zoltán István", "Dr. Weisz Ferenc", "Huszárszky Szilvia Zsuzsanna", 
            "Dr. Kovács Sándor", "Németh Zsolt", "Szarvas Kristóf", "Lóczi Lajos Mihály","Dr. Chripkó Ágnes", 
            "Bognár Gergő", "Fábián Gábor", "Csörgő Katalin Mária", "Dr. Csörgő István", "György Szilvia");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Diszkrét matematika 1. Ea',
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

        $teachers = array("Ligeti Péter", "Juhász Zsófia", "Burcsi Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Diszkrét matematika 1. Gy',
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

        $teachers = array("Gonda János Ferenc","Burcsi Péter","Fülöp Ágnes", "Dr. Nagy Gábor", "Juhász Zsófia",
             "Mecséri Eszter Ágnes", "Dr. Tóth Viktória", "Gyarmati Máté", "Fonyó Dávid", "Bartha Dénes", "Farkas Izabella Ingrid", 
             "Koch-Gömöri Richárd", "Szeidl Rita Betti", "Uray Marcell János", "Bóka Dávid", "Réti Attila");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Funkcionális programozás Ea+Gy',
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

        $teachers = array("Dr. Horváth Zoltán", "Bozó István", "Poór Artúr", "Nagy Gergely", "Podlovics Péter Dávid", 
            "Kovács András", "Németh Boldizsár", "Diviánszky Péter", "Lukács Dániel", "Tőkés Anna", "Bense Viktor");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Imperatív programozás Ea+Gy',
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

        $teachers = array("Dr. Kozsik Tamás", "Leitereg András", "Porkoláb Zoltán", "Gera Zoltán", "Horpácsi Dániel", "Nagy Vendel", 
             "Tejfel Máté", "Bán Róbert", "Kovács Réka", "Kaposi Ambrus", "Szabó Miklós", "Sinkovics Ábel", "Horváth Gábor",
             "Benics Balázs", "Leskó Dániel", "Brunner Tibor", "Cserép Máté András", "Szalay Richárd");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Konkurrens programozás Ea+Gy',
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

        $teachers = array("Dr. Kozsik Tamás", "Grünwald Péter", "Menczer Andor", "Kovács Norbert Zsolt",
         "Tabi Zsolt István", "Zaicsek Balázs" ,"Kitlei Róbert László", "Parragi Zsolt", "Mátyás Zoltán", "Szabó Attila");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Mesterséges intelligencia Ea',
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

        $teachers = array("Gregorics Tibor");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
        
        $subject = Subject::create(['name' => 'Objektumelvű programozás Ea+Gy',
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

        $teachers = array("Dr. Gregorics Tibor", "Borsi Zsolt Richárd", "Várkonyi Teréz Anna",
           "Veszprémi Anna", "Szalontai Balázs", "Kovácsné Pusztai Kinga Emese", "Pintér Balázs", "Nagymáté Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Operációs rendszerek Ea+Gy',
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

        $teachers = array("Korom Szilárd", "Dr. Illés Zoltán", "Bakonyi Viktória Judit", "Klettner Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Programozás Ea+Gy',
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

        $teachers = array("Zsakó László", "Dr. Horváth Gyula", "Menyhárt László Gábor", "Leitereg András", 
           "Bakonyi Viktória Judit", "Kovácsné Pusztai Kinga Emese", "Szalayné Tahy Zsuzsanna", "Veszprémi Anna",
           "Törley Gábor", "Szlávi Péter", "Nikházy László", "Daiki Tennó", "Dr. Körmendi Sándor", "Szabó Zsanett",
           "Pluhár Zsuzsa", "Torma Hajnalka", "Klettner Péter", "Bende Imre",
           "Wolosz Jakab", "Nagy Vendel", "Horváth Győző");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Programozási nyelvek 1 Ea+Gy',
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

        $teachers = array("Pataki Norbert", "Umann Kristóf", "Nagy Vendel", "Tarsoly Gergely", "Angeli Gergely",
            "Szabó Miklós", "Gyén Attila", "Kovács Réka Nikolett", "Kiglics Mátyás", "Nagy András", "Gyarmati Péter",
            "Tabi Zsolt István", "Révész Ádám", "Fazekas Bálint", "Kolozsvári Dániel László", "Varga Bence Levente");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Programozási nyelvek 2 Ea+Gy',
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

        $teachers = array("Franke Gábor László", "Németh Boldizsár", "Dr. Kozsik Tamás", "Nagy András", "Kruppai Gábor", 
            "Tabi Zsolt István", "Révész Ádám", "Fazekas Bálint", "Varga Bence Levente", "Kocsis Ábel", "Zaicsek Balázs",
            "Angeli Gergely", "Szabó Miklós", "Nagy Gergely", "Dr. Lázár Katalin Anna");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Számítógépes rendszerek Ea+Gy',
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

        $teachers = array("Nagymáté Péter", "Dr. Illés Zoltán", "Kereszti Zalán", "Heizler Tamás Ferenc", "Bakonyi Viktória Judit",
            "Csongrádi Tamás", "Györgyi Csaba", "Klettner Péter", "Korom Szilárd", "Lehotay-Kéry Péter", "Menyhárt László Gábor", 
            "Nemes Balázs", "Nemes Marcell", "Sándor Antal", "Szabó Dávid");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Telekommunikációs hálózatok Ea',
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
    
        $teachers = array("Laki Sándor", "Fejes Ferenc", "Gombos Gergő", "Györgyi Csaba", "Szalai-Gindl János Márk");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Telekommunikációs hálózatok Gy',
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
    
        $teachers = array("Laki Sándor", "Fejes Ferenc", "Gombos Gergő", "Györgyi Csaba", "Szalai-Gindl János Márk",
            "Kecskeméti Károly", "Vincellér Zoltán");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Web-fejlesztés Ea+Gy',
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

        $teachers = array("Gyén Attila", "Abonyi-Tóth Andor", "Zsakó László", "Csongrádi Tamás", "Pluhár Zsuzsa",
            "Torma Hajnalka", "Korom Szilárd", "Bernát Péter", "Ciuciu-Kiss Jenifer Tabita",
            "Kovács Réka", "Rádai Ábris Gábor", "Buzgán Attila", "Papp Mátyás", "Menyhárt László Gábor", "Bucsánszki Tamás Mihály");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Adatbázisok 2 Ea',
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

        $teachers = array("Dr. Kiss Attila Elemér", "Dr. Nikovits Tibor", "Szalai-Gindl János Márk");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Adatbázisok 2 Gy',
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

        $teachers = array("Brányi László", "Dr. Kiss Attila Elemér", "Dr. Nikovits Tibor", "Szalai-Gindl János Márk", 
            "Vincellér Zoltán");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Analízis 2 Ea',
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

        $teachers = array("Dr. Fridli Sándor", "Dr. Csörgő István", "Filipp Zoltán István", "Dr. Kovács Sándor",
            "Lóczi Lajos Mihály", "Németh Zsolt", "Dr. Toledo Rodolfo Calixto");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Analízis 2 Gy',
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

        $teachers = array("Dr. Fridli Sándor", "Dr. Csörgő István", "Filipp Zoltán István", "Dr. Kovács Sándor",
            "Dózsa Tamás Gábor", "Németh Zsolt", "Dr. Toledo Rodolfo Calixto");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Diszkrét matematika 2. Ea',
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

        $teachers = array("Juhász Zsófia");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Diszkrét matematika 2. Gy',
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

        $teachers = array("Juhász Zsófia", "Dr. Tóth Viktória", "Uray Marcell János", "Fülöp Ágnes");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Eseményvezérelt alkalmazások Ea+Gy',
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

        $teachers = array("Dr. Gregorics Tibor", "Mózsi Krisztián", "Cserép Máté András", "Nagymáté Péter", 
           "Várkonyi Teréz Anna", "Révész Ádám", "Szalontai Balázs", "Fekete Anett", "Cseresnyés Kristóf Bendegúz",
           "Károlyi Kristóf", "Kis Dávid", "Mucsányi Bálint Hunor");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Formális nyelvek és a fordítóprogramok alapjai Ea',
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

        $teachers = array("Dévai Gergely", "Nagy Sára");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Formális nyelvek és a fordítóprogramok alapjai Gy',
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

        $teachers = array("Leskó Dániel", "Dévai Gergely", "Nagy Sára", "Nagy András");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Numerikus módszerek 1. Ea',
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

        $teachers = array("Dr. Krebsz Anna");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Numerikus módszerek 1. Gy',
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

        $teachers = array("Dr. Bozsik József", "Dr. Lénárd Margit Mária", "Dózsa Tamás Gábor", "Fábián Gábor", "Dr. Krebsz Anna");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Programozáselmélet Ea',
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

        $teachers = array("Borsi Zsolt Richárd");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Programozáselmélet Gy',
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

        $teachers = array("Dr. Gregorics Tibor", "Borsi Zsolt Richárd", "Várkonyi Teréz Anna", "Bereczky Péter",
            "Varga László Zsolt");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Számításelmélet Ea',
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

        $teachers = array("Kolonits Gábor");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Számításelmélet Gy',
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

        $teachers = array("Ciuciu-Kiss Jenifer Tabita", "Kolonits Gábor", "Tichler Krisztián", "Vadász Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Numerikus módszerek 2 Ea',
        'code' => 'IP-18aNM2EE',
        'credit_points' => 2,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => false,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1060/Numerikus%20m%C3%B3dszerek%20II%20%28T%29.pdf']);

        $teachers = array("Dr. Bozsik József");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Numerikus módszerek 2 Gy',
        'code' => 'IP-18*NM2EG',
        'credit_points' => 3,
        'even_semester'=> false,
        'optionalOnA' => false,
        'optionalOnB' => false,
        'optionalOnC' => false,
        'existsOnA' => true,
        'existsOnB' => true,
        'existsOnC' => false,
        'url' => 'https://www.inf.elte.hu/dstore/document/1060/Numerikus%20m%C3%B3dszerek%20II%20%28T%29.pdf']);

        $teachers = array("Dr. Bozsik József", "Dr. Hiba Antal", "Kovács Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Szoftvertechnológia Ea+Gy',
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

        $teachers = array("Provender Roxána", "Varga László Zsolt", "Mózsi Krisztián", "Recse Ákos", "Cserép Máté András");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Többváltozós függvénytan Ea+Gy',
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
    
        $teachers = array("Dr. Csörgő István", "Szili László", "Filipp Zoltán István");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Valószínűségszámítás és statisztika Ea+Gy',
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
    
        $teachers = array("Dr. Kovács Ágnes", "Dr. Arató Miklós", "Borbély József", "Szabó Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Valószínűségszámítás és statisztika Ea+Gy (F)',
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

        $subject = Subject::create(['name' => 'Valószínűségszámítás',
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
    
        $subject = Subject::create(['name' => 'Matematikai statisztika',
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
    
        $subject = Subject::create(['name' => 'Bevezetés a gépi tanulásba Ea',
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
    
        $teachers = array("Lőrincz András", "Milacski Zoltán Ádám", "Varga Viktor");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Big Data architektúrák és elemző módszerek Ea',
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

        $teachers = array("Gombos Gergő", "Laki Sándor", "Szalai-Gindl János Márk");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Big Data architektúrák és elemző módszerek Gy',
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

        $teachers = array("Laki Sándor", "Gombos Gergő", "Szalai-Gindl János Márk", "Varga Dániel");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Full stack webprogramozás Ea+Gy',
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

        $teachers = array("Móger Tibor László", "Horváth Győző", "Nagy Barnabás");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Funkcionális nyelvek Ea+Gy',
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
    
        $teachers = array("Kovács András", "Kaposi Ambrus", "Bocquet Rafael");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'GPU programozás Ea+Gy',
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

        $teachers = array("Eichhardt Iván", "Dr. Hajder Levente");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Haladó Java Ea+Gy',
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

        $teachers = array("Schuh Marcell Szilveszter", "Kitlei Róbert László", "Neuwirth István", "Nok Ádám");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Kliensoldali webprogramozás Ea+Gy',
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
        
        $teachers = array("Bende Imre", "Horváth Győző", "Kiss Robin", "Németh Tamás Zoltán");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Kriptográfia és biztonság Ea',
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
        
        $teachers = array("Ligeti Péter", "Fonyó Dávid", "Hanyecz Ottó", "Nagy Ádám", "Seres István András");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Kriptográfia és biztonság Gy',
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
        
        $teachers = array("Ligeti Péter", "Nagy Ádám", "Burcsi Péter", "Fonyó Dávid");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Logika Ea',
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

        $teachers = array("Tejfel Máté", "Lovász Bence", "Tóth Gabriella");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Logika Gy',
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

        $teachers = array("Tóth Gabriella", "Jakab Olivér", "Tejfel Máté", "Krix Ádám György", "Bense Viktor", 
            "Bondár Renáta", "Kölcsényi Lilla", "Kulcsár Gergő", "Kocsis Barnabás Péter", "Zakariás Adrienn", 
            "Németh Tamás Zoltán", "Szemenyei Mónika Réka", "Kocsis Bálint", "Kaszab Péter", "Széles Márk", 
            "Szalai Patrik", "Lukács Dániel", "Parrag Szilárd Ádám", "Ladányi Szandra", "Kurucz Ádám");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
        
        $subject = Subject::create(['name' => 'Mély neuronhálók algoritmusai és fajtái Ea+Gy',
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
    
        $teachers = array("Kopácsi László", "Varga Viktor");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Numerikus algoritmusok Ea+Gy',
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

        $subject = Subject::create(['name' => 'Osztott rendszerek specifikációja és implementációja Ea',
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
    
        $teachers = array("Dr. Horváth Zoltán", "Tejfel Máté");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Osztott rendszerek specifikációja és implementációja Gy',
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
    
        $teachers = array("Dr. Horváth Zoltán", "Tejfel Máté", "Reale Anna", "Mészáros Mónika");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Programozási módszertan Ea',
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

        $teachers = array("Borsi Zsolt Richárd");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Programozási módszertan Gy',
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

        $teachers = array("Borsi Zsolt Richárd", "Dr. Gregorics Tibor", "Várkonyi Teréz Anna", "Kocsis Bálint");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Projekteszközök (Tools of software projects)',
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

        $teachers = array("Gera Zoltán", "Szalay Richárd", "Katona János Dávid");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Számítási modellek Ea',
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

        $teachers = array("Csuhaj Varjú Erzsébet", "Tichler Krisztián");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Számítási modellek Gy',
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

        $teachers = array("Kolonits Gábor", "Tichler Krisztián");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Számítógépes grafika Ea',
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
    
        $teachers = array("Bán Róbert");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Számítógépes grafika Gy',
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

        $teachers = array("Szabó Zsombor", "Bálint Csaba", "Bán Róbert", "Dr. Hajder Levente", "Tóth Tekla",
            "Szabó Dávid", "Hartner Stefánia", "Zsemberi Dániel Balázs", "Kiglics Mátyás");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Szerveroldali webprogramozás Ea+Gy',
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
    
        $teachers = array("Horváth Győző", "Kiss Robin", "Tóta Dávid");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Szoftver mély neuronhálók alkalmazásához Gy',
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

        $teachers = array("Varga Viktor", "Kopácsi László", "Kovács Bálint");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Típuselmélet Ea',
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

        $teachers = array("Kaposi Ambrus");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Típuselmélet Gy',
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

        $teachers = array("Luksa Norbert", "Kaposi Ambrus", "Széles Márk");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }
    
        $subject = Subject::create(['name' => 'Vállalati információs rendszerek és architektúrák Ea',
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

        $subject = Subject::create(['name' => 'Vállalati információs rendszerek és architektúrák Gy',
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
    
        $subject = Subject::create(['name' => 'Web-es alkalmazások fejlesztése Ea+Gy',
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

        $teachers = array("Cserép Máté András", "Fekete Anett", "Kis Dávid", "Provender Roxána");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Webprogramozás Ea+Gy',
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

        $teachers = array("Horváth Győző", "Visnovitz Márton", "Bende Imre", "Tűri Erik", "Bernát Péter");
        foreach($teachers as $teacher){
            $actTeacher = Teacher::where('name',$teacher)->first();
            if($actTeacher === null){
                $actTeacher = Teacher::factory()->create(['name' => $teacher]);
            }
            $subject->teachers()->attach($actTeacher->id,['is_active' => true,
                                                          'going_against' => 0,
                                                          'created_at' => Carbon::now(),
                                                          'updated_at' => Carbon::now()]);
        }

        $subject = Subject::create(['name' => 'Webprogramozás',
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
    
        $subject = Subject::create(['name' => 'Bevezetés a számításelméletbe Ea',
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

        $subject = Subject::create(['name' => 'Bevezetés a számításelméletbe Gy',
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
    
        $subject = Subject::create(['name' => 'Analízis 3 Ea',
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

        $subject = Subject::create(['name' => 'Analízis 3 Gy',
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
   
        $subject = Subject::create(['name' => 'Analízis alkalmazásai Ea',
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

        $subject = Subject::create(['name' => 'Analízis alkalmazásai Gy',
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
    
        $subject = Subject::create(['name' => 'Programozási technológia Ea+Gy',
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
    
        $subject = Subject::create(['name' => 'Diszkrét modellek alkalmazásai Gy',
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

        $subject = Subject::create(['name' => 'A számításelmélet alapjai 1 Ea',
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
    
        $subject = Subject::create(['name' => 'A számításelmélet alapjai 1 Gy',
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
    
        $subject = Subject::create(['name' => 'A számításelmélet alapjai 2 Ea',
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

        $subject = Subject::create(['name' => 'A számításelmélet alapjai 2 Gy',
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

        User::factory()->create( ['name' => "Admin",
                                  'email' => 'admin@tanulas.hu',
                                  'spec' => 'NOTHING',
                                  'is_admin' => true]);
    }

    //kihagyottak:
    //Jogi ismeretek Ea
    //Vállalkozás menedzsment
}
