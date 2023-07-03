#include "BluetoothSerial.h"
#include <SPIFFS.h>
BluetoothSerial SerialBT;

String glb = "";
bool glob_t = false;
uint8_t remoteAddress[] = {0xbc, 0xdd, 0xc2, 0xd1, 0xc2, 0x86};

void setup() {
  Serial.begin(115200);
  SerialBT.begin("ESP32TEST");

  if (!SPIFFS.begin(true)) {
    Serial.println("An Error has occurred while mounting SPIFFS");
    return;
  }

  if (!SPIFFS.exists("/myfile.txt")) {
    // Creeaza fisierul
    File file = SPIFFS.open("/myfile.txt", "w");
    if (!file) {
      Serial.println("Failed to create file");
      return;
    }
    bool myBool = true;
    file.print("Created file first Time");
    file.print("@");
    file.print(myBool);
    file.close();

  }

}

void loop(void) {

  if (SPIFFS.exists("/myfile.txt")) {
    File file = SPIFFS.open("/myfile.txt", "r");
    String content = file.readString();
    file.close();
    glob_t  = false;
    if (content.charAt(0) == '1')

    {
      glob_t = true;
      SerialBT.end();
      SerialBT.begin("ESP32TEST", true);
    }
  }

  Serial.println(glob_t);
  if (glob_t )
  {
    
    SerialBT.connect(remoteAddress);
    if ( ! SerialBT.isClosed() && SerialBT.connected())
    { 

      File file = SPIFFS.open("/myfile.txt", "r");
      String content = file.readString();
      file.close();

      String str = content.substring(content.indexOf("@") + 1);

      if ( SerialBT.write((const uint8_t*) str.c_str(), str.length()) != str.length())
        Serial.println("error");
      else
        Serial.print("corect");

    
      file = SPIFFS.open("/myfile.txt", "w");
      glob_t = false;

      file.print(glob_t);
      file.print("@");
      file.print("NULL");
      file.close();

      glb = "";
      delay(1000);
      SerialBT.end();
      SerialBT.begin("ESP32TEST");
    }
  }
  else {
    if (SerialBT.available()) 
    {
     
      String input = SerialBT.readString();
      input.remove(input.length() - 2);
      glb = input;
      glob_t = true;

      File file = SPIFFS.open("/myfile.txt", "w");
      file.print(glob_t);
      file.print("@");
      file.print(glb);
      file.close();

      SerialBT.end();
      SerialBT.begin("ESP32TEST", true);
    }
  }
  delay(400);
}
