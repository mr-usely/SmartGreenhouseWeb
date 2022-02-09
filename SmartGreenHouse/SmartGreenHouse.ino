#include <Arduino.h>
#include <Wire.h>
#include <SPI.h>
#include <Ethernet.h>
#include "DHT.h"
#include "RTClib.h"

#define DHTPIN 2
#define DHTTYPE 22

DHT dht(DHTPIN, DHTTYPE);

RTC_Millis rtc;

String tstr;

int solepin = A1;
int soilmoisturePin = A0;

float soilmoistureraw;
float soilmoisture;
int waterlevel;
float humidity;
float temperature;
bool wateredToday = false;
byte mac[] = { 0x15, 0x34, 0xA4, 0xE7, 0x76, 0x13 };

IPAddress ip(192,168,1,100);

char server[] = "169.254.197.48";

String rcv="";
EthernetClient client;
DateTime now;

void setup() {
  Serial.begin(19200);

  Ethernet.begin(mac, ip);
  
  pinMode(solepin, OUTPUT);
  digitalWrite(solepin, HIGH); 
  
  dht.begin();
  
  Wire.begin();
  rtc.adjust(DateTime(F(__DATE__), F(__TIME__)));

  now = rtc.now();
}

void loop() {
 

  soilmoistureraw = analogRead(soilmoisturePin) * (3.3 / 1024);

  humidity = dht.readHumidity();
  temperature = dht.readTemperature();


  if (soilmoistureraw < 1.1) {
    soilmoisture = (10 * soilmoistureraw) - 1;
  }
  else if (soilmoistureraw < 1.3) {
    soilmoisture = (25 * soilmoistureraw) - 17.5;
  }
  else if (soilmoistureraw < 1.82) {
    soilmoisture = (48.08 * soilmoistureraw) - 47.5;
  }
  else if (soilmoistureraw < 2.2) {
    soilmoisture = (26.32 * soilmoistureraw) - 7.89;
  }
  else {
    soilmoisture = (62.5 * soilmoistureraw) - 87.5;
  }
  
  if (soilmoisture >= 105){
    soilmoisture = 0;
  }
  
if (!(now.day()==rtc.now().day())) {
    wateredToday = false;
  }

Serial.println(soilmoisture);
//codes for request to the server 

Serial.println("==============================");
//reqTemp();
Serial.println("==============================");
//reqHum();
Serial.println("==============================");
//reqSoil();
Serial.println("==============================");
delay(3000);

  now = rtc.now();
  
    Serial.println("==============================");
    Serial.print(now.hour(), DEC);
    Serial.print(':');
    Serial.print(now.minute(), DEC);
    Serial.println();  
    Serial.println("==============================");

summerSeason();
rainySeason();
winterSeason();
defaultWatering();

}

void reqTemp() {
    //request for temperature
      if (client.connect(server, 8080)) 
      {
      Serial.println("Connection Established 1");
      client.print("GET /SmartGreenhouseWebServer/mo/includes/write_temp.php?");
      client.print("temp=");
      client.print(temperature);
      Serial.println(temperature);
      client.print("&name=ingreenhouse");
      client.println(" HTTP/1.1"); 
      client.println("Host: 169.254.197.48"); 
      client.println("Connection: close"); 
      client.println(); 
      client.println(); 
      client.stop();
      }
      else
      {
        Serial.println("Connection failed 1");
      }
}
    
void reqHum() {
      //request for humidity
      if (client.connect(server, 8080)) 
      {
      Serial.println("Connection Established 2");
      client.print("GET /SmartGreenhouseWebServer/hum/includes/write_hum.php?");
      client.print("humidity=");
      client.print(humidity);
      Serial.println(humidity);
      client.print("&name=ingreenhouse");
      client.println(" HTTP/1.1"); 
      client.println("Host: 169.254.197.48"); 
      client.println("Connection: close"); 
      client.println(); 
      client.println(); 
      client.stop();
      }
      else
      {
        Serial.println("Connection failed 2");
      }
}    
  
void reqSoil() {      
      //request for soilmoisture
      if (client.connect(server, 8080)) 
      {
      Serial.println("Connection Established 3");
      client.print("GET /system/system/write_data.php?");
      client.print("data=");
      client.print(soilmoisture);
      Serial.println(soilmoisture);
      //client.print("&name=insoil");
      client.println(" HTTP/1.1"); 
      client.println("Host: 169.254.197.48"); 
      client.println("Connection: close"); 
      client.println(); 
      client.println(); 
      client.stop();
      }
      else
      {
        Serial.println("Connection failed 3");
      }
}     
  
void reqWater() {     
      //request for waterlevel
      if (client.connect(server, 443)) 
      {
      Serial.println("Connection Established 4");
      client.print("GET /SmartGreenhouseWebServer/wattime/includes/write_watert.php?");
      client.print("watervalue=");
      client.print(soilmoisture);
      Serial.println("watered");
      client.println(" HTTP/1.1"); 
      client.println("Host: 169.254.197.48"); 
      client.println("Connection: close"); 
      client.println(); 
      client.println(); 
      client.stop();
      }
      else
      {
        Serial.println("Connection failed 4");
      }
}

  //watering time
void summerSeason(){
    //Summer Season
    if(temperature >= 30 && temperature <= 35){
      if((now.hour() >= 6) && (now.hour() <= 8)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Summer Season");
        delay(600000);
        digitalWrite(solepin, HIGH);
       // reqWater();
      }
      else if((now.hour() >= 18) && (now.hour() <= 19)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Summer Season");
        delay(600000);
        digitalWrite(solepin, HIGH);
        //reqWater();
      }
    }
  }

void rainySeason(){
  //Rainy Season
    if(waterlevel >= 90 && waterlevel <= 100){
      if((now.hour() >= 6) && (now.hour() <= 7)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Rainy Season");
        delay(600000);
        digitalWrite(solepin, HIGH);
       // reqWater();
      }
    }
    else if(waterlevel >= 100){
      digitalWrite(solepin, HIGH);
      Serial.println("water line close for Rainy Season");
    }
  }

void winterSeason(){
    //Winter Season
    if(temperature >= 13 && temperature <= 24){
      if(soilmoisture >= 60 && soilmoisture <= 100){
        if((now.hour() >= 6) && (now.hour() <= 8)){
          digitalWrite(solepin, LOW);
          Serial.println("water line open for Winter Season");
          delay(600000);
          digitalWrite(solepin, HIGH);
          //reqWater();
        }
        else if((now.hour() >= 18) && (now.hour() <= 19)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Winter Season");
        delay(600000);
        digitalWrite(solepin, HIGH);
        //reqWater();
        }
     }
     
     else if((now.hour() >= 6) && (now.hour() <= 8)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Winter Season");
        delay(600000);
        digitalWrite(solepin, HIGH);
       // reqWater();
      }
      else if((now.hour() >= 18) && (now.hour() <= 19)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Winter Season");
        delay(600000);
        digitalWrite(solepin, HIGH);
       // reqWater();
      }  
    }
  }

void defaultWatering(){
    //watering soil
      if((now.hour() >= 6) && (now.hour() <= 8)){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Default");
        delay(600000);
        digitalWrite(solepin, HIGH);
        //reqWater();
      }
      else if(now.hour() >= 18){
        digitalWrite(solepin, LOW);
        Serial.println("water line open for Default");
        delay(600000);
        digitalWrite(solepin, HIGH);
        //reqWater();
      }
    
    
    if(soilmoisture <= 100 && soilmoisture >=60 ){
      digitalWrite(solepin, LOW);
      Serial.println("water line open for Default");
      delay(600000);
      //reqWater();
    }
    else if(soilmoisture <= 65 && soilmoisture >= 1.75 ){
      digitalWrite(solepin, HIGH);
      Serial.println("water line close for Default");
    }
    else if( soilmoisture >= 0 && soilmoisture <= 1){
      digitalWrite(solepin, LOW);
      Serial.println("water line open for Default");
      delay(2000);
      digitalWrite(solepin, HIGH);

      wateredToday = true;
    }
    else{
      digitalWrite(solepin, HIGH);
      Serial.println("water line close for Default");
    }
 }
