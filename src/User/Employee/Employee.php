<?php
namespace Employee;

use Interfaces\FileConvertible;
use User\User;
use DateTime;

class Employee extends User implements FileConvertible {
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private string $awards;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $hashedPassword, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate,
        string $role,
        string $jobTitle, float $salary, DateTime $startDate,
        string $awards
    ) {
        parent::__construct(
            $id, $firstName, $lastName, $email, $hashedPassword,
            $phoneNumber, $address, $birthDate, $membershipExpirationDate, $role
        );
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public static function RandomGenerator(): self {
        $faker = \Faker\Factory::create();
        return new self(
            $faker->randomNumber(), // ここで生成されるIDはint型
            $faker->firstName,
            $faker->lastName,
            $faker->email,
            password_hash($faker->password, PASSWORD_DEFAULT),
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTime,
            $faker->dateTime,
            $faker->word,
            $faker->jobTitle,
            $faker->randomFloat(2, 30000, 100000),
            $faker->dateTime,
            implode(', ', $faker->words) // 配列を文字列に変換
        );
    }

    public function getJobTitle(): string {
        return $this->jobTitle;
    }

    public function getSalary(): float {
        return $this->salary;
    }

    public function getStartDate(): DateTime {
        return $this->startDate;
    }

    public function getAwards(): string {
        return $this->awards;
    }

    public function toString(): string {
        return "Job Title: $this->jobTitle, Salary: $this->salary, Start Date: {$this->startDate->format('Y-m-d')}, Awards: $this->awards";
    }

    public function toHTML(): string {
        return "<h2>Employee</h2>
                <p>Job Title: $this->jobTitle</p>
                <p>Name: " . $this->getFirstName() . " " . $this->getLastName() . "</p>
                <p>Salary: $this->salary</p>
                <p>Start Date: {$this->startDate->format('Y-m-d')}</p>
                <p>Awards: $this->awards</p>";
    }

    public function toMarkdown(): string {
        return "### Employee
                - Job Title: $this->jobTitle
                - Salary: $this->salary
                - Start Date: {$this->startDate->format('Y-m-d')}
                - Awards: $this->awards";
    }

    public function toArray(): array {
        return [
            'jobTitle' => $this->jobTitle,
            'salary' => $this->salary,
            'startDate' => $this->startDate,
            'awards' => $this->awards
        ];
    }
}
