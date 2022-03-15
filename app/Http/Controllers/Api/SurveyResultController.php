<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SurveyResultController extends Controller
{
    /**
     * @param int $surveyId
     * @return JsonResponse
     */
    public function index(int $surveyId): JsonResponse
    {
        $survey = Survey::find($surveyId);
        $result = $survey->result()->get();

        return response()->json([
            'survey' => $survey,
            'results' => $result
        ]);
    }

    /**
     * @param int $surveyId
     * @param int $resultId
     * @return JsonResponse
     */
    public function show(int $surveyId, int $resultId): JsonResponse
    {
        $survey = Survey::find($surveyId);
        $result = $survey->result()->find($resultId);

        return response()->json([
            'survey' => $survey,
            'result' => $result
        ]);
    }

    /**
     * @param Request $request
     * @param int $surveyId
     * @return JsonResponse
     */
    public function store(Request $request, int $surveyId): JsonResponse
    {
        $result = new SurveyResult();
        $result->result = $request->input('data');

        $survey = Survey::find($surveyId);

        $survey->result()->save($result);

        return response()->json($result);
    }
}
