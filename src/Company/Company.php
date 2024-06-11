<?php

namespace Company;

use Interfaces\FileConvertible;

class Company implements FileConvertible{

    private string $name;
    private int $foundingYear;
    private string $description;
    private string $website;
    private string $phone;
    private string $industry;
    private string $ceo;
    private bool $isPubliclyTraded;
    private string $country;
    private string $founder;
    private int $totalEmployees;

    public function __construct(
        string $name, int $foundingYear, string $description, string $website,
        string $phone, string $industry, string $ceo, bool $isPubliclyTraded,
        string $country, string $founder, int $totalEmployees
    ) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }

    public static function RandomGenerator(): self {
        $faker = \Faker\Factory::create();
        return new self(
            $faker->company,
            $faker->year,
            $faker->sentence,
            $faker->url,
            $faker->phoneNumber,
            $faker->word,
            $faker->name,
            $faker->boolean,
            $faker->country,
            $faker->name,
            $faker->randomNumber()
        );
    }

    public function getCompanyName(): string {
        return $this->name;
    }

    public function getCompanyDescription(): string {
        return $this->description;
    }

    public function getCompanyWebsite(): string {
        return $this->website;
    }

    public function getCompanyYear(): int {
        return $this->foundingYear;
    }

    public function getCompanyPhone(): int {
        return $this->phone;
    }

    public function getCompanyIndustry(): string {
        return $this->industry;
    }

    public function getCompanyCeo(): string {
        return $this->ceo;
    }

    public function getIsPubliclyTraded(): bool {
        return $this->isPubliclyTraded;
    }

    # Implement the interface methods
    public function toFileString(): string {
        return sprintf(
            "Company Name: %s\nFounded: %d\nDescription: %s\nWebsite: %s\nPhone: %d\nIndustry: %s\nCEO: %s\nPublicly Traded: %s\nCountry: %s\nFounder: %s\nTotal Employees: %d\n",
            $this->name, $this->foundingYear, $this->description, $this->website,
            $this->phone, $this->industry, $this->ceo, $this->isPubliclyTraded ? 'Yes' : 'No',
            $this->country, $this->founder, $this->totalEmployees
        );
    }

    public function toHTML(): string {
        return sprintf(
            "<h1>%s</h1>\n<p>Founded: %d</p>\n<p>Description: %s</p>\n<p>Website: %s</p>\n<p>Phone: %d</p>\n<p>Industry: %s</p>\n<p>CEO: %s</p>\n<p>Publicly Traded: %s</p>\n<p>Country: %s</p>\n<p>Founder: %s</p>\n<p>Total Employees: %d</p>\n",
            $this->name, $this->foundingYear, $this->description, $this->website,
            $this->phone, $this->industry, $this->ceo, $this->isPubliclyTraded ? 'Yes' : 'No',
            $this->country, $this->founder, $this->totalEmployees
        );
    }

    public function toMarkdown(): string {
        return "## Company: {$this->name}
                 - Founded: {$this->foundingYear}
                 - Description: {$this->description}
                 - Website: {$this->website}
                 - Phone: {$this->phone}
                 - Industry: {$this->industry}
                 - CEO: {$this->ceo}
                 - Publicly Traded: " . ($this->isPubliclyTraded ? 'Yes' : 'No') . "
                 - Country: {$this->country}
                 - Founder: {$this->founder}
                 - Total Employees: {$this->totalEmployees}";
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded,
            'country' => $this->country,
            'founder' => $this->founder,
            'totalEmployees' => $this->totalEmployees
        ];
    }
}
