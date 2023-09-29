const data = {
    location: {
        coords: {
            latitude: 42.729670486377735,
            longitude: -73.6801994794444
        }
    }
};

const imageCache = {};

const projectEpoch = new Date(Date.UTC(2023, 8, 28, 12, 0, 0)) // All relative dates are relative to this date (September 28, 2023 at noon)

const secondsInDay = 60 * 60 * 24;

function getDaysBefore(numDays) {
    return new Date(projectEpoch.getMilliseconds() - secondsInDay * numDays);
}

function getLocationAsync() {
    return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(resolve, reject);
    });
}

async function getWeather() {
    const { latitude, longitude } = data.location.coords;
    const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=5659f7787e3ff5189250fc94782ab441&units=imperial`);
    const json = await response.json();
    return json;
}

function toTitleCase(str) {
    return str.replace(
      /\w\S*/g,
      function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
      }
    );
};

function hPaToInHg(hPa) {
    const base = hPa * 0.02953; // Formula for converting hectopascals (sent by OpenWeatherAPI) to inches of mercury
    return Math.round(base * 100) / 100; // Round to 2 decimal places
}

async function updateWeather() {
    const weather = await getWeather();
    console.log(weather)
    const { temp, humidity } = weather.main;
    const { icon, main, description } = weather.weather[0];
    
    document.getElementById('weather-icon').src = `http://openweathermap.org/img/wn/${icon}.png`;
}

async function main() {
    try {
        const position = await getLocationAsync();
        const { latitude, longitude } = position.coords;
        data.location.coords = { latitude, longitude };
    } catch {
        // Ignore
    }
    await updateWeather();
}

window.addEventListener('load', main);