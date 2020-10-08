<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamsController extends Controller
{
    /**
     * Create Exam Questions
     */
    public function createExam(Request $request) {
        $exam = new Exam();
        $exam->question = $request->question;
        $exam->option1 = $request->option1;
        $exam->option2 = $request->option2;
        $exam->option3 = $request->option3;
        $exam->option4 = $request->option4;
        $exam->category = $request->category;
        $exam->save();

        return $exam;
    }

    /**
     * Get Questions
     */
    public function getExams(Request $request) {
        $exams = Exam::all();

        return $exams;
    }

    /**
     * Update Exam Questions
     */
    public  function editExam(Request $request, $id){
        $exam =Exam::where('id',$id)->first();

        $exam->question = $request->get('val_1');
        $exam->option1 = $request->get('val_2');
        $exam->option2 = $request->get('val_3');
        $exam->option3 = $request->get('val_4');
        $exam->option4 = $request->get('val_5');
        $exam->category = $request->get('val_6');
        $exam->save();

        return $exam;
    }

    public function deleteExam(Request $request){
        $car = Exam::find($request->id)->delete();
    }
}
