<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use IslamicNetwork\PrayerTimes\PrayerTimes;

class Clock extends Component
{
    public $currentTime;
    public $prayerTimes = [];

    public function mount()
    {
        $this->updateTime();
        $this->fetchPrayerTimes();
    }

    public function updateTime()
    {
        // Get current time in Regina timezone
        $this->currentTime = Carbon::now('America/Regina')->format('h:i:s A');
    }

    public function fetchPrayerTimes()
    {
        $latitude = 50.4733; // Regina
        $longitude = -104.6331;
        $timezone = -6; // GMT Offset for Regina
        $method = 'ISNA'; // Islamic Society of North America

        // Instantiate PrayerTimes with ISNA method
        $pt = new PrayerTimes($method);

        // Get prayer times for today
        $times = $pt->getTimesForToday($latitude, $longitude, $timezone);

        // Store the times in an array with capitalized keys
        $this->prayerTimes = [
            'Fajr' => ['Azan' => $this->convertTo12Hour($times['Fajr']), 'Jamath' => $this->addMinutes($times['Fajr'], 20)],
            'Zuhr' => ['Azan' => $this->convertTo12Hour($times['Dhuhr']), 'Jamath' => $this->addMinutes($times['Dhuhr'], 15)],
            'Asr' => ['Azan' => $this->convertTo12Hour($times['Asr']), 'Jamath' => $this->addMinutes($times['Asr'], 15)],
            'Maghrib' => ['Azan' => $this->convertTo12Hour($times['Maghrib']), 'Jamath' => $this->addMinutes($times['Maghrib'], 3)],
            'Isha' => ['Azan' => $this->convertTo12Hour($times['Isha']), 'Jamath' => $this->addMinutes($times['Isha'], 15)],
            'Jumah' => ['Time' => '1:30 PM'], // Jumah usually has a fixed time
            'Tulu' => ['Time' => $this->convertTo12Hour($times['Sunrise'])],
            'Zawal' => ['Time' => $this->addMinutes($times['Dhuhr'], -10)],
            'Saher' => ['Time' => $this->addMinutes($times['Fajr'], -10)],
            'Iftar' => ['Time' => $this->convertTo12Hour($times['Maghrib'])],
        ];
    }

    private function convertTo12Hour($time24)
    {
        $time = Carbon::createFromFormat('H:i', $time24);
        return $time->format('g:i A');
    }

    private function addMinutes($time, $minutesToAdd)
    {
        $time = Carbon::createFromFormat('H:i', $time);
        return $time->addMinutes($minutesToAdd)->format('g:i A');
    }

    public function render()
    {
        return view('livewire.clock');
    }
}
