<?php

namespace RestaurantLocation;

use Interfaces\FileConvertible;
use Employee\Employee;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThrough;

    public function __construct(
        string $name, string $address,
        string $city, string $state,
        string $zipCode, array $employees,
        bool $isOpen, bool $hasDriveThrough
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThrough = $hasDriveThrough;
    }

    public static function RandomGenerator(): self {
        $faker = \Faker\Factory::create();
        $employees = [];
        for ($i = 0; $i < $faker->numberBetween(5, 20); $i++) {
            $employees[] = Employee::RandomGenerator(); // 名前空間を指定
        }
        return new self(
            $faker->company,
            $faker->address,
            $faker->city,
            $faker->state,
            $faker->postcode,
            $employees,
            $faker->boolean,
            $faker->boolean
        );
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function getState(): string {
        return $this->state;
    }

    public function getZipCode(): string {
        return $this->zipCode;
    }

    public function getIsOpen(): bool {
        return $this->isOpen;
    }

    public function toString(): string {
        return "Name: $this->name, Address: $this->address, City: $this->city, State: $this->state, Zip Code: $this->zipCode, Employees: " . count($this->employees) . ", Is Open: " . ($this->isOpen ? 'Yes' : 'No') . ", Has Drive Through: " . ($this->hasDriveThrough ? 'Yes' : 'No');
    }

    public function toHTML(): string {
        $employeesHTML = '';
        foreach ($this->employees as $employee) {
            $employeesHTML .= $employee->toHTML();
        }
        return "<div class='restaurant-location'>
                    <h1>{$this->name}</h1>
                    <p>Address: {$this->address}</p>
                    <p>City: {$this->city}</p>
                    <p>State: {$this->state}</p>
                    <p>Zip Code: {$this->zipCode}</p>
                    <p>Is Open: " . ($this->isOpen ? 'Yes' : 'No') . "</p>
                    <p>Has Drive Through: " . ($this->hasDriveThrough ? 'Yes' : 'No') . "</p>
                    <button class='toggle-button'>Show Employees</button>
                    <div class='employees' style='display: none;'>{$employeesHTML}</div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var buttons = document.querySelectorAll('.toggle-button');
                        buttons.forEach(function(button) {
                            button.addEventListener('click', function() {
                                var employeesDiv = this.nextElementSibling;
                                if (employeesDiv.style.display === 'none') {
                                    employeesDiv.style.display = 'block';
                                    this.textContent = 'Hide Employees';
                                } else {
                                    employeesDiv.style.display = 'none';
                                    this.textContent = 'Show Employees';
                                }
                            });
                        });
                    });
                </script>";
    }

    public function toMarkdown(): string {
        return "## Restaurant Location: {$this->name}
                 - Address: {$this->address}
                 - City: {$this->city}
                 - State: {$this->state}
                 - Zip Code: {$this->zipCode}
                 - Employees: " . count($this->employees) . "
                 - Is Open: " . ($this->isOpen ? 'Yes' : 'No') . "
                 - Has Drive Through: " . ($this->hasDriveThrough ? 'Yes' : 'No');
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'employees' => $this->employees,
            'isOpen' => $this->isOpen,
            'hasDriveThrough' => $this->hasDriveThrough
        ];
    }
}
