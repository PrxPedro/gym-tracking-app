<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalorieController extends Controller
{
    /**
     * Show the calorie calculator form.
     */
    public function index()
    {
        return view('calorie.index');
    }

    /**
     * Calculate the calorie needs based on the input data.
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'age' => 'required|integer|min:15|max:80',
            'gender' => 'required|in:male,female',
            'height' => 'required|numeric|min:50|max:250', // Height in cm
            'weight' => 'required|numeric|min:20|max:300', // Weight in kg
            'activity' => 'required|numeric|min:1.2|max:1.9', // Activity multiplier
        ]);
    
        // Input values
        $age = $request->age;
        $gender = $request->gender;
        $height = $request->height;
        $weight = $request->weight;
        $activity = $request->activity;
    
        // BMR calculation using the Mifflin-St Jeor Equation
        $bmr = $gender === 'male'
            ? (10 * $weight) + (6.25 * $height) - (5 * $age) + 5
            : (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    
        // TDEE calculation (BMR * activity multiplier)
        $tdee = $bmr * $activity;
    
        // Adjust calorie values for different goals
        $maintainCalories = $tdee;
        $mildLoseCalories = $tdee - 250; // Mild weight loss
        $loseCalories = $tdee - 500; // Weight loss
        $extremeLoseCalories = max($tdee - 1000, 1500); // Extreme weight loss, but not below 1500
        $gainCalories = $tdee + 500; // Weight gain
    
        return view('calorie.index', [
            'maintainCalories' => round($maintainCalories),
            'mildLoseCalories' => round($mildLoseCalories),
            'loseCalories' => round($loseCalories),
            'extremeLoseCalories' => round($extremeLoseCalories),
            'gainCalories' => round($gainCalories),
        ]);
    }
    
}
