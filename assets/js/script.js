const proxy = 'https://cors-anywhere.herokuapp.com/';
const GEO_API_URL = `${proxy}https://darksky.net/geo?q=`;
const WEATHER_API_URL = `${proxy}api.openweathermap.org/data/2.5/weather?units=metric&lang=pl&APPID=5411260f763f2122d29f0fcc8397bbf1`;
const WEATHER_GROUP_API_URL = `${proxy}api.openweathermap.org/data/2.5/group?units=metric&lang=pl&APPID=5411260f763f2122d29f0fcc8397bbf1`;

let cities = [];
let database = [];
const form = document.querySelector('form');
const loading = document.querySelector('.loading');

window.onload = initialize;

function initialize() {
  var xobj = new XMLHttpRequest();
  xobj.open('GET', './cities/cities.json', true);
  xobj.onreadystatechange = function() {
    if (xobj.readyState == 4 && xobj.status == '200') {
      database = JSON.parse(xobj.responseText);
      console.log(database);
      loadLocalStorage();
    }
  };
  xobj.send(null);
}

// function loadLocalStorage() {
//   if (localStorage.getItem('cities')) {
//     cities = JSON.parse(localStorage.getItem('cities'));
//     const idList = cities
//       .reduce((id, city) => (id = `${id},${city.id}`), '')
//       .slice(1);
//     loadWeatherForLocalStorage(idList)
//       .then(updateCitiesData)
//       .then(response =>
//         response.map(city => {
//           addNewCityToList(city);
//         }),
//       );

//     document.querySelector('.message').innerHTML = 'Dodane miasta:';
//   }
// }

function loadLocalStorage() {
  if (localStorage.getItem('cities')) {
    cities = JSON.parse(localStorage.getItem('cities'));

    // loadWeatherForLocalStorage()
    //   .then(updateCitiesData)
    //   .then(response =>
    //     response.map(city => {
    //       addNewCityToList(city);
    //     }),
    //   );
    cities.map(city => {
      updateWeather(city.name);
      console.log('update -> addnew');
      addNewCityToList(city);
    });

    // cities.map(city => addNewCityToList(city));
    document.querySelector('.message').innerHTML = 'Dodane miasta:';
  }
  return cities;
}

function loadWeatherForLocalStorage(idList) {
  return getWeatherGroupOfIds(idList);
}

function updateWeather(cityname) {
  var city = database.find(element => element.name === cityname);
  console.log(cityname);
  console.log(city);
  updateCitiesData(city);
}

function updateCitiesData(city) {
  var index = cities.findIndex(element => element.name === city.name);
  console.log('update');
  cities[index].temperature = city.temperature;
  cities[index].humidity = city.humidity;
  cities[index].wind = city.speed;
  cities[index].description = city.description;
  cities[index].icon = city.icon;

  localStorage.setItem('cities', JSON.stringify(cities));
  // return cities;
}

// Get coordinates for argument city
// function getCoordinates(location) {
//   return fetch(`${GEO_API_URL}${location}`).then(response => response.json());
// }

// Get current weather data for argument coordinates
// function getWeather(lat, lng) {
//   return fetch(`${WEATHER_API_URL}&lat=${lat}&lon=${lng}`).then(response =>
//     response.json(),
//   );
// }

// Get current weather data for argument coordinates
function getWeather(cityname) {
  var city = database.find(element => element.name === cityname);
  console.log(cityname);
  console.log(city);
  addToLocalStorage(city);
  // addNewCityToList(city);
  // return city;
  // return fetch(`${WEATHER_API_URL}&lat=${lat}&lon=${lng}`).then(response =>
  //   response.json(),
  // );
}

// Update weather for saved cities after page reload
function getWeatherGroupOfIds(id) {
  return fetch(`${WEATHER_GROUP_API_URL}&id=${id}`).then(response =>
    response.json(),
  );
}

/* old version for web-example-v1
form.addEventListener('submit', event => {
  // Prevent default submitting with page reload
  event.preventDefault();

  // Retrieve form input data
  var city = form.elements['city'].value;

  // If given city is not an empty string, get data for the closest station
  if (city !== '') {
    loading.style.display = 'flex';
    getCoordinates(city).then(response => {
      getWeather(response.latitude, response.longitude).then(addToLocalStorage);
    });
  } else alert('Formularz nie może być pusty');

  // Clear form input
  form.elements['city'].value = '';
});
*/

form.addEventListener('submit', event => {
  // Prevent default submitting with page reload
  event.preventDefault();

  // Retrieve form input data
  var city = form.elements['city'].value;

  // If given city is not an empty string, get data for the closest station
  if (city !== '') {
    loading.style.display = 'flex';
    getWeather(city);
  } else alert('Formularz nie może być pusty');

  // Clear form input
  form.elements['city'].value = '';
});

// Generate panel with weather data and add it to html body
function addNewCityToList(data) {
  var template = document.getElementById('template').cloneNode('true');
  console.log('draw panel');
  template.id = data.id;
  template.querySelector('.cityid').id = data.id;
  template.querySelector('.city').innerHTML = data.name;
  template.querySelector('.temperature').innerHTML = data.temperature;
  template.querySelector('.humidity').innerHTML = data.humidity;
  template.querySelector('.wind').innerHTML = data.wind;
  template.querySelector('.description').innerHTML = data.description;
  template.querySelector(
    '.icon',
  ).src = `http://openweathermap.org/img/wn/${data.icon}@2x.png`;

  document.getElementById('panels').appendChild(template);
  loading.style.display = 'none';
}

function addToLocalStorage(data) {
  console.log('add to local storage function');
  var city = {
    id: data.id,
    name: data.name,
    temperature: data.temperature,
    humidity: data.humidity,
    wind: data.wind,
    description: data.description,
    icon: data.icon,
  };
  if (cities.length === 0) {
    document.querySelector('.message').innerHTML = 'Dodane miasta:';
  }
  if (cities.findIndex(element => element.name === city.name) === -1) {
    cities = [...cities, city];
    localStorage.setItem('cities', JSON.stringify(cities));
    addNewCityToList(city);
  } else {
    loading.style.display = 'none';
    alert('To miasto znajduje się już na Twojej liście');
  }
}

function clearLocalStorage() {
  localStorage.clear();
  cities = [];
  const panels = document.getElementById('panels');
  panels.innerHTML = '';
  document.querySelector('.message').innerHTML = 'Dodaj miasta do swojej listy';
}

function deleteCity(res) {
  document.getElementById(res.id).remove();
  cities = cities.filter(city => city.id != res.id);
  localStorage.setItem('cities', JSON.stringify(cities));
  if (cities.length === 0) {
    document.querySelector('.message').innerHTML =
      'Dodaj miasta do swojej listy';
    localStorage.clear();
  }
}
