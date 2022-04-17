<?php

namespace App\Services;

class RecipeService
{
    public function recalculateIngredients(
        string $title,
        int $serving,
        string $ingredientName,
        float $ingredientAmount)
    {
        switch ($ingredientName) {
            case 'flour':
                $ingredientsPortion = $this->getPortion(20, $ingredientAmount);
                break;
            case 'egg':
                $ingredientsPortion = $this->getPortion(2, $ingredientAmount);
                break;
            case 'milk':
                $ingredientsPortion = $this->getPortion(3, $ingredientAmount);
                break;
            case 'carbonated mineral water':
                $ingredientsPortion = $this->getPortion(2, $ingredientAmount);
                break;
            case 'salt':
                $ingredientsPortion = $this->getPortion(1, $ingredientAmount);
                break;
            case 'oil':
                $ingredientsPortion = $this->getPortion(0.75, $ingredientAmount);
                break;
            case 'oil for cooking':
                $ingredientsPortion = $this->getPortion(1, $ingredientAmount);
                break;
        }

        $servingPortion = $this->getPortion(4, $serving);

        $newRecipe = [
            'title' => $title,
            'servings' => $serving,
            'ingredients' => [
                0 => [
                    'name' => 'flour',
                    'amount' => 20*$ingredientsPortion*$servingPortion,
                    'unit' => 'dkg'
                ],
                1 => [
                    'name' => 'egg',
                    'amount' => 2*$ingredientsPortion*$servingPortion,
                    'unit' => 'piece'
                ],
                2 => [
                    'name' => 'milk',
                    'amount' => 3*$ingredientsPortion*$servingPortion,
                    'unit' => 'dl'
                ],
                3 => [
                    'name' => 'carbonated mineral water',
                    'amount' => 2*$ingredientsPortion*$servingPortion,
                    'unit' => 'dl'
                ],
                4 => [
                    'name' => 'salt',
                    'amount' => $ingredientsPortion*$servingPortion,
                    'unit' => 'pinch'
                ],
                5 => [
                    'name' => 'oil',
                    'amount' => 0.75*$ingredientsPortion*$servingPortion,
                    'unit' => 'dl'
                ],
                6 => [
                    'name' => 'oil for cooking',
                    'amount' => $ingredientsPortion*$servingPortion,
                    'unit' => 'dl'
                ]
            ]
        ];

        return $newRecipe;
    }

    public function getPortion(float $baseValue, float $newValue):float
    {
        return $newValue/$baseValue;
    }
}