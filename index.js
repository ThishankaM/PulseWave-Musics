const audioPlayer = document.getElementById('audio-player');
audioPlayer.addEventListener('loadedmetadata', () => {
    updateTimeline();
});
const playBtn = document.getElementById('play-btn');
const pauseBtn = document.getElementById('pause-btn');
const stopBtn = document.getElementById('stop-btn');
const tracksContainer = document.getElementById('tracks-container');
const albumArt = document.getElementById('album-art'); // Album art element

let musicList = []; // Initialize an empty music list
let currentTrackIndex = 0; // Track the currently playing track

// Fetch music data from PHP backend
fetch('fetch_music.php')
    .then(response => response.json())
    .then(data => {
        musicList = data; // Store the music list
        displayTracks();
    })
    .catch(error => console.error('Error fetching music:', error));
    // Function to update album art
    function updateAlbumArt(track) {
        albumArt.src = track.album_art;
    }

    // Update album art when a new track is loaded
    audioPlayer.addEventListener('loadedmetadata', () => {
        const currentTrack = musicList[currentTrackIndex];
        updateAlbumArt(currentTrack);
    });
// Function to display tracks
function displayTracks() {
    tracksContainer.innerHTML = ''; // Clear existing tracks

    musicList.forEach((track, index) => {
        const trackElement = document.createElement('div');
        trackElement.classList.add('track');
        trackElement.textContent = `${track.title} - ${track.artist}`;
        trackElement.dataset.index = index;

        // Add click event to play the selected track
        trackElement.addEventListener('click', () => {
            currentTrackIndex = index;
            playTrack(track);
        });

        // Append the track element to the container
        tracksContainer.appendChild(trackElement);
    });
}

// Function to play a track
function playTrack(track) {
    audioPlayer.src = track.file_path;
    audioPlayer.play();
    updateAlbumArt(track);
}

// Play button event
playBtn.addEventListener('click', () => {
    if (audioPlayer.src) {
        audioPlayer.play();
    }
});

// Pause button event
pauseBtn.addEventListener('click', () => {
    audioPlayer.pause();
});

// Stop button event
stopBtn.addEventListener('click', () => {
    audioPlayer.pause();
    audioPlayer.currentTime = 0;
});

document.addEventListener('DOMContentLoaded', function() {
    const nextBtn = document.getElementById('nextBtn');
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (musicList.length > 0) {
                currentTrackIndex = (currentTrackIndex + 1) % musicList.length; // Loop back to first track
                const nextTrack = musicList[currentTrackIndex];
                audioPlayer.src = nextTrack.file_path;
                audioPlayer.play();
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const prevBtn = document.getElementById('previousBtn');
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (musicList.length > 0) {
                currentTrackIndex = (currentTrackIndex - 1 + musicList.length) % musicList.length; // Loop back to last track
                const prevTrack = musicList[currentTrackIndex];
                audioPlayer.src = prevTrack.file_path;
                audioPlayer.play();
            }
        });
    }
});
// Function to update the timeline
function updateTimeline() {
    const timeline = document.getElementById('timeline');
    const progress = document.getElementById('progress');
    const currentTime = document.getElementById('current-time');
    const duration = document.getElementById('duration');

    audioPlayer.addEventListener('timeupdate', () => {
        const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
        progress.style.width = `${percent}%`;
        currentTime.textContent = formatTime(audioPlayer.currentTime);
    });

    audioPlayer.addEventListener('loadedmetadata', () => {
        duration.textContent = formatTime(audioPlayer.duration);
    });

    timeline.addEventListener('click', (e) => {
        const timelineWidth = timeline.offsetWidth;
        const clickPosition = e.offsetX;
        const clickTime = (clickPosition / timelineWidth) * audioPlayer.duration;
        audioPlayer.currentTime = clickTime;
    });
}
// Function to format time in mm:ss
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
}
// Initialize the timeline
document.addEventListener('DOMContentLoaded', () => {
    updateTimeline();
});
const timeline = document.getElementById('timeline');

audioPlayer.addEventListener('timeupdate', () => {
    const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    timeline.value = progress;
});

timeline.addEventListener('input', () => {
    const seekTime = (timeline.value / 100) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
});

