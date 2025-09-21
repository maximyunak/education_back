<?php

namespace App\Http\Controllers;

use App\DTOs\Test\TestDTO;
use App\Http\Requests\Test\CreateTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;
use App\Models\Test;
use App\Services\Test\TestService;

class TestController extends Controller
{
    public function __construct(private readonly TestService $testService) {}

    public function index()
    {
        // ! вернуть на опубликованные
        // return Test::where('status', 'PUBLISHED')->paginate(10);
        return Test::withCount('questions')->paginate(5);
    }

    public function all()
    {
        return Test::all();
    }

    public function userTests()
    {
        return auth()->user()->tests->paginate(10);
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

    public function update(Test $test, UpdateTestRequest $request)
    {
        $data = $request->validated();

        return $test->update($data);
    }

    public function destroy(Test $test)
    {
        return $test->delete();
    }
}
