<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;

class TeacherTest extends TestCase
{
    public function test_comments(){
        $user = User::where('email',"user2@tanulas.hu")->first();
        $this->assertTrue($user !== null);
        $teacher = Teacher::where('id',1)->first();
        $this->assertTrue($teacher !== null);

        $this->assertTrue($user->addComment(-1,"This is a test comment!") === null);
        $this->assertTrue(count($teacher->comments())===0);

        //add a comment
        $user->addComment($teacher->id, "This is a good test comment!");
        $teacher_comments = $teacher->comments();
        $this->assertTrue($teacher_comments[$user->name]['comment'] === "This is a good test comment!");

        //modify the comment
        $user->addComment($teacher->id, "This is a good, modified test comment!");
        $teacher_comments = $teacher->comments();
        $this->assertTrue($teacher_comments[$user->name]['comment'] === "This is a good, modified test comment!");

        //delete the last comment
        $user->deleteComment($teacher->id);
        $teacher_comments = $teacher->comments();
        $this->assertTrue(count($teacher->comments())===0);
    }

    public function test_activity(){
        $teacher = Teacher::where('id',1)->first();
        $this->assertTrue($teacher !== null);
        $teacher->setActivity(1, false);
        $this->assertTrue(!(boolean)$teacher->getActivity(1));
        $teacher->setActivity(1, true);
        $this->assertTrue((boolean)$teacher->getActivity(1));
    }

    public function test_going_against(){
        $teacher = Teacher::where('id',1)->first();
        $this->assertTrue($teacher !== null);

        //increase it
        $teacher->increaseGoingAgainst(1,false);
        $this->assertTrue((int)$teacher->getGoingAgainst(1)==1);
        $teacher->increaseGoingAgainst(1,false);
        $this->assertTrue((int)$teacher->getGoingAgainst(1)==2);

        //not increase it, because same activity level
        $teacher->increaseGoingAgainst(1,true);
        $this->assertTrue((int)$teacher->getGoingAgainst(1)==2);

        //reset
        $teacher->resetGoingAgainst(1);
        $this->assertTrue((int)$teacher->getGoingAgainst(1)==0);

        $teacher->increaseGoingAgainst(1,false);
        $this->assertTrue((int)$teacher->getGoingAgainst(1)==1);

        //setActivity will reset it to 0
        $teacher->setActivity(1, false);
        $this->assertTrue((int)$teacher->getGoingAgainst(1)==0);

        $teacher->setActivity(1, true);
    }

    public function test_acception(){
        $teacher = Teacher::where('id',1)->first();
        $this->assertTrue($teacher !== null);
        $this->assertTrue((boolean)$teacher->isActive());
    }
}