<?php

namespace App\Rules;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $endpoint = config('services.recaptcha');

        $response = Http::asForm()->post($endpoint['url'], [
            'secret' => $endpoint['secret_key'],
            'response' => $value,
            'ip' => request()->ip(),
        ]);

        if ($response->successful() && $response->json('success') && $response->json('score') > $endpoint['min_score']) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'Something goes wrong. Please contact us directly through the phone or email.';
    }
}
