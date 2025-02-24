<div>
    <div class="header-container">
        <div class="header">لَا إِلٰهَ إِلَّا اللهُ مُحَمَّدٌ رَسُولُ اللهِ</div>
    </div>

    <div class="time-display" wire:poll.1s="updateTime">{{ $currentTime }}</div>

    <div class="prayer-times">
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

        <div class="section">
            <h2 style="text-align:center; margin-bottom: 10px; color: #ddf909;">🕌 Ramzan Clock 🕰️</h2>
            <div class="prayer-item prayer-item-heading">
                <span>Date</span> <span>Sehri</span> <span>Iftar</span>
            </div>
            @foreach ($ramadanTimes as $index => $day)
                <div class="prayer-item" style="{{ $index == 0 ? 'background-color: #ddf909; color: black; font-weight: bold;' : '' }}">
                    <span>
                        {{ $day['date'] }} 
                        @if($index == 0) <span style="color: red;">(Today)</span> @endif
                    </span>
                    <span>{{ $day['sehri'] }}</span>
                    <span>{{ $day['iftar'] ?? '--:--' }}</span> <!-- Ensure Iftar is displayed -->
                </div>
            @endforeach
        </div>
        
    </div>


    <div class="news-container">
        <marquee behavior="scroll" direction="left">
            @foreach ($newsUpdates as $news)
                <span>{{ $news }} | </span>
            @endforeach
        </marquee>
    </div>

    <div class="footer">
        <p>Ramadan Mubarak! May your prayers be accepted.</p>
    </div>
</div>
