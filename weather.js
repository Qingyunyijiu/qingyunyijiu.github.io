// Get reference to the city and weather elements
const cityElement = document.getElementById('city-name');
const weatherElement = document.getElementById('weather');

// Define function to update weather and city information
function updateWeatherAndCity() {
  // Retrieve user's location using Geolocation API
  navigator.geolocation.getCurrentPosition(position => {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    // Make API call to retrieve weather data based on location
    fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&lang=zh_cn&appid=090c5388548f2c702fce061e3c53b7ef`) //请将 API_KEY 替换为您的 OpenWeatherMap API 密钥
      .then(response => response.json())
      .then(data => {
        // Get relevant weather data from API response
        const temperature = data.main.temp;
        const weatherDescription = data.weather[0].description;
        const cityName = data.name;

        // Update city and weather information in HTML
        //cityElement.innerHTML = cityName;
        weatherElement.innerHTML = `${cityName}，${weatherDescription} ，${temperature}&deg;C`;
      });
  });
}

// Call updateWeatherAndCity function initially to update weather and city information
updateWeatherAndCity();

// Get reference to update button
const updateButton = document.getElementById('update-button');

// Add event listener to update button to update weather and city information when clicked
updateButton.addEventListener('click', () => {
  updateWeatherAndCity();
});