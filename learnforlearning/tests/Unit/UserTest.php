<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Subject;
use Carbon\Carbon;

class UserTest extends TestCase
{
    public function test_grades_count(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getGradesCount() === 7);

        $user = User::where('email',"user2@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getGradesCount() === 6);

        $user = User::where('email',"admin@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getGradesCount() === 0);
    }

    public function test_grades(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $grades = $user->getGrades();
        $this->assertTrue($grades['IP-18AA1E'] === "5");
        $this->assertTrue($grades['IP-18AA1G'] === "5");
        $this->assertTrue(!array_key_exists('IP-18AA2E',$grades));
    }

    public function getGrades() {
        $subjects = $this->subjects()->select('code')->get();
        $grades = [];
        foreach ($subjects as $subject) {
            $grades[$subject->code] = $subject->pivot->grade;
        }
        return $grades;
    }
}
            