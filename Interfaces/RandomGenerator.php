<?php

namespace RandomGenerator;

use Faker\Factory;
use RestaurantChain\RestaurantChain;
use Employee\Employee;
use RestaurantLocation\RestaurantLocation;

class RandomGenerator {
    public static function restaurantChains($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations): array {
        $faker = Factory::create();

        for ($i = 0; $i < $employeeCount; $i++) {
            $employees[] = Employee::RandomGenerator($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations);
        }   

        for ($i = 0; $i < $locationNumberRange; $i++) {
            $restaurantLocations[] = RestaurantLocation::RandomGenerator($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations);
        }

        $restaurantChains = [];
        for ($i = 0; $i < $faker->numberBetween(1, 5); $i++) {
            $restaurantChains[] = RestaurantChain::RandomGenerator($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations);
        }

        return $restaurantChains;
    }
}
