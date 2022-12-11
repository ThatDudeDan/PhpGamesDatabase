let mode;

window.onload = function () {
    document.querySelector("#getGames").addEventListener("click", getAllItems);
    document.querySelector("#addGame").addEventListener("click", getAddItems);
    document.querySelector("#updateGame").addEventListener("click", getUpdateItems);
    document.querySelector("#formDone").addEventListener("click", addAndUpdate);
    document.querySelector('#cancelAU').addEventListener("click", hidePanel);
    document.querySelector('#deleteGame').addEventListener("click", deleteGame);

    document.querySelector('table').addEventListener("click", selectRow);

    hidePanel();
};

function deleteGame() {
    let cells = document.querySelectorAll(".selected td");
    let id = cells[0].innerHTML;

    let url = "GameService/games/" + id;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let resp = xmlhttp.responseText;
            if (resp === "1") {
                getAllItems();
            } else {
                alert("ERROR: Error in the Game Delete");
            }

        }
    };
    xmlhttp.open("DELETE", url, true);
    xmlhttp.send();
}

function getUpdateItems() {
    mode = "update";
    document.querySelector("#gameIdInput").setAttribute('readonly', true);
    showPanel();
}

function selectRow(e) {
    clearRows();
    if (e.target.tagName === "TH") {
        alert("Cannot select headers");
    } else {
        e.target.parentElement.classList.add("selected");
        document.querySelector("#gameIdInput").setAttribute('readonly', true);
        document.querySelector("#updateGame").removeAttribute("disabled");
        document.querySelector("#deleteGame").removeAttribute("disabled");
        if (mode !== "add") {
            fillInputs();
        }
    }


}

function clearRows() {
    let rows = document.querySelectorAll("tr");

    for (let i = 0; i < rows.length; i++) {
        rows[i].classList.remove("selected");
    }
}

function addAndUpdate() {
    hidePanel();

    let id = document.querySelector("#gameIdInput").value;
    let title = document.querySelector("#titleInput").value;
    let genre = document.querySelector("#genreInput").value;
    let company = document.querySelector("#companyInput").value;
    let release = document.querySelector("#releaseInput").value;
    let players = document.querySelector("#playersInput").value;

    let game = {
        gameID: id,
        title: title,
        genre: genre,
        company: company,
        release: release,
        players: players
    };

    let url = "GameService/games/" + id;
    let method = (mode === "add") ? "POST" : "PUT";
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let ret = xmlhttp.responseText;
            console.log(ret);
            if (ret === "1") {
                getAllItems();
            } else {
                alert("ERROR: Error in the " + (mode === "add" ? "Game Add" : "Game Update"));
            }

        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send(JSON.stringify(game));
}

function getAddItems() {
    mode = "add";
    document.querySelector("#gameIdInput").removeAttribute("readonly");
    showPanel();
}

function hidePanel() {
    document.querySelector("#addAndUpdate").classList.add("hidden");
}

function showPanel() {
    if (mode === "add") {
        document.querySelector("#gameIdInput").value = "";
        document.querySelector("#titleInput").value = "";
        document.querySelector("#companyInput").value = "";
        document.querySelector("#genreInput").value = "";
        document.querySelector("#releaseInput").value = "";
        document.querySelector("#playersInput").value = "";
        document.querySelector("#addAndUpdate").classList.remove("hidden");
    } else {
        fillInputs();
        document.querySelector("#addAndUpdate").classList.remove("hidden");
    }
}

function fillInputs() {
    let row = document.querySelector(".selected");
    let cells = row.querySelectorAll("td");

    document.querySelector("#gameIdInput").value = cells[0].innerHTML;
    document.querySelector("#titleInput").value = cells[1].innerHTML;
    document.querySelector("#genreInput").value = cells[2].innerHTML;
    document.querySelector("#companyInput").value = cells[3].innerHTML;
    document.querySelector("#releaseInput").value = cells[4].innerHTML;
    document.querySelector("#playersInput").value = cells[5].innerHTML;
}

function getAllItems() {
    hidePanel();
    document.querySelector("#updateGame").setAttribute("disabled", true);
    document.querySelector("#deleteGame").setAttribute("disabled", true);
    let url = "GameService/games";
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            let ret = xmlhttp.responseText;

            if (isJson(ret) === false) {
                alert("Error Getting Games");
                console.log(ret);
            } else {
                buildTable(ret);
            }

        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}


function isJson(check) {
    try {
        JSON.parse(check);
    } catch (e) {
        return false;
    }
    return true;
}

function buildTable(text) {
    let games = JSON.parse(text);
    let table = document.querySelector("#tableDisplay");
    let build = "<tr><th>Game ID</th><th>Title</th><th>Genre</th><th>Company</th><th>Release Date</th><th>Player Count</th></tr>";

    for (let i = 0; i < games.length; i++) {
        let game = games[i];

        build += "<tr>";
        build += "<td>" + game.gameID + "</td>";
        build += "<td>" + game.title + "</td>";
        build += "<td>" + game.genre + "</td>";
        build += "<td>" + game.company + "</td>";
        build += "<td>" + game.releaseDate + "</td>";
        build += "<td>" + game.playerNum + "</td>";
        build += "</tr>";
    }

    table.innerHTML = build;

}