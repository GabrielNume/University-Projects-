//---------------------------------------------------------------------------

#include <vcl.h>
#pragma hdrstop

#include "server.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
TForm1 *Form1;
//---------------------------------------------------------------------------
__fastcall TForm1::TForm1(TComponent* Owner)
        : TForm(Owner)
{
}
//---------------------------------------------------------------------------
void __fastcall TForm1::serverClientRead(TObject *Sender,
      TCustomWinSocket *Socket)
{
 String nr;
  nr=Socket->ReceiveText();
      for(int i=0;i<server->Socket->ActiveConnections;i++)
         {
               server->Socket->Connections[i]->SendText(nr);
         }        
}
//---------------------------------------------------------------------------
