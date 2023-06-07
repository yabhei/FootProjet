// document.getElementById('search-form').addEventListener('submit', function (event) {
//     event.preventDefault(); // Prevent form submission

//     var formData = new FormData(event.target);
//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function () {
//         if (this.readyState === 4 && this.status === 200) {
//             var response = JSON.parse(this.responseText);
//             updatePlayerList(response.players);
//         }
//     };

//     request.open('POST', '/users/search', true); // Specify the search route
//     request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
//     request.send(formData);
// });

// function updatePlayerList(players) {
//     var playerList = document.getElementById('player-list');
//     var tbody = playerList.querySelector('tbody');
//     tbody.innerHTML = '';

//     players.forEach(function (player) {
//         var row = document.createElement('tr');
//         var firstNameCell = document.createElement('td');
//         firstNameCell.textContent = player.firstname;
//         var lastNameCell = document.createElement('td');
//         lastNameCell.textContent = player.lastname;
//         var ageCell = document.createElement('td');
//         ageCell.textContent = player.age;

//         row.appendChild(firstNameCell);
//         row.appendChild(lastNameCell);
//         row.appendChild(ageCell);

//         tbody.appendChild(row);
//     });
// }