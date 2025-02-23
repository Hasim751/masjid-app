function updateTime() {
    let now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let ampm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12 || 12; // Convert to 12-hour format
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    document.getElementById("currentTime").innerText = `${hours}:${minutes}:${seconds} ${ampm}`;
}

// Run updateTime() every second
setInterval(updateTime, 1000);
updateTime();
