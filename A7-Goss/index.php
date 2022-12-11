<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="mainCode.js"></script>
        <link rel="stylesheet" href="gameCRUDStyle.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        
    </head>
    <body>
        <h1>Games Database</h1>
        
        <div id="fullContainer">
            <div id="buttons">
                <div><button id="getGames">Get all Games</button></div>
                <button id="addGame">Add New Game</button>
                <button id="updateGame" disabled>Update a Game</button>
                <button id="deleteGame" disabled>Delete a Game</button>
            </div>

            <div id="addAndUpdate">
                <div>
                    <div><label>Game ID:</label></div><input type="text" id="gameIdInput">
                </div>
                <div>
                    <div><label>Title:</label></div><input type="text" id="titleInput">
                </div>
                <div>
                    <div><label>Genre:</label></div><input type="text" id="genreInput">
                </div>
                <div>
                    <div><label>Company:</label></div><input type="text" id="companyInput">
                </div>
                <div>
                    <div><label>Release Date:</label></div><input type="date" id="releaseInput">
                </div>
                <div>
                    <div><label>Player Number:</label></div><input type="number" id="playersInput">
                </div>
                <div>
                    <button id="formDone">Done</button>
                    <button id="cancelAU">Cancel</button>
                </div>
            </div>            
            
            <div id="tableCont">
                <table id="tableDisplay">
                    
                </table>
            </div>
        </div>
    </body>
</html>
