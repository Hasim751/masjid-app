<div>
    <!-- Scrolling Header -->
    <div class="header-container">
        <div class="header">لَا إِلٰهَ إِلَّا اللهُ مُحَمَّدٌ رَسُولُ اللهِ</div>
    </div>

    <!-- Time Display -->
    <div class="time-display" wire:poll.1s="updateTime">{{ $currentTime }}</div>

    <div class="prayer-times">
        <!-- Prayer Times -->
        <div class="section">
            <div class="prayer-item prayer-item-heading">
                <span>PRAYER</span> <span>AZAN</span> <span>JAMATH</span>
            </div>
            @foreach (['Fajr', 'Zuhr', 'Asr', 'Maghrib', 'Isha'] as $prayer)
                <div class="prayer-item">
                    <span>{{ $prayer }}</span> 
                    <span>{{ $prayerTimes[$prayer]['Azan'] ?? '--:--' }}</span>  
                    <span>{{ $prayerTimes[$prayer]['Jamath'] ?? '--:--' }}</span>
                </div>
            @endforeach
        </div>

        <!-- Events -->
        <div class="section">
            <div class="prayer-item prayer-item-heading">
                <span>EVENT</span> <span>TIME</span>
            </div>
            @foreach (['Jumah', 'Tulu', 'Zawal', 'Saher', 'Iftar'] as $event)
                <div class="prayer-item">
                    <span>{{ $event }}</span> 
                    <span>{{ $prayerTimes[$event]['Time'] ?? '--:--' }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Scrolling News & Updates -->
    <div class="news-container">
        <div class="news">
            🔴 Latest Update: Eid Prayer Timing Announced | 🔴 Mosque Construction Progressing Well | 🔴 Community Iftar Scheduled This Friday | 🔴 Join Our Weekly Quran Study Circle
        </div>
    </div>
</div>
