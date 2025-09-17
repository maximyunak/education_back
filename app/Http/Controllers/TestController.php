<?php

namespace App\Http\Controllers;

use App\DTOs\Test\TestDTO;
use App\Http\Requests\Test\CreateTestRequest;
use App\Models\Test;
use App\Services\Test\TestService;

class TestController extends Controller
{
    public function __construct(private readonly TestService $testService) {}

    public function index()
    {
        return Test::where('status', 'PUBLISHED');
    }

    public function all()
    {
        return Test::all();
    }

    public function userTests()
    {
        return auth()->user()->tests;
    }

    public function show(Test $test)
    {
        return $test->load('questions.answers');
    }

    public function store(CreateTestRequest $request)
    {
        $dto = TestDTO::fromRequest($request->validated(), auth()->id());

        $test = $this->testService->store($dto);

        return $test;
    }
}
