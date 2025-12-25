<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah user boleh melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi: Kita ganti 'email' menjadi 'username'.
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'], // Ganti dari email ke username
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Mencoba melakukan autentikasi.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Laravel akan mengecek kolom 'username' di database
        if (! Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Memastikan tidak ada terlalu banyak percobaan login (spam).
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('username')).'|'.$this->ip());
    }
}