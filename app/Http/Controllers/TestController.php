<?php

namespace App\Http\Controllers;

use App\DTOs\Test\TestDTO;
use App\Http\Requests\Test\CreateTestRequest;
use App\Services\Test\TestService;

class TestController extends Controller
{
    public function __construct(private readonly TestService $testService) {}

    public function store(CreateTestRequest $request)
    {
        $dto = TestDTO::fromRequest($request->validated(), auth()->id());

        $test = $this->testService->store($dto);

        return $test;
    }
}
