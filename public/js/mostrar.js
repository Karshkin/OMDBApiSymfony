$(document).ready(function(){
  // Create a request variable and assign a new XMLHttpRequest object to it.
  var request = new XMLHttpRequest();

  var api = "http://img.omdbapi.com/?apikey=6acd7a13&i="
  var id = "tt0408181"
  var url = api.concat(id);

  const app = document.getElementById('informacion');

  const logo = document.createElement('img');


  // Open a new connection, using the GET request on the URL endpoint
  request.open('GET', url, true);

  request.onload = function () {
    // Begin accessing JSON data here
    // Begin accessing JSON data here

        console.log(request);
        data = JSON.parse(request.response);

          if (request.status >= 200 && request.status < 400) {
            data.forEach(movie => {


                  // Create an h1 and set the text content to the film's title
                  const h1 = document.createElement('h1');
                  h1.textContent = movie.Title;

                  // Each card will contain an h1 and a p
                  card.appendChild(h1);
          });
        } else {
            console.log('error');
            }
    }

  // Send request
  request.send();
});
