<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;
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

    public function test_vote(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $teacher = Teacher::where('id',1)->first();
        $this->assertTrue($teacher !== null);

        //vote good on a teacher
        $user->vote($teacher->id,'1');
        $user_vote = $user->votes()->where('teacher_id',$teacher->id)->first();
        $this->assertTrue($user_vote->pivot->is_positive_vote === '1');

        //vote bad on the same teacher
        $user->vote($teacher->id,'0');
        $user_vote = $user->votes()->where('teacher_id',$teacher->id)->first();
        $this->assertTrue($user_vote->pivot->is_positive_vote === '0');

        //back vote from the same teacher
        $user->vote($teacher->id,'0');
        $user_vote = $user->votes()->where('teacher_id',$teacher->id)->first();
        $this->assertTrue($user_vote === null);

        $this->assertTrue($user->vote(-1,1) === null);
    }

    public function test_average(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getGradesAverage()===5);

        $user = User::where('email',"user6@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getGradesAverage()===2.5);
    }

    public function test_opt_average(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getOptionalGradesAverage()===5.);

        $user = User::where('email',"user10@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getOptionalGradesAverage() === 5.);

        //without optional grades
        $user = User::where('email',"user8@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getOptionalGradesAverage() === null);
    }

    public function test_acquired_credits(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getAcquiredCredits()===20);

        $user = User::where('email',"user6@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getAcquiredCredits()===19);
    }

    public function test_comments(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $teacher = Teacher::where('id',1)->first();
        $this->assertTrue($teacher !== null);

        $this->assertTrue($user->addComment(-1,"This is a test comment!") === null);

        //add a comment
        $user->addComment($teacher->id, "This is a good test comment!");
        $user_comments = $user->comments();
        $this->assertTrue($user_comments[$teacher->id]['comment'] === "This is a good test comment!");

        //modify the comment
        $user->addComment($teacher->id, "This is a good, modified test comment!");
        $user_comments = $user->comments();
        $this->assertTrue($user_comments[$teacher->id]['comment'] === "This is a good, modified test comment!");

        //delete the last comment
        $user->deleteComment($teacher->id);
        $user_comments = $user->comments();
        $this->assertTrue(!array_key_exists($teacher->id,$user_comments));

        $this->assertTrue($user->deleteComment(-1) === null);
    }

    public function test_available_optionals(){
        //no specialization
        $user = User::where('email',"admin@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getAvailableOptionalSubjects() === null);

        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $available_optionals = $user->getAvailableOptionalSubjects();
        $this->assertTrue(count($available_optionals)===29);
        $subject_codes = [];
        foreach ($available_optionals as $subject) {
            array_push($subject_codes,$subject->code);
        }
        $this->assertTrue(!in_array("IP-18KVELE",$subject_codes));
        $this->assertTrue(!in_array("IP-18KVELG",$subject_codes));
    }

    public function test_optionals(){
        //no specialization
        $user = User::where('email',"admin@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->getOptionalSubjects() === null);

        $user = User::where('email',"user8@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue(count($user->getOptionalSubjects()) === 0);

        $user = User::where('email',"user1@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $optionals = $user->getOptionalSubjects();
        $this->assertTrue(count($optionals)===4);
        $subject_codes = [];
        foreach ($optionals as $subject) {
            array_push($subject_codes,$subject->code);
        }
        $this->assertTrue(in_array("IP-18KVELE",$subject_codes));
        $this->assertTrue(in_array("IP-18KVELG",$subject_codes));
        $this->assertTrue(!in_array("IP-18AA1E",$subject_codes));
    }

    public function test_grade(){
        $user = User::where('email',"user1@tanulas.hu")->first();
        $subject = Subject::where('code', "IP-18KVMNMALEG")->first();
        $this->assertTrue($user !== null);
        $this->assertTrue($user->setGrade("IP-18KVMNMALE",5) === null);
        $user->setGrade($subject->code,5);
        $grades = $user->getGrades();
        $this->assertTrue($grades['IP-18KVMNMALEG'] === "5");
        $user->setGrade($subject->code,4);
        $grades = $user->getGrades();
        $this->assertTrue($grades['IP-18KVMNMALEG'] === "4");
        $user->deleteGrade($subject);
        $grades = $user->getGrades();
        $this->assertTrue(!array_key_exists('IP-18KVMNMALEG',$grades));
    }
}
            