<?php

namespace NutriCalc\Type;

class Calculator
{
    const FEMALE_GENDER = 0;
    const MALE_GENDER = 1;

    const LOW_ACTIVITY = 0;
    const NORMAL_ACTIVITY = 1;
    const HIGH_ACTIVITY = 2;

    const LOOSE_MASS_AIM = 0;
    const MAINTAIN_MASS_AIM = 1;
    const GAIN_MASS_AIM = 2;

    const GAIN_RATIO_PERCENTAGE = [
        'protein' => 35,
        'carbs' => 45,
        'fat' => 20
    ];
    const MAINTAIN_RATIO_PERCENTAGE = [
        'protein' => 25,
        'carbs' => 45,
        'fat' => 30
    ];
    const LOOSE_RATIO_PERCENTAGE = [
        'protein' => 40,
        'carbs' => 35,
        'fat' => 25
    ];

    const RECOMMENDED_PROTEIN_GAIN = 2.2;
    const RECOMMENDED_PROTEIN_MAINTAIN = 1.8;
    const RECOMMENDED_PROTEIN_LOOSE = 2;

    const CALORIES_PER_PROTEIN = 4;
    const CALORIES_PER_CARBS = 4;
    const CALORIES_PER_FAT = 9;


    private $weight;
    private $height;
    private $age;
    private $gender;
    private $activity;
    private $aim;

    public function __construct($data)
    {
        $this->weight = $data['weight'];
        $this->height = $data['height'];
        $this->age = $data['age'];
        $this->gender = $data['gender'];
        $this->activity = $data['activity'];
        $this->aim = $data['aim'];
    }

    public function calcNutritionRation()
    {
        $ration = [];

        switch ($this->aim) {
            case $this::GAIN_MASS_AIM:
                $ration['protein'] = $this->weight * $this::RECOMMENDED_PROTEIN_GAIN;
                $ration['carbs'] = $ration['protein'] / $this::GAIN_RATIO_PERCENTAGE['protein'] * $this::GAIN_RATIO_PERCENTAGE['carbs'];
                $ration['fat'] = $ration['protein'] / $this::GAIN_RATIO_PERCENTAGE['protein'] * $this::GAIN_RATIO_PERCENTAGE['fat'];
                break;
            case $this::MAINTAIN_MASS_AIM:
                $ration['protein'] = $this->weight * $this::RECOMMENDED_PROTEIN_MAINTAIN;
                $ration['carbs'] = $ration['protein'] / $this::MAINTAIN_RATIO_PERCENTAGE['protein'] * $this::MAINTAIN_RATIO_PERCENTAGE['carbs'];
                $ration['fat'] = $ration['protein'] / $this::MAINTAIN_RATIO_PERCENTAGE['protein'] * $this::MAINTAIN_RATIO_PERCENTAGE['fat'];
                break;
            case $this::LOOSE_MASS_AIM:
                $ration['protein'] = $this->weight * $this::RECOMMENDED_PROTEIN_LOOSE;
                $ration['carbs'] = $ration['protein'] / $this::LOOSE_RATIO_PERCENTAGE['protein'] * $this::LOOSE_RATIO_PERCENTAGE['carbs'];
                $ration['fat'] = $ration['protein'] / $this::LOOSE_RATIO_PERCENTAGE['protein'] * $this::LOOSE_RATIO_PERCENTAGE['fat'];
                break;
            default:
                $ration = [
                    'protein' => '0',
                    'carbs' => '0',
                    'fat' => '0'
                ];
        }

        $ration['calories'] = $this->calcCalories($ration['protein'], $ration['carbs'], $ration['fat']);

        foreach ($ration as $key => $value){
            $ration[$key] = round($value);
        }

        return $ration;
    }

    private function calcCalories($prot, $carbs, $fat)
    {
        return ($prot * $this::CALORIES_PER_PROTEIN) + ($carbs * $this::CALORIES_PER_CARBS) + ($fat * $this::CALORIES_PER_FAT);
    }

}