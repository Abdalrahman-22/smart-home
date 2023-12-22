<!DOCTYPE html>
<html lang="en">

<head>
  <title>RGB page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <style>
    /* Custom CSS for centering content */
    html,
    body {
      height: 100%;
    }

    body {
      background: linear-gradient(120deg, #2980b9, #8e44ad);
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      color: white;
    }

    .btn-container {
      text-align: center;
      border-radius: 50%;
    }

    .btn {
      border-radius: 50%;
    }

    .action-container {
      background: linear-gradient(120deg, #2980b9, #8e44ad);
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      transition: background 0.3s, box-shadow 0.3s;
      padding: 10px;
      margin-top: 20px;
      text-align: center;
      position: absolute;
      padding: 20px;

      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;
      flex-direction: column;
      align-items: center;
      width: 80%;
      max-width: 250px;
    }
   
    #leddiv:hover,#rgbdiv:hover {
      background: linear-gradient(120deg, #3498db, #9b59b6);
      /* Slightly different gradient on hover */
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
      /* Shadow becomes slightly more prominent on hover */
    }


    #leddiv,#rgbdiv {
      text-align: center;
      /* Optional: Center the content horizontally */
    }

    #left-container,
    #middle-container,
    #right-container {
      width: 100%;
      text-align: center;
      margin-bottom: 20px;
    }

    #left-container,
    #right-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #seconds,
    #colorInput {
      width: 80%;
      margin-bottom: 10px;
    }

    .btn-close {
      position: absolute;
      top: 20px;
      right: 5px;
      cursor: pointer;
      color: white;
    }

    .return-button {
      position: absolute;
      top: 20px;
      left: 5px;
      cursor: pointer;
    }

    #middle-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    #middle-container button {
      display: block;
      margin-bottom: 10px;
    }

    #rgbtimerbutton {
      width: 80%;
      border-radius: 0;
    }

    .rgb-box {
      background-color: #3498db;
      /* Set your desired color */
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 10px;
      color: white;
      width: 100%;
      position: relative;
    }


    #myButtonled {
      border-radius: 50%;

    }
  </style>
</head>

<body>
  <div class="container">
    <div class="btn-container">
      <h1 class="mt-5">RGB LED Control</h1>
      <button id="myButton" onclick="toggle()" ontouchstart="startTimer('#actionContainer')" ontouchend="endTimer()"
        onmousedown="startTimer('#actionContainer')" onmouseup="endTimer()" class="btn btn-lg btn-danger mt-3">Off</button>

        <h1 class="mt-5">LED</h1>
        <button id="myButtonled" ontouchstart="startTimer('#ledContainer')" ontouchend="endTimer()" onmousedown="startTimer('#ledContainer')"
          onmouseup="endTimer()" class=" btn-lg btn-danger mt-3">Off</button>
    </div>

    <div class="action-container" id="actionContainer">
      <div class="rgb-box">
        <button type="button" class="btn-close" aria-label="Close" onclick="$('#actionContainer').toggle();">
        </button>
        <h3 class="modal-title" for='colorInput'>RGB Light</h3>
        <span class="return-button" onclick="undo()">&#9100</span>

      </div>
      <div id="rgbdiv" class="modal-body text-center">

        <!-- Right Container: Color input and Set Color button -->
        <div id="right-container">
          <label for='colorInput'>Choose color:</label>
          <input type='color' id='colorInput'>
          <button onclick="setColor()" class='btn btn-warning mt-3'>Set Color</button>
        </div>

        <!-- Middle Container: Buttons -->
        <div id="middle-container">
          <label id="brightlabel" for="control">Control:</label>
          <button onclick="buttonClick('button1')" class='btn btn-info'>&#8593</button>
          <button onclick="buttonClick('button2')" class='btn btn-info'>&#8595</button>
        </div>

        <!-- Left Container: Input and Perform Action button -->
        <div id="left-container">
          <label for='seconds' id="timerlabel">set a timer</label>
          <input type='number' class='form-control' id='seconds' min='0' oninput="validity.valid||(value='');">
          <button onclick="setTimer()" id="rgbtimerbutton" class='btn btn-warning mt-3'>Set</button>
        </div>
      </div>
    </div>
  </div>

  <div class="container">

  </div>

  <div class="action-container " id="ledContainer">
    <div class="btn-container">
      <button type="button" class="btn-close" aria-label="Close" onclick="$('#ledContainer').toggle();">
      </button>
      <h3 class="modal-title" for='colorInput'>lED Light</h3>
    </div>
    <div id="leddiv" class="modal-body text-center">
      <div>
        <labelid="timerlabel">set a timer</label>
          <input type='number' class='form-control' min='0' oninput="validity.valid||(value='');">
          <button class='btn btn-warning mt-3'>Set</button>
      </div>
    </div>

    <script>
      var clickTimer;

      function startTimer(itemID) {
        clickTimer = setTimeout(function () {
          $(itemID).toggle();
        }, 1000);
      }

      function endTimer() {
        clearTimeout(clickTimer);
      }

      function setTimer() {
        var secondsValue = document.getElementById('seconds').value;
        var colorValue = document.getElementById('colorInput').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/ledstate?rgbseconds=' + encodeURIComponent(secondsValue), true);
        xhr.send();
      }

      function toggle() {
        document.getElementById('seconds').value = -555;
        setTimer();
        document.getElementById('seconds').value = '';
      }

      function buttonClick(buttonName) {
        // Handle button click logic here
        var intensity = (buttonName == 'button1') ? "up" : "down";
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/ledstate?intensity=' + encodeURIComponent(intensity), true);
        xhr.send();
      }

      setInterval(function () { updateLEDState(); }, 300);

      function updateLEDState() {
        var button = document.getElementById("myButton");

        fetch('/ledstate')
          .then(response => response.json())
          .then(data => {
            console.log('Received data:', data);

            if (data.rgbstate == "On") {
              button.innerHTML = "Off";
              button.classList.remove("btn-success");
              button.classList.add("btn-danger");
            } else if (data.rgbstate == "Off") {
              button.innerHTML = "On";
              button.classList.remove("btn-danger");
              button.classList.add("btn-success");
            }

            var timerlabel = document.getElementById("timerlabel");
            var timetotoggle = data.secondsToTogglergb;
            var nextstate = (data.rgbstate == "Off") ? "On" : "Off";
            if (timetotoggle == -1) {
              timerlabel.innerHTML = "set a timer";
            }
            else {
              timerlabel.innerHTML = "Led will be " + nextstate + " after " + data.secondsToTogglergb + " seconds";
            }

            var intensity = data.brightness;
            document.getElementById("brightlabel").innerHTML = intensity;
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
      }

      function setColor() {
        var colorValue = document.getElementById('colorInput').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/ledstate?color=' + encodeURIComponent(colorValue), true);
        xhr.send();
      }

      function undo() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/ledstate?undo=' + "yes", true);
        xhr.send();
      }
    </script>

</body>

</html>