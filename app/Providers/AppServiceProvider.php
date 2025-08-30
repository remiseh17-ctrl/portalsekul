<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register helper functions for date formatting
        $this->registerDateHelpers();
    }

    /**
     * Register date helper functions
     */
    private function registerDateHelpers(): void
    {
        // Helper function untuk format tanggal yang aman
        if (!function_exists('safeDateFormat')) {
            function safeDateFormat($date, $format = 'Y-m-d') {
                if (!$date) {
                    return '';
                }
                
                try {
                    // Jika sudah string dan format Y-m-d, return langsung
                    if (is_string($date) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
                        return $date;
                    }
                    
                    // Jika string dengan format lain, coba parse
                    if (is_string($date)) {
                        $parsedDate = Carbon::parse($date);
                        return $parsedDate->format($format);
                    }
                    
                    // Jika date object, format langsung
                    if (is_object($date) && method_exists($date, 'format')) {
                        return $date->format($format);
                    }
                } catch (\Exception $e) {
                    return '';
                }
                
                return '';
            }
        }

        // Helper function untuk input date
        if (!function_exists('formatDateForInput')) {
            function formatDateForInput($date) {
                return safeDateFormat($date, 'Y-m-d');
            }
        }

        // Helper function untuk mengecek apakah field adalah date object
        if (!function_exists('isDateObject')) {
            function isDateObject($field) {
                return is_object($field) && method_exists($field, 'format');
            }
        }
    }
}
