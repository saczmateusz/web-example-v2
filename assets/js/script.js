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
      loadLocalStorage();
      loadListOfCitiesInDatabase();
    }
  };
  xobj.send(null);
}

function loadListOfCitiesInDatabase() {
  database.map(element => {
    var option = document.createElement('option');
    option.value = element.name;
    document.getElementById('listcities').appendChild(option);
  });
}

function loadLocalStorage() {
  if (localStorage.getItem('cities')) {
    cities = JSON.parse(localStorage.getItem('cities'));

    cities.map(city => {
      updateWeather(city.name);
      addNewCityToList(city);
    });

    document.querySelector('.message').innerHTML = 'Dodane miasta:';
  }
  return cities;
}

function updateWeather(cityname) {
  var city = database.find(element => element.name === cityname);
  updateCitiesData(city);
}

function updateCitiesData(city) {
  var index = cities.findIndex(element => element.name === city.name);
  cities[index].temperature = city.temperature;
  cities[index].humidity = city.humidity;
  cities[index].wind = city.speed;
  cities[index].description = city.description;
  cities[index].icon = city.icon;

  localStorage.setItem('cities', JSON.stringify(cities));
}

function getWeather(cityname) {
  var city = database.find(element => element.name === cityname);
  addToLocalStorage(city);
}

form.addEventListener('submit', event => {
  event.preventDefault();
  var city = form.elements['city'].value;

  if (city !== '') {
    loading.style.display = 'flex';
    getWeather(city);
  } else alert('Formularz nie może być pusty');

  form.elements['city'].value = '';
});

function addNewCityToList(data) {
  var template = document.getElementById('template').cloneNode('true');
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
