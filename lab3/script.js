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

const millisecondsInDay = 60 * 60 * 24 * 1000;

function getDaysBefore(numDays) {
    return new Date(projectEpoch.getTime() - (millisecondsInDay * numDays));
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

function roundToFirstDecimal(num) {
    return Math.round(num * 10) / 10;
}

function setValue(id, value) {
    document.getElementById(id).textContent = value;
}

async function updateWeather() {
    const weather = await getWeather();
    // console.log(weather)
    const { temp, feels_like, temp_min, temp_max, humidity, pressure } = weather.main;
    const cloud_cover = weather.clouds.all;
    const { icon, main, description } = weather.weather[0];
    const location_name = weather.name;
    const wind_speed = weather.wind.speed;
    const current_temp = parseFloat(document.getElementById("current-weather-temp").textContent);

    document.getElementById('weather-icon').src = `http://openweathermap.org/img/wn/${icon}.png`;
    setValue("location", location_name);
    setValue("current-weather-temp", roundToFirstDecimal(temp));
    setValue("feels-like", roundToFirstDecimal(feels_like));
    setValue("high", roundToFirstDecimal(temp_max));
    setValue("low", roundToFirstDecimal(temp_min));
    setValue("wind", wind_speed);
    setValue("humidity", humidity);
    setValue("cloud-cover", cloud_cover);
    setValue("pressure", hPaToInHg(pressure));
    setValue("weather-description", toTitleCase(description));
    setValue("weather-type", toTitleCase(main));

    if(current_temp !== roundToFirstDecimal(temp)) {
        await updatePhoto(temp);
    }
}

function dateToYYYYMMDD(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Month is 0-indexed
    const day = String(date.getDate()).padStart(2, "0");
    return `${year}-${month}-${day}`;
}

async function getPhoto(temp) {
    const temp_normalized = Math.round(temp * 10); // Shift decimal place to the right by 1
    if (imageCache[temp_normalized]) {
        return imageCache[temp_normalized];
    }
    const response = await fetch(`https://api.nasa.gov/planetary/apod?api_key=MGKQc6PzBXyCQGvb4u3kZ8pfxdK9mWSYENSWxthw&date=${dateToYYYYMMDD(getDaysBefore(temp_normalized))}`);
    const json = await response.json();
    if (json.url.startsWith("https://apod.nasa.gov/apod/image/")) {
        imageCache[temp_normalized] = json.url;
        return json.url;
    } else {
        const actual_photo = await getPhoto(temp_normalized - 0.1);
        imageCache[temp_normalized] = actual_photo;
        return actual_photo;
    }
}

async function updatePhoto(temp) {
    const url = await getPhoto(temp);
    document.querySelector('body').style.backgroundImage = `url('${url}')`;
}

async function main() {
    const initial = updateWeather(); // Update weather immediately, we can wait for coordinates later and re-update
    try {
        const position = await getLocationAsync();
        const { latitude, longitude } = position.coords;
        data.location.coords = { latitude, longitude };
        await updateWeather();
    } catch {
        // Ignore
    }
    await initial; // For error handling
    setInterval(updateWeather, 5 * 60 * 1000);
    
}

window.addEventListener('load', main);