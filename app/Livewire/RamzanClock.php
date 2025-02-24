<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use IslamicNetwork\PrayerTimes\PrayerTimes;
use Illuminate\Support\Facades\Log;

class RamzanClock extends Component
{
    public $currentTime;
    public $prayerTimes = [];
    public $ramadanTimes = [];
    public $newsUpdates = [];

    public function mount()
    {
        $this->updateTime();
        $this->fetchPrayerTimes();
        $this->fetchRamadanTimes();
        $this->fetchNewsUpdates();
    }

    public function updateTime()
    {
        $this->currentTime = Carbon::now('America/Regina')->format('h:i:s A');
    }

    public function fetchPrayerTimes()
    {
        $latitude = 50.4733; // Regina
        $longitude = -104.6331;
        $timezone = -6; // GMT Offset for Regina
        $method = 'ISNA'; // Islamic Society of North America

        $pt = new PrayerTimes($method);
        $times = $pt->getTimesForToday($latitude, $longitude, $timezone);

        if (!$times) {
            Log::error('Failed to retrieve prayer times.');
            return;
        }

        $this->prayerTimes = [
            'Fajr' => ['Azan' => $this->convertTo12Hour($times['Fajr'] ?? ''), 'Jamath' => $this->addMinutes($times['Fajr'] ?? '', 20)],
            'Zuhr' => ['Azan' => $this->convertTo12Hour($times['Dhuhr'] ?? ''), 'Jamath' => $this->addMinutes($times['Dhuhr'] ?? '', 15)],
            'Asr' => ['Azan' => $this->convertTo12Hour($times['Asr'] ?? ''), 'Jamath' => $this->addMinutes($times['Asr'] ?? '', 15)],
            'Maghrib' => ['Azan' => $this->convertTo12Hour($times['Maghrib'] ?? ''), 'Jamath' => $this->addMinutes($times['Maghrib'] ?? '', 3)],
            'Isha' => ['Azan' => $this->convertTo12Hour($times['Isha'] ?? ''), 'Jamath' => $this->addMinutes($times['Isha'] ?? '', 15)],
            'Jumah' => ['Time' => '1:30 PM'],
            'Tulu' => ['Time' => $this->convertTo12Hour($times['Sunrise'] ?? '')],
            'Zawal' => ['Time' => $this->addMinutes($times['Dhuhr'] ?? '', -10)],
            'Saher' => ['Time' => $this->addMinutes($times['Fajr'] ?? '', -10)],
            'Iftar' => ['Time' => $this->convertTo12Hour($times['Maghrib'] ?? '')],
        ];
    }

    public function fetchRamadanTimes()
{
    $latitude = 50.4733;
    $longitude = -104.6331;
    $timezone = -6;
    $method = 'ISNA';

    $pt = new PrayerTimes($method);
    $this->ramadanTimes = [];

    for ($i = 0; $i <= 4; $i++) {
        $date = Carbon::now('America/Regina')->addDays($i);
        $times = $pt->getTimes($date, $latitude, $longitude, $timezone);

        if (!$times || !isset($times['Fajr']) || !isset($times['Maghrib'])) {
            Log::error("Missing Sehri or Iftar time for: " . $date->format('Y-m-d'));
            $this->ramadanTimes[] = [
                'date' => $date->format('l, M d'),
                'sehri' => '--:--',
                'iftar' => '--:--',
            ];
            continue;
        }

        $this->ramadanTimes[] = [
            'date' => $date->format('l, M d'),
            'sehri' => $this->convertTo12Hour($times['Fajr'] ?? ''),
            'iftar' => $this->convertTo12Hour($times['Maghrib'] ?? ''), // Ensure Iftar is fetched
        ];
    }
}


    public function fetchNewsUpdates()
    {
        $this->newsUpdates = [
            "🔴 Eid prayer timing announced: 7:00 AM.",
            "🕌 Mosque renovation project progressing well.",
            "📢 Community Iftar scheduled this Friday.",
            "📖 Join our weekly Quran study circle after Maghrib.",
            "💡 Ramadan charity drive - donate now!"
        ];
    }

    private function convertTo12Hour($time24)
    {
        if (empty($time24)) {
            return '--:--';
        }

        try {
            $time = Carbon::createFromFormat('H:i', $time24);
            return $time->format('g:i A');
        } catch (\Exception $e) {
            Log::error("Invalid time format: $time24");
            return '--:--';
        }
    }

    private function addMinutes($time, $minutesToAdd)
    {
        if (empty($time)) {
            return '--:--';
        }

        try {
            $time = Carbon::createFromFormat('H:i', $time);
            return $time->addMinutes($minutesToAdd)->format('g:i A');
        } catch (\Exception $e) {
            return '--:--';
        }
    }

    public function render()
    {
        return view('livewire.ramzan-clock');
    }
}
