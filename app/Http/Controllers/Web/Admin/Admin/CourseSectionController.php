<?php

namespace App\Http\Controllers\Web\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Traits\ResponseJson;
use Symfony\Component\HttpFoundation\Response;

class CourseSectionController extends Controller
{
    use ResponseJson;

    public function __construct(private readonly Course $courseModel)
    {
    }

    public function courseSections(Course $course): \Illuminate\Http\JsonResponse
    {
        $course->load('sections');
        return $this->responseJson(['type' => 'success', 'sections' => $course->sections], Response::HTTP_OK);
    }
}
