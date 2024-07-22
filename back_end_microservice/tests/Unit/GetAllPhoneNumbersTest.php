<?php

namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\PhoneNumberController;
use App\Models\PhoneNumbers;
use Illuminate\Http\Request;

class GetAllPhoneNumbersTest extends TestCase
{
    public function testGetAllNumbers()
    {
        // Mock the PhoneNumbers model
        $mockNumbers = [
            ['number' => '1234567890'],
            ['number' => '9876543210'],
            ['number' => '5556667777'],
        ];

        $phoneNumbersModelMock = $this->getMockBuilder(PhoneNumbers::class)
                                     ->disableOriginalConstructor()
                                     ->getMock();

        // Create an instance of PhoneNumberController with mocked PhoneNumbers model
        $controller = new PhoneNumberController($phoneNumbersModelMock);

        // Simulate a GET request
        $response = $this->get('/api/get-all-numbers');

        // Assertions
        $response->assertStatus(200); // Check if the response status code is 200
        $responseData = $response->json();
        $this->assertIsArray($responseData); // Check if response is an array
        $this->assertCount(9, $responseData); // Check if the correct number of phone numbers are returned
        // Optional: You can add more specific assertions based on your JSON structure
    }
}
