<?php

namespace App\Services\Theme;

use App\DTOs\Theme\ThemeDTO;
use App\Models\Theme;

class ThemeService
{
    public function __construct() {}

    public function store(ThemeDTO $themeDTO): Theme
    {

        return Theme::create(
            [
                'name' => $themeDTO->name,
                'description' => $themeDTO->description,
            ]
        );
    }

    public function update(int $id, $data)
    {
        $theme = Theme::find($id);
        $theme->update($data);

        return $theme;
    }
}
