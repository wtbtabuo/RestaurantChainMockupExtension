<?php
namespace User;

use DateTime;
use Interfaces\FileConvertible;

class User implements FileConvertible {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $hashedPassword;
    private string $phoneNumber;
    private string $address;
    private DateTime $birthDate;
    private DateTime $membershipExpirationDate;
    private string $role;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $hashedPassword, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate,
        string $role
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
        $this->birthDate = $birthDate;
        $this->membershipExpirationDate = $membershipExpirationDate;
        $this->role = $role;
    }

    public static function RandomGenerator(): self {
        $faker = \Faker\Factory::create();
        return new self(
            $faker->randomNumber(),
            $faker->firstName,
            $faker->lastName,
            $faker->email,
            password_hash($faker->password, PASSWORD_DEFAULT),
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTime,
            $faker->dateTime,
            $faker->word
        );
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function logIn(string $hashedPassword): bool {
        return $this->hashedPassword === $hashedPassword;
    }

    public function updateProfile(string $address, string $phoneNumber): void {
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }

    public function renewMembership(DateTime $membershipExpirationDate): void {
        $this->membershipExpirationDate = $membershipExpirationDate;
    }

    public function changePassword(string $hashedPassword): void {
        $this->hashedPassword = $hashedPassword;
    }

    public function hasMembershipExpired(): bool {
        return $this->membershipExpirationDate < new DateTime();
    }

    public function toString(): string {
        return "First Name: $this->firstName, Last Name: $this->lastName, Email: $this->email, Phone Number: $this->phoneNumber, Address: $this->address, Birth Date: {$this->birthDate->format('Y-m-d')}, Membership Expiration Date: {$this->membershipExpirationDate->format('Y-m-d')}, Role: $this->role";
    }

    public function toHTML(): string {
        return "<h1>User</h1>
                <p>ID: $this->id</p>
                <p>First Name: $this->firstName</p>
                <p>Last Name: $this->lastName</p>
                <p>Email: $this->email</p>
                <p>Phone Number: $this->phoneNumber</p>
                <p>Address: $this->address</p>
                <p>Birth Date: {$this->birthDate->format('Y-m-d')}</p>
                <p>Membership Expiration Date: {$this->membershipExpirationDate->format('Y-m-d')}</p>
                <p>Role: $this->role</p>";
    }

    public function toMarkdown(): string {
        return "### User
                - First Name: $this->firstName
                - Last Name: $this->lastName
                - Email: $this->email
                - Phone Number: $this->phoneNumber
                - Address: $this->address
                - Birth Date: {$this->birthDate->format('Y-m-d')}
                - Membership Expiration Date: {$this->membershipExpirationDate->format('Y-m-d')}
                - Role: $this->role";
    }

    public function toArray(): array {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'phoneNumber' => $this->phoneNumber,
            'address' => $this->address,
            'birthDate' => $this->birthDate->format('Y-m-d'), // DateTimeをフォーマット
            'membershipExpirationDate' => $this->membershipExpirationDate->format('Y-m-d'), // DateTimeをフォーマット
            'role' => $this->role
        ];
    }
}
