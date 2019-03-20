<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadQuiz;
use App\LeadQuizResult;
use Illuminate\Http\Request;
use App\Opportunity;

class LeadQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lead-quiz.index')
            ->withQuestionnaires(LeadQuiz::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lead-quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('quiz')) {
            alert('Error', 'No Questions', 'error');

            return redirect()->back();
        }
        $data = $request->all();

        $questions = [];

        foreach ($data['quiz'] as $key => $quiz) {
            array_push($questions, [
                'question' => $quiz,
                'weight' => $data['weight'][$key]
            ]);
        }

        LeadQuiz::create([
            'title' => $data['title'],
            'questions' => json_encode($questions)
        ]);

        alert()->success('Success', 'Questionnaire Added Successfully');

        return redirect()->route('qualification-questions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeadQuiz  $leadQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(LeadQuiz $leadQuiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeadQuiz  $leadQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit($leadQuiz)
    {
        $quiz = LeadQuiz::find($leadQuiz);

        return view('lead-quiz.edit')
            ->withQuestionnaire($quiz);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeadQuiz  $leadQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $leadQuiz)
    {
        $questionnaire = LeadQuiz::find($leadQuiz);
        if ($questionnaire == null) {
            alert()->error('Error', 'Questionnaire Not Available');

            return redirect()->route('qualification-questions.index');
        }

        $data = $request->all();

        $questions = [];

        foreach ($data['quiz'] as $key => $quiz) {
            array_push($questions, [
                'question' => $quiz,
                'weight' => $data['weight'][$key]
            ]);
        }

        $questionnaire->update([
            'title' => $data['title'],
            'questions' => json_encode($questions)
        ]);

        alert()->success('Success', 'Questionnaire Updated Successfully');

        return redirect()->route('qualification-questions.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeadQuiz  $leadQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeadQuiz $leadQuiz)
    {
        $leadQuiz->update(['trashed' => 1]);

        toast('Deleted', 'Questionnaire Deleted Successfully');

        return redirect()->back();
    }

    public function leadQuestionnaire($lead_id)
    {
        $lead = Lead::find($lead_id);

        if ($lead->stage != config('sales-constants.default')) {

            alert()->error('Error', 'You Cannot Add Questionnaire');

            return redirect()->back();
        }

        return view('lead-quiz.fill-questionnaire')
            ->withQuestionnaires(LeadQuiz::all()->sortBy('title'))
            ->withLead($lead);
    }

    public function storeQuestionnaire(Request $request)
    {
        $lead = Lead::find($request->lead_id);

        if ($lead->stage != config('sales-constants.default')) {

            alert()->error('Error', 'You Cannot Add Questionnaire');

            return redirect()->back();
        }

        $data = $request->all();

        $result = [];

        foreach ($data['ans'] as $key => $datum) {
            array_push($result, [
                'question' => $data['question'][$key],
                'weight' => $data['weight'][$key],
                'answer' => $this->calculatePerc($data['weight'][$key], $data['ans'][$key])
            ]);
        }

        LeadQuizResult::create([
            'lead_id' => $data['lead_id'],
            'lead_quiz_id' => $data['questionnaire_id'],
            'question_result' => json_encode($result),
        ]);

        $lead->stage = config('sales-constants.questionnaire');
        $lead->save();

        alert()->success('Success', 'Questionnaire Added Successfully');

        return redirect('leads/view/' . $data['lead_id']);

    }

    protected function calculatePerc($weight, $ans)
    {
        return ceil((($ans * 100) / $weight));
    }

    public static function getSum(array $data, $key)
    {
        return ceil(array_sum(array_map(function ($item) use ($key) {
            return $item[$key];
        }, $data)));

    }
}
