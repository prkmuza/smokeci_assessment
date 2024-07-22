<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumber;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use App\Models\PhoneNumbers;

class PhoneNumberController extends Controller
{

    public function validateAndStore(Request $request,$country_code_number,$country_code_string,$quantity)
    {
        // Initialize PhoneNumberUtil instance
        $phoneUtil = PhoneNumberUtil::getInstance();

        $validRegionCodes = $phoneUtil->getSupportedRegions();

        if (in_array($country_code_string, $validRegionCodes)) {

            try {
                $phoneNumbers = [];
                 // Instantiate PhoneNumbers model
                $phoneNumbersModel = new PhoneNumbers();

                for ($i = 0; $i < $quantity; $i++) {
                    // Create an empty PhoneNumber object
                    $phoneNumber = new PhoneNumber();

                    // Set country code
                    $phoneNumber->setCountryCode($phoneUtil->getCountryCodeForRegion($country_code_string));

                    // Generate a random national number part
                    $nationalNumber = $this->generateRandomNationalNumber($phoneUtil, $country_code_string);
                    $phoneNumber->setNationalNumber($nationalNumber);

                    // Validate the phone number
                    if ($phoneUtil->isValidNumberForRegion($phoneNumber,$country_code_string)) {
                        $status = 'valid';
                    } else {
                        $status = 'invalid';
                    }

                    // Determine the type of the phone number
                    $numberType = $phoneUtil->getNumberType($phoneNumber);
                    $typeName = $this->getPhoneNumberTypeString($numberType);

                    // Format the phone number as international format
                    $formattedNumber = $phoneUtil->format($phoneNumber, PhoneNumberFormat::INTERNATIONAL);

                    // Add the formatted number and status to the list
                    $phoneNumbers[] = [
                        'phone_number' => $formattedNumber,
                        'status' => $status,
                        'country_code_string' => $country_code_string,
                        'country_code_number' => $country_code_number,
                        'phone_number_type' => $typeName,
                    ];


                    // Save to MongoDB only if the number is valid
                    if ($status == 'valid') {
                        $phoneNumbersModel->savePhoneNumber([
                            'phone_number' => $formattedNumber,
                            'status' => $status,
                            'country_code_string' => $country_code_string,
                            'country_code_number' => $country_code_number,
                            'phone_number_type' => $typeName,
                            'created_at' => date('d-m-Y H:i:s'),
                        ]);
                    }

                }

                // Return the generated phone numbers with status as JSON response
                return response()->json(['phoneNumbers' => $phoneNumbers], 200);
            } catch (NumberParseException $e) {
                // Handle any exceptions if necessary
                return response()->json(['error' => 'Error generating phone number'], 500);
            }

        }else {
            return response()->json(['county_code_error' => 'Sorry that country code is not supported by this app, try a different country'], 500);
        }
 

    }

    private function getPhoneNumberTypeString($numberType)
    {
        switch ($numberType) {
            case PhoneNumberType::FIXED_LINE:
                return 'fixed-line';
            case PhoneNumberType::MOBILE:
                return 'mobile';
            case PhoneNumberType::FIXED_LINE_OR_MOBILE:
                return 'fixed-line or mobile';
            case PhoneNumberType::TOLL_FREE:
                return 'toll-free';
            case PhoneNumberType::PREMIUM_RATE:
                return 'premium rate';
            case PhoneNumberType::SHARED_COST:
                return 'shared cost';
            case PhoneNumberType::VOIP:
                return 'VoIP';
            case PhoneNumberType::PERSONAL_NUMBER:
                return 'personal number';
            case PhoneNumberType::PAGER:
                return 'pager';
            case PhoneNumberType::UAN:
                return 'UAN';
            case PhoneNumberType::VOICEMAIL:
                return 'voicemail';
            case PhoneNumberType::UNKNOWN:
            default:
                return 'unknown';
        }
    }    

    private function generateRandomNationalNumber($phoneUtil, $country_code_string)
    {
            // Generate a PhoneNumber object for the country code
            try {
                // Get an example phone number for the given country code
                $exampleNumber = $phoneUtil->getExampleNumber($country_code_string);

                // Get the length of the national destination code for the example number
                $nationalDestinationLength = $phoneUtil->getLengthOfNationalDestinationCode($exampleNumber);

                // Ensure minimum length of national number
                $minDigits = max(8, $nationalDestinationLength); // Ensure at least 8 digits (adjust as needed)

                // Generate a random number within the valid range for national numbers
                $nationalNumber = '';
                $numberLength = rand($minDigits, $nationalDestinationLength + 9); // Adjust range as needed

                for ($i = 0; $i < $numberLength; $i++) {
                    $nationalNumber .= rand(0, 9); // Append random digit
                }

                return $nationalNumber;
            } catch (\libphonenumber\NumberParseException $e) {
                // Handle exception if necessary
                return ''; // Return empty string or handle error case
            }

    }

    public function getAllNumbers(Request $request)
    {
        try {
            $phoneNumberModel = new PhoneNumbers();
            $numbers = $phoneNumberModel->getAll();

            // Transform the MongoDB cursor to an array for JSON response
            $formattedNumbers = [];
            foreach ($numbers as $number) {
                $formattedNumbers[] = $number;
            }

            return response()->json($formattedNumbers);
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            return response()->json(['error' => 'MongoDB Error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch numbers'], 500);
        }

    }

    public function confirmDeleteNumber(Request $request, $mongoDBID)
    {
  
        try {

            $phoneNumbersModel = new PhoneNumbers();

            // Convert $mongoDBID from string to MongoDB\BSON\ObjectId
            $id = new \MongoDB\BSON\ObjectId($mongoDBID);

            // Delete the phone number from MongoDB
            $result = $phoneNumbersModel->deletePhoneNumber($id);

            // Check if deletion was successful
            if ($result) {
                return response()->json(['success' => 'Phone number deleted successfully']);
            } else {
                return response()->json(['error' => 'Failed to delete phone number'], 500);
            }
        } catch (\MongoDB\Driver\Exception\Exception $e) {
            return response()->json(['error' => 'MongoDB Error: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete phone number: ' . $e->getMessage()], 500);
        }

    }

}