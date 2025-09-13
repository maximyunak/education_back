<?php

namespace App\Http\Controllers;

use App\Http\Requests\Theme\CreateThemeRequest;
use App\Http\Requests\Theme\UpdateThemeRequest;
use App\Models\Theme;
use App\Services\Theme\ThemeService;

class ThemeController extends Controller
{
    public function __construct(private readonly ThemeService $themeService) {}

    //
    public function index()
    {
        $themes = Theme::all();

        return $themes;
    }

    public function show(int $id)
    {
        $theme = Theme::find($id);

        return $theme;
    }

    public function store(CreateThemeRequest $request)
    {
        $dto = $request->toDTO();

        $theme = $this->themeService->store($dto);

        return $theme;
    }

    public function destroy(int $id)
    {
        return Theme::destroy($id);
    }

    public function update(int $id, UpdateThemeRequest $request)
    {
        $data = $request->validated();

        $theme = $this->themeService->update($id, $data);

        return $theme;
    }
}
