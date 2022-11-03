//---------------------------------------------------------------------------
 #include<iostream>
#include <vcl.h>
#pragma hdrstop
#include "puc.h"
#include "joc.h"
#include "fereastra.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
Tplayer2 *player2;
int nrvictoriip1=0,nrvictoriip2=0;
bool SchimbaOrdinea=true, btnStartAFostApasat=false;
//---------------------------------------------------------------------------
__fastcall Tplayer2::Tplayer2(TComponent* Owner)
        : TForm(Owner)
{           arata= new PUC(10,10);
 nrvictoriip1=0;
 nrvictoriip2=0;
 SchimbaOrdinea=true;
  btnStartAFostApasat=false;
}
//---------------------------------------------------------------------------

void __fastcall Tplayer2::btnStartClick(TObject *Sender)
{
 btnStartAFostApasat=true;
 player2->Socket->SendText("START2");
}
//---------------------------------------------------------------------------

void __fastcall Tplayer2::cl1Click(TObject *Sender)
{
   ojoc->DisparePuculUndeOSaCadaLaClick(casuta,arata);
   if(ojoc->player1G==false)
       player2->Socket->SendText("btn1");


}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl2Click(TObject *Sender)
{
ojoc->DisparePuculUndeOSaCadaLaClick(casuta,arata);
if(ojoc->player1G==false)
   player2->Socket->SendText("btn2");

}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl3Click(TObject *Sender)
{
ojoc->DisparePuculUndeOSaCadaLaClick(casuta,arata);
if(ojoc->player1G==false)
   player2->Socket->SendText("btn3");

}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl4Click(TObject *Sender)
{
ojoc->DisparePuculUndeOSaCadaLaClick(casuta,arata);
if(ojoc->player1G==false)
   player2->Socket->SendText("btn4");
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl5Click(TObject *Sender)
{         arata=new PUC(10,10);
if(ojoc->player1G==false)
   player2->Socket->SendText("btn5");
}
void __fastcall Tplayer2::btnContinuaClick(TObject *Sender)
{
  textW->Visible=false;
  player2->Socket->SendText("continua2");
  LabelContinua->Visible=true;
  btnContinua->Visible=false;
  LabelContinua->Caption="Asteptati raspunsul adversarului";
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::btnExitClick(TObject *Sender)
{
 player2->Socket->SendText("exit");
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::timpTimer(TObject *Sender)
{
   cadere(ojoc->getLinie(),ojoc->getColoana());
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::FormResize(TObject *Sender)
{
if(btnStartAFostApasat) {
TRect r;
for(int i=0;i<5;i++)
   for(int j=0;j<5;j++)
       {
            r=casuta->CellRect(j,i);
            if(ojoc->getElementMatrice(i,j)==T_GOL)
                 casuta->Canvas->Brush->Color=clWhite;
            else
                  if(ojoc->getElementMatrice(i,j)==T_P1G)
                        casuta->Canvas->Brush->Color=clYellow;
                  else
                        casuta->Canvas->Brush->Color=clBlue;
            casuta->Canvas->Ellipse(r);
       }
   }
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::player2Read(TObject *Sender,
      TCustomWinSocket *Socket)
{
  String str;
  str=Socket->ReceiveText();
  if(str=="btn1")
    {
      if(ojoc->getElementMatrice(0,0)==T_GOL&& timp->Enabled==false)
        {
          ojoc->UmplereMatrice(0);
          ojoc->afisare(casuta,0,0);
          timp->Enabled=true;
          Text_Randul_Cui();
        }
      if(ojoc->getElementMatrice(0,0)!=T_GOL)
          cl1->Cursor=crNo;
    }
  if(str=="btn2")
    {
      if(ojoc->getElementMatrice(0,1)==T_GOL&& timp->Enabled==false)
        {
          ojoc->UmplereMatrice(1);
          ojoc->afisare(casuta,0,1);
          timp->Enabled=true;
          Text_Randul_Cui();
        }
      if(ojoc->getElementMatrice(0,1)!=T_GOL)
         cl2->Cursor=crNo;
    }
  if(str=="btn3")
    {
      if(ojoc->getElementMatrice(0,2)==T_GOL&& timp->Enabled==false)
       {
         ojoc->UmplereMatrice(2);
         ojoc->afisare(casuta,0,2);
         timp->Enabled=true;
         Text_Randul_Cui();
       }
      if(ojoc->getElementMatrice(0,2)!=T_GOL)
         cl3->Cursor=crNo;
    }
  if(str=="btn4")
    {
      if(ojoc->getElementMatrice(0,3)==T_GOL&& timp->Enabled==false)
       {
         ojoc->UmplereMatrice(3);
         ojoc->afisare(casuta,0,3);
         timp->Enabled=true;
         Text_Randul_Cui();
       }
      if(ojoc->getElementMatrice(0,3)!=T_GOL)
         cl4->Cursor=crNo;
    }
  if(str=="btn5")
    {
      if(ojoc->getElementMatrice(0,4)==T_GOL&& timp->Enabled==false)
        {
          ojoc->UmplereMatrice(4);
          ojoc->afisare(casuta,0,4);
          timp->Enabled=true;
          Text_Randul_Cui();
        }
      if(ojoc->getElementMatrice(0,4)!=T_GOL)
          cl5->Cursor=crNo;
    }
  if(str=="exit")
     exit(0);
  if(str=="continua1")
      {
         textW->Visible=false;
         btnContinua->Visible=false;
         LabelContinua->Visible=true;
         LabelContinua->Caption="Adversarul doreste o noua partida.";
         btnAccept->Visible=true;
      }
  if(str=="accept")
      {
         textW->Visible=true;
         LabelContinua->Visible=false;
         btnAccept->Visible=false;
         ResetTot();
         textW->Caption="Este randul tau(albastru)";
         ojoc=new JOC();
         SchimbaOrdinea=!SchimbaOrdinea;
         if(!SchimbaOrdinea)
           {
              ojoc->player1G=false;
           }
         else
             ojoc->player1G=true;
      }
      if(str=="START2")
      {
       Label1->Visible=true;
        Label2->Visible=true;
        nrv1->Visible=true;
        nrv2->Visible=true;
        btnExit->Visible=true;
        btnStart->Visible=false;
        textW->Visible=true;
        cl1->Visible=true;
        cl2->Visible=true;
        cl3->Visible=true;
        cl4->Visible=true;
        cl5->Visible=true;
        casuta->Visible=true;
        ojoc=new JOC();
        TRect r;
        int i,j;
        for(i=0;i<5;i++)
           for(j=0;j<5;j++)
             {
               r=casuta->CellRect(i,j);
               casuta->Canvas->Brush->Color=clWhite;
               casuta->Canvas->Ellipse(r);
             }
      }
      if(str=="START1")
         btnStart->Visible=true;
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::btnAcceptClick(TObject *Sender)
{
  player2->Socket->SendText("accept");
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl1MouseMove(TObject *Sender, TShiftState Shift,
      int X, int Y)
{
if(!ojoc->player1G&&timp->Enabled==false)
 {
   TRect r;
   if(arata->getColoana()!=10)
        AfCuloareLaMouseMove("alb");
    for(int i=4;i>=0;i--)
      if(ojoc->getElementMatrice(i,0)==T_GOL)
         {
          arata=new PUC(i,0);
          break  ;
         }
         AfCuloareLaMouseMove("navy");
   }
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl2MouseMove(TObject *Sender, TShiftState Shift,
      int X, int Y)
{
if(!ojoc->player1G&&timp->Enabled==false)
  {
   TRect r;
   if(arata->getColoana()!=10)
         AfCuloareLaMouseMove("alb");
    for(int i=4;i>=0;i--)
      if(ojoc->getElementMatrice(i,1)==T_GOL)
         {
          arata=new PUC(i,1);
          break  ;
         }
    AfCuloareLaMouseMove("navy");
  }
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl3MouseMove(TObject *Sender, TShiftState Shift,
      int X, int Y)
{
if(!ojoc->player1G&&timp->Enabled==false)
    {
   TRect r;
   if(arata->getColoana()!=10)
       AfCuloareLaMouseMove("alb");
    for(int i=4;i>=0;i--)
      if(ojoc->getElementMatrice(i,2)==T_GOL)
         {
          arata=new PUC(i,2);
          break  ;
         }
       AfCuloareLaMouseMove("navy");
    }
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl4MouseMove(TObject *Sender, TShiftState Shift,
      int X, int Y)
{
if(!ojoc->player1G&&timp->Enabled==false)
    {
   TRect r;
   if(arata->getColoana()!=10)
        AfCuloareLaMouseMove("alb");
    for(int i=4;i>=0;i--)
      if(ojoc->getElementMatrice(i,3)==T_GOL)
         {
          arata=new PUC(i,3);
          break  ;
         }
        AfCuloareLaMouseMove("navy");
    }
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::cl5MouseMove(TObject *Sender, TShiftState Shift,
      int X, int Y)
{
if(!ojoc->player1G&&timp->Enabled==false)
 {
   TRect r;
   if(arata->getColoana()!=10)
        AfCuloareLaMouseMove("alb");
    for(int i=4;i>=0;i--)
      if(ojoc->getElementMatrice(i,4)==T_GOL)
         {
          arata=new PUC(i,4);
          break  ;
         }
      AfCuloareLaMouseMove("navy");
  }
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::FormMouseMove(TObject *Sender, TShiftState Shift,
      int X, int Y)
{
if(btnStartAFostApasat)
    AfCuloareLaMouseMove("alb");
}
//---------------------------------------------------------------------------
void __fastcall Tplayer2::casutaMouseMove(TObject *Sender,
      TShiftState Shift, int X, int Y)
{
    if( !ojoc->player1G)
         AfCuloareLaMouseMove("alb");
}
//---------------------------------------------------------------------------
  void Tplayer2::AfCuloareLaMouseMove(String culoare)
   {
          TRect r;
          r=casuta->CellRect(arata->getColoana(),arata->getLinie());
          if(culoare=="alb")
             casuta->Canvas->Brush->Color=clWhite;
          else
             casuta->Canvas->Brush->Color=clNavy;
           casuta->Canvas->Ellipse(r);

   }
//---------------------------------------------------------------------------
void Tplayer2::DacaCinevaCastiga()
{
   textW->Font->Size=40;
   textW->Font->Color=clGreen;
   btnContinua->Visible=true;
   textW->Visible=true;
   cl1->Visible=false;
   cl2->Visible=false;
   cl3->Visible=false;
   cl4->Visible=false;
   cl5->Visible=false;
   if(ojoc->player1G)
       {
           textW->Caption="Ai pierdut";
           textW->Font->Color=clRed;
           nrvictoriip2++;
           nrv2->Caption=nrvictoriip2;
       }
   else
       {
           textW->Caption="Ai castigat";
           textW->Font->Color=clGreen;
           nrvictoriip1++;
           nrv1->Caption=nrvictoriip1;
       }
   ojoc->Evidentiere_Cele3_Pucuri_La_W(casuta);
}
//---------------------------------------------------------------------------
void  Tplayer2::ResetTot()
{
delete ojoc;
textW->Caption="Este randul adversarului";
textW->Font->Size=20;
textW->Font->Color=clBlack;
btnContinua->Visible=false;
cl1->Visible=true;
cl2->Visible=true;
cl3->Visible=true;
cl4->Visible=true;
cl5->Visible=true;
cl1->Cursor=crDefault;
cl2->Cursor=crDefault;
cl3->Cursor=crDefault;
cl4->Cursor=crDefault;
cl5->Cursor=crDefault;
TRect r;
int i,j;
for(i=0;i<5;i++)
   for(j=0;j<5;j++)
       {
             r=casuta->CellRect(i,j);
             casuta->Canvas->Pen->Color=clMenuHighlight;
             casuta->Canvas->Brush->Color=clWhite;
             casuta->Canvas->Ellipse(r);
        }
//pt contur cu negru
for(i=0;i<5;i++)
   for(j=0;j<5;j++)
       {
             r=casuta->CellRect(i,j);
             casuta->Canvas->Pen->Width=1;
             casuta->Canvas->Pen->Color=clBlack;
             casuta->Canvas->Ellipse(r);
        }

}
//---------------------------------------------------------------------------
void Tplayer2::DacaSeFaceEgal()
{
    textW->Caption="Este Egalitate";
    textW->Font->Size=36;
    btnContinua->Visible=true;
    cl1->Visible=false;
    cl2->Visible=false;
    cl3->Visible=false;
    cl4->Visible=false;
    cl5->Visible=false;
}
//---------------------------------------------------------------------------
void Tplayer2::cadere(int linie,int col)
{
 arata=new PUC(10,10);
     if(linie!=0)
       {
        ojoc->sterge( casuta,ojoc->linia0,col);
         ojoc->linia0++;
         ojoc->afisare(casuta,ojoc->linia0,col);
         if(ojoc->linia0==linie)
             {
                timp->Enabled=false;
                ojoc->linia0=0;
                TRect r;
                r=casuta->CellRect(col,linie);
                if(ojoc->player1G)
                     casuta->Canvas->Brush->Color=clYellow;
                 else
                     casuta->Canvas->Brush->Color=clBlue;
                casuta->Canvas->Ellipse(r);
                if(ojoc->VerificareCastigator())
                     DacaCinevaCastiga();
                ojoc->player1G=!ojoc->player1G;
             }
       }
     else if(linie==0)
             {
                timp->Enabled=false;
                if(ojoc->VerificareCastigator())
                     DacaCinevaCastiga();
                if(ojoc->VerificareEgalitate())
                     DacaSeFaceEgal();
                ojoc->player1G=!ojoc->player1G;
             }
}
//---------------------------------------------------------------------------
void  Tplayer2::Text_Randul_Cui()
{
     if(!ojoc->player1G)
             textW->Caption="Este randul adversarului";
      else
              textW->Caption="Este randul tau(albastru)";


}
