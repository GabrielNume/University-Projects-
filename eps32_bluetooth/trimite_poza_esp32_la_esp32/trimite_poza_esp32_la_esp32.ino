#include "SPI.h"
#include "Adafruit_GFX.h"
#include "WROVER_KIT_LCD.h" //lib de controle do display
#include <SD_MMC.h>  //lib de controle do micro-SD
#include "esp_wp1.h" //imagem em HEX



#include "BluetoothSerial.h"
BluetoothSerial SerialBT;

WROVER_KIT_LCD tft; //objeto responsável pelo controle do display

int screen = 0; //controle de tela
uint8_t remoteAddress[] = {0xbc, 0xdd, 0xc2, 0xd1, 0xc2, 0x86};
void setup() {
  Serial.begin(115200);
  SerialBT.begin("ESP32TEST", true);
  SerialBT.connect(remoteAddress);
  tft.begin(); //inicializa o display
}

//pinta toda a tela com a cor desejada
void clearScreen(int color)
{
  tft.fillScreen(color); //pinta toda a tela
}

void loop(void) {
  
    Serial.println("VOid loop");
    SerialBT.connect(remoteAddress);
  if (SerialBT.connected())
  {
    Serial.println("connect");
    tft.setRotation(1);
     tft.drawJpg(wireless_Data, 76800);
      
    SerialBT.write(wireless_Data,76800);
   // SerialBT.end();
   // delay(1000);
   
    delay(1000);
  }
  
}
