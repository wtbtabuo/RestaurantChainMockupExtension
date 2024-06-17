<?php

namespace RestaurantChain;

use Company\Company;
use Interfaces\FileConvertible;
use RestaurantLocation\RestaurantLocation;

class RestaurantChain extends Company implements FileConvertible{
    private int $chainId;
    private array $restaurantLocations;
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct($name, $foundingYear, $description, $website, $phone, $industry, $ceo, $isPubliclyTraded, $country, $founder, $totalEmployees, $chainId, $restaurantLocations, $cuisineType, $numberOfLocations, $parentCompany) {
        parent::__construct($name, $foundingYear, $description, $website, $phone, $industry, $ceo, $isPubliclyTraded, $country, $founder, $totalEmployees);
        $this->chainId = $chainId;
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    public static function RandomGenerator($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations): self {
        $faker = \Faker\Factory::create();
        $company = Company::RandomGenerator($employeeCount, $minSalary, $maxSalary, $locationNumberRange, $zipCodeRange, $employees, $restaurantLocations);
        $parentCompany = $company->getCompanyName();

        return new self(
            $faker->company,
            $faker->year,
            $faker->catchPhrase,
            $faker->url,
            $faker->phoneNumber,
            $faker->word,
            $faker->name,
            $faker->boolean,
            $faker->country,
            $faker->name,
            $faker->numberBetween(50, 10000),
            $faker->randomNumber(),
            $restaurantLocations,
            $faker->word,
            count($restaurantLocations),
            $parentCompany
        );
    }
    
    public function addNewRestaurant(int $chainId, RestaurantLocation $restaurantLocation, bool $cuisineType, int $numberOfLocations): void {
        $this->chainId = $chainId;
        $this->restaurantLocation = $restaurantLocation;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
    }

    public function getAllRestaurantLocation(): array {
        return $this->restaurantLocation;
    }

    public function getCompanyName(): string {
        return $this->parentCompany;
    }

    public function getCompanyDescription(): string {
        return $this->parentCompany->getCompanyDescription();
    }

    public function getCompanyWebsite(): string {
        return $this->parentCompany->getCompanyWebsite();
    }

    public function getCompanyYear(): int {
        return $this->parentCompany->getCompanyYear();
    }

    public function getCompanyPhone(): int {
        return $this->parentCompany->getCompanyPhone();
    }

    public function getCompanyIndustry(): string {
        return $this->parentCompany->getCompanyIndustry();
    }

    public function getCompanyCeo(): string {
        return $this->parentCompany->getCompanyCeo();
    }

    public function getIsPubliclyTraded(): bool {
        return $this->parentCompany->getIsPubliclyTraded();
    }

    public function toString(): string {
        "Chain ID: $this->chainId, Restaurant Location: $this->restaurantLocation, Cuisine Type: $this->cuisineType, Number of Locations: $this->numberOfLocations, Parent Company: $this->parentCompany";
    }

    public function toHTML(): string {
        $restaurantLocationsHTML = '';
        # restaurantLocationsのオブジェクトの配列をプリント

        foreach ($this->restaurantLocations as $restaurantLocation) {
            $restaurantLocationsHTML .= $restaurantLocation->toHTML();
        }
        return "<div class='restaurant-chain'>
                <h1>{$this->parentCompany}</h1>
                <p>Chain ID: {$this->chainId}</p>
                <p>Cuisine Type: {$this->cuisineType}</p>
                <h3>Restaurant Locations:</h3>
                {$restaurantLocationsHTML}
                </div>";
    }

    public function toMarkdown(): string {
        return "###Chain ID: $this->chainId
                - Restaurant Location: $this->restaurantLocation
                - Cuisine Type: $this->cuisineType
                - Number of Locations: $this->numberOfLocations
                - Parent Company: $this->parentCompany";
    }

    public function toArray(): array {
        return [
            'chainId' => $this->chainId,
            'restaurantLocation' => $this->restaurantLocation,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'parentCompany' => $this->parentCompany
        ];
    }
}
