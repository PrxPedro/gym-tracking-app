
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4 text-center text-white">Calorie Calculator</h1>
        <p class="text-center mb-4 text-white">The Calorie Calculator can be used to estimate the number of calories a person needs to consume each day. This calculator can also provide some simple guidelines for gaining or losing weight.</p>

        <div class="flex justify-between gap-6">
            <!-- Left Side: Form -->
            <div class="w-full">
                <form action="{{ route('calorie.calculate') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="age" class="block font-bold mb-2 text-white">Age (15-80):</label>
                        <input type="number" id="age" name="age" class="w-full p-2 border rounded-lg @error('age') border-red-500 @enderror" min="15" max="80" required>
                        @error('age')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="block font-bold mb-2 text-white">Gender:</label>
                        <select id="gender" name="gender" class="w-full p-2 border rounded-lg @error('gender') border-red-500 @enderror" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="height" class="block font-bold mb-2 text-white">Height (cm):</label>
                        <input type="number" id="height" name="height" class="w-full p-2 border rounded-lg @error('height') border-red-500 @enderror" required>
                        @error('height')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="weight" class="block font-bold mb-2 text-white">Weight (kg):</label>
                        <input type="number" id="weight" name="weight" class="w-full p-2 border rounded-lg @error('weight') border-red-500 @enderror" required>
                        @error('weight')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="activity" class="block font-bold mb-2 text-white">Activity Level:</label>
                        <select id="activity" name="activity" class="w-full p-2 border rounded-lg @error('activity') border-red-500 @enderror" required>
                            <option value="1.2">Sedentary (little or no exercise)</option>
                            <option value="1.375">Lightly Active (light exercise)</option>
                            <option value="1.55">Moderately Active (moderate exercise)</option>
                            <option value="1.725">Very Active (hard exercise)</option>
                            <option value="1.9">Super Active (very hard exercise)</option>
                        </select>
                        @error('activity')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">Calculate</button>
                    </div>
                </form>
            </div>

            <!-- Right Side: Results -->
            <div class="w-full">
                @if (isset($maintainCalories))
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                        <h4 class="text-xl font-semibold mb-3 text-white">Results</h4>
                        <p class="mb-4 text-white">The results show a number of daily calorie estimates that can be used as a guideline for how many calories to consume each day to maintain, lose, or gain weight at a chosen rate.</p>

                        <table class="w-full text-center mb-4 text-white">
                            <thead>
                                <tr>
                                    <th class="p-2">Maintain Weight</th>
                                    <th class="p-2">Mild Weight Loss</th>
                                    <th class="p-2">Weight Loss</th>
                                    <th class="p-2">Extreme Weight Loss</th>
                                    <th class="p-2">Weight Gain</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-2">{{ $maintainCalories }} Cals/Day</td>
                                    <td class="p-2">{{ $mildLoseCalories }} Cals/Day</td>
                                    <td class="p-2">{{ $loseCalories }} Cals/Day</td>
                                    <td class="p-2">{{ $extremeLoseCalories }} Cals/Day</td>
                                    <td class="p-2">{{ $gainCalories }} Cals/Day</td>
                                </tr>
                            </tbody>
                        </table>


                        <p class="text-sm text-gray-600 dark:text-gray-400"><strong>Note:</strong> Please consult with a doctor when losing 1 kg or more per week since it requires that you consume less than the minimum recommendation of 1,500 calories a day.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection