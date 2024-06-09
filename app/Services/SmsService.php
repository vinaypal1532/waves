<?php

// app/Services/SmsService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    /**
     * Send SMS.
     *
     * @param string $username
     * @param string $password
     * @param string $route
     * @param string $senderId
     * @param string $phoneNumber
     * @param string $message
     * @return array
     */
    public function sendSms($phoneNumber, $message)
    {
        $apiUrl = 'http://173.45.76.227/send.aspx';
    
        $username = 'bookadspace';
        $password = 'Bookadspace1';
        $route = 'trans1'; 
        $senderId = 'ADSPAC';
    
        $parameters = [
            'username' => $username,
            'pass' => $password,
            'route' => $route,
            'senderid' => $senderId,
            'numbers' => $phoneNumber,
            'message' => $message,
        ];
    
        try {
         
            $response = Http::get($apiUrl, $parameters);  

            if ($response->successful()) {
               
                $responseData = explode('|', $response->body());
    
                $status = $responseData[0] ?? 0;
                $units = $responseData[1] ?? 0;
                $smsid = $responseData[2] ?? null;
    
                if ($status == 1) {
                    return [
                        'status' => $status,
                        'units' => $units,
                        'smsid' => $smsid,
                        'message' => 'SMS sent successfully',
                    ];
                } else {
                    return [
                        'status' => $status,
                        'message' => 'Failed to send SMS',
                        'error_details' => $this->getErrorMessage($status),
                    ];
                }
            } else {
              
                return [
                    'status' => $response->status(),
                    'message' => 'Failed to send SMS',
                    'error_details' => 'Non-successful response received: ' . $response->body(),
                ];
            }
        } catch (\Exception $e) {
           
            return [
                'status' => 4, // Error status code
                'message' => 'Failed to send SMS',
                'error_details' => $e->getMessage(),
            ];
        }
    }
    
    private function getErrorMessage($statusCode)
    {
   
        $errorMessages = [
            2 => 'Invalid Credentials',
            3 => 'Insufficient Balance',
            4 => 'Error',
            5 => 'Invalid senderid',
            6 => 'Invalid route',
            7 => 'Submission Error',
        ];
    
        return $errorMessages[$statusCode] ?? 'Unknown error';
    }
    

    public function checkBalance()
    {
        $apiUrl = 'http://173.45.76.227/balance.aspx';
    
        $username = 'bookadspace';
        $password = 'Bookadspace1';
    
        $parameters = [
            'username' => $username,
            'pass' => $password,
        ];
    
        try {
            $response = Http::get($apiUrl, $parameters);
            $responseData = explode('|', $response->body());
    
            $status = $responseData[0] ?? 0;
    
            if ($status == 1) {
                $balance = $responseData[1] ?? 0;
                return [
                    'status' => $status,
                    'balance' => $balance,
                ];
            } else {
                return [
                    'status' => $status,
                ];
            }
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    
    
}
