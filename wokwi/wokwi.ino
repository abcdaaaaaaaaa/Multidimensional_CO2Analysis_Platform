// https://wokwi.com/projects/451236425445747713

#include "MG811.h"
#include <DHT.h>
#include <WiFi.h>
#include <ThingSpeak.h>
#include <TinyGPS++.h>

#define ADC_BIT_RESU (12)
#define gasPin       (34)
#define dhtPin       (33)

const char* ssid = "Wokwi-GUEST";  
const char* password = ""; 

unsigned long int hello1 = 1;
unsigned long int hello2 = 2;

static const char* myWriteAPIKey1 = "PWIFQRC3WHDW6YG5";
static const char* myWriteAPIKey2 = "AML2X6TU1PFQ8DUB";

WiFiClient client;
HardwareSerial neogps(2); 
TinyGPSPlus gps;

float startTime = 0;

bool measuring = false;
bool windowLock = false;

float sensorVal, CO2, CH4, C2H5OH, CO, TheoreticalCO2, temp, rh, Time, Correction;
int Gas;
String lat, lng;

MG811 sensor(ADC_BIT_RESU, gasPin);
DHT dht(dhtPin, DHT22);

long round2(float x);
long round4(float x);
void sendData();

void setup() {
  Serial.begin(115200);
  sensor.begin();
  dht.begin();

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }

  ThingSpeak.begin(client);
  neogps.begin(9600, SERIAL_8N1, RX2, TX2);
}

void loop() {
  temp = dht.readTemperature();
  rh = dht.readHumidity();
  sensorVal = sensor.read();

  if(sensorVal == 0) {
    measuring = false;
    startTime = 0;
    windowLock = false;
    return;
  }

  if(!measuring && sensorVal > 0) {
    startTime = millis() / 1000.0;
    measuring = true;
    windowLock = false;
  }

  if(measuring) {
    float t = sensor.correction_time((millis() / 1000.0) - startTime);

    if(t >= 9 && t <= 11) {
      if(!windowLock) {
        sendData();
        windowLock = true;
      }
    } else {
      windowLock = false;
    }
  }
}

void sendData() {
  Time = sensor.correction_time((millis() / 1000.0) - startTime);
  Correction = sensor.calculateCorrection(Time);
  TheoreticalCO2 = sensor.TheoreticalCO2(sensorVal);

  CH4 = sensor.calculateppm(sensorVal, temp, rh, Correction, 0);
  C2H5OH = sensor.calculateppm(sensorVal, temp, rh, Correction, 1);
  CO = sensor.calculateppm(sensorVal, temp, rh, Correction, 2);
  CO2 = sensor.calculateppm(sensorVal, temp, rh, Correction, 3);

  Gas = analogRead(gasPin);

  lat  = String((random(-90, 90) + (random(0, pow(10, 6) + 1) / pow(10, 7)) + 90) * pow(10,6)); 
  lng = String((random(-180, 180) + (random(0, pow(10, 6) + 1) / pow(10, 7)) + 180) * pow(10,6)); 
  if (neogps.available()) {
    char c = neogps.read();
    if (gps.encode(c)) {
      if (gps.location.isValid()) {
        lat  = String((gps.location.lat() + 90) * pow(10, 7)); 
        lng = String((gps.location.lng() + 180) * pow(10, 7)); 
      }
    }
  }

  ThingSpeak.setField(1, round2(Time));
  ThingSpeak.setField(2, round4(Correction));
  ThingSpeak.setField(3, round2(TheoreticalCO2));
  ThingSpeak.setField(4, round2(CO2));
  ThingSpeak.setField(5, round2(CH4));
  ThingSpeak.setField(6, round2(C2H5OH));
  ThingSpeak.setField(7, round2(CO));
  ThingSpeak.setField(8, Gas);
  ThingSpeak.writeFields(hello1, myWriteAPIKey1);

  ThingSpeak.setField(1, (temp + 140) * 10);
  ThingSpeak.setField(2, (rh + 100) * 10);
  ThingSpeak.setField(3, lat);
  ThingSpeak.setField(4, lng);
  ThingSpeak.writeFields(hello2, myWriteAPIKey2);
}

long round2(float x) {
  return round(x * 100);
}

long round4(float x) {
  return round(x * 10000);
}
