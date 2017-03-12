<?php

namespace NutriCalc\Resources;

class Calculator
{
    const FEMALE_GENDER = 0;
    const MALE_GENDER = 1;

    const FEMALE_INDEX = 1;
    const MALE_INDEX = 1.1;

    const LOW_ACTIVITY = 0;
    const NORMAL_ACTIVITY = 1;
    const HIGH_ACTIVITY = 2;

    const LOW_ACTIVITY_INDEX = -200;
    const NORMAL_ACTIVITY_INDEX = +200;
    const HIGH_ACTIVITY_INDEX = +500;

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

    public function __construct(array $data)
    {
        $this->weight = $data['weight'];
        $this->height = $data['height'];
        $this->age = $data['age'];
        $this->gender = $data['gender'];
        $this->activity = $data['activity'];
        $this->aim = $data['aim'];
    }

    public function calcNutritionRatio()
    {
        switch ($this->aim) {
            case $this::GAIN_MASS_AIM:
                $ratio = $this->calcNutritions($this::RECOMMENDED_PROTEIN_GAIN, $this::GAIN_RATIO_PERCENTAGE);
                break;
            case $this::MAINTAIN_MASS_AIM:
                $ratio = $this->calcNutritions($this::RECOMMENDED_PROTEIN_MAINTAIN, $this::MAINTAIN_RATIO_PERCENTAGE);
                break;
            case $this::LOOSE_MASS_AIM:
                $ratio = $this->calcNutritions($this::RECOMMENDED_PROTEIN_LOOSE, $this::LOOSE_RATIO_PERCENTAGE);
                break;
            default:
                $ratio = [
                    'protein' => '0',
                    'carbs' => '0',
                    'fat' => '0'
                ];
        }

        $ratio['calories'] = $this->calcCalories($ratio['protein'], $ratio['carbs'], $ratio['fat']);

        foreach ($ratio as $key => $value){
            $ratio[$key] = round($value);
        }

        return $ratio;
    }

    private function calcCalories($prot, $carbs, $fat)
    {
        $baseCal = ($prot * $this::CALORIES_PER_PROTEIN) + ($carbs * $this::CALORIES_PER_CARBS) + ($fat * $this::CALORIES_PER_FAT);
        $calories = $baseCal + $this->getActivityIndex();

        return $calories;
    }

    private function calcNutritions($recommendedProtein, $rationPercentage)
    {
        $ratio['protein'] = $this->weight * $recommendedProtein;
        $ratio['carbs'] = $ratio['protein'] / $rationPercentage['protein'] * $rationPercentage['carbs'];
        $ratio['fat'] = $ratio['protein'] / $rationPercentage['protein'] * $rationPercentage['fat'];

        return $ratio;
    }

    private function getActivityIndex()
    {
        switch ($this->activity){
            case $this::HIGH_ACTIVITY:
                $activity =  $this::HIGH_ACTIVITY_INDEX;
                break;
            case $this::NORMAL_ACTIVITY:
                $activity = $this::NORMAL_ACTIVITY_INDEX;
                break;
            case $this::LOW_ACTIVITY:
                $activity = $this::LOW_ACTIVITY_INDEX;
                break;
            default:
                $activity = 0;
        }

        return $activity;
    }

    private function getGenderIndex()
    {
        switch ($this->gender){
            case $this::FEMALE_GENDER:
                $genderIndex =  $this::FEMALE_INDEX;
                break;
            case $this::MALE_GENDER:
                $genderIndex = $this::MALE_INDEX;
                break;
            default:
                $genderIndex = 0;
        }

        return $genderIndex;
    }

    private function getRecommendedProteinByAim()
    {
        switch ($this->activity){
            case $this::GAIN_MASS_AIM:
                $recommendedProtein =  $this::RECOMMENDED_PROTEIN_GAIN;
                break;
            case $this::MAINTAIN_MASS_AIM:
                $recommendedProtein = $this::RECOMMENDED_PROTEIN_MAINTAIN;
                break;
            case $this::LOOSE_MASS_AIM:
                $recommendedProtein = $this::RECOMMENDED_PROTEIN_LOOSE;
                break;
            default:
                $recommendedProtein = 0;
        }

        return $recommendedProtein;
    }

    private function getRatioPercentageByAim()
    {
        switch ($this->activity){
            case $this::GAIN_MASS_AIM:
                $ratioPercentage =  $this::GAIN_RATIO_PERCENTAGE;
                break;
            case $this::MAINTAIN_MASS_AIM:
                $ratioPercentage = $this::MAINTAIN_RATIO_PERCENTAGE;
                break;
            case $this::LOOSE_MASS_AIM:
                $ratioPercentage = $this::LOOSE_RATIO_PERCENTAGE;
                break;
            default:
                $ratioPercentage = 0;
        }

        return $ratioPercentage;
    }
}