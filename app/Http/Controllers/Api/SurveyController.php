<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Survey::orderByDesc('created_at')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $rules = [
            'json' => ['required', 'array']
        ], $messages = [
            'required' => ':attribute는 필수 항목입니다.',
            'array' => ':attribute가 올바른 JSON 형식이 아닙니다.'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $survey = new Survey();
        $json = $request->input('json');
        $survey->survey_json = $json;

        $survey->survey_name = $json['title'];
        $survey->save();

        return response()->json([
            'id' => $survey->getKey()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(
            Survey::find($id)
        );
    }

//    /**
//     * Update the specified resource in storage.
//     *
//     * @param Request $request
//     * @param int $id
//     * @return JsonResponse
//     */
//    public function update(Request $request, int $id): JsonResponse
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        if ($survey = Survey::find($id)) {
            return response()->json([
                'result' => $survey->delete()
            ]);
        }

        return response()->json([
            'result' => true
        ]);
    }
}
