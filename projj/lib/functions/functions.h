void wificonnection()
{ // it tries to connected to wifi for 6 seconds after this it will contiune wihtout connection
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  if (WiFi.status() != WL_CONNECTED)
  {
    delay(3000);
  }
  if (WiFi.status() != WL_CONNECTED)
  {
    Serial.println("Connecting to WiFi...");
    delay(3000);
  }
  if (WiFi.status() == WL_CONNECTED)
  {
    Serial.println("Connected to WiFi");

    Serial.print("ESP32 IP address: ");
    Serial.println(WiFi.localIP());
  }
  else
  {
    Serial.print("we will continue without connection");
  }
}

void checkWifi() // checks wifi connection every 3 seconds and shows the condition on wifiLed
{
  if (millis() - wifiLed.getPrevious() >= 3000UL) // this uses the previous differently it uses it to repeat
  {                                               // with constant period. (it doesn't have a button, so this is fine)
    if (WiFi.status() == WL_CONNECTED)
    {
      wifiLed.on();
    }
    else
    {
      wifiLed.off();
    }

    // Serial.println(WiFi.status());

    wifiLed.setPrevious(millis());
  }
}

void toggleled() // works when the led's pushbutton is pressed
{
  room1.excLedPushbutton();
}

void togglergb() // works when the rgb's pushbutton is pressed
{
  room1.excRgbPushbutton();
}

void control_room1()
{

  JSONVar myObject = JSON.parse(payload);

  if (JSON.typeof(myObject) == "undefined")
  {
    return;
  }

  if (strcmp(myObject["LED"], "ON") == 0 && room1.getLed().isOn() == false) // control led on
  {
    room1.excLedOn();
  }
  if (strcmp(myObject["LED"], "OFF") == 0 && room1.getLed().isOn() == true) // control led off
  {
    room1.excLedOff();
  }

  if (strcmp(myObject["timer_flag"], "1") == 0) // control led timer
  {
    String sec = myObject["timer"];
    int seconds = (int)strtol(sec.c_str(), NULL, 10);
    room1.getLed().setDuration(seconds * 1000);
    room1.getLed().setStartTime(millis());
    ///////////////////////////////////  now make the flag zero so i don't read it here anymore
    HTTPClient http;
    int httpCode;
    postData = "id=esp1";
    postData += "&roomID=1";
    postData += "&timer=" + sec;
    postData += "&timer_flag=0";
    payload = "";
    http.begin("http://192.168.8.110/GP/back/updatetimer.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    httpCode = http.POST(postData);
    payload = http.getString();
    http.end();
  }
}

void room1get()
{
  if (WiFi.status() == WL_CONNECTED)
  {
    HTTPClient http;
    int httpCode;
    postData = "id=esp1";
    postData += "&roomID=1";
    payload = "";
    http.begin("http://192.168.8.110/GP/back/getdata.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    httpCode = http.POST(postData);
    payload = http.getString();
    http.end();
    control_room1();
  }
}

void room1send()
{
  if (WiFi.status() == WL_CONNECTED && room1.ledbuttonclicked == true)
  {
    room1.ledbuttonclicked = false;
    HTTPClient http;
    int httpCode;
    String LED_State = "";
    if (room1.getLed().isOn() == true)
      LED_State = "ON";
    else if (room1.getLed().isOn() == false)
      LED_State = "OFF";

    postData = "id=esp1";
    postData += "&roomID=1";
    postData += "&LED=" + LED_State;
    payload = "";
    http.begin("http://192.168.8.110/GP/back/updatedata.php");
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    httpCode = http.POST(postData);
    payload = http.getString(); // return nothing
    http.end();
  }
}

void senddata()
{
  room1send();
}

void getdata()
{
  room1get();
}
