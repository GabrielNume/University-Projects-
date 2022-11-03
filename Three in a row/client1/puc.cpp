//---------------------------------------------------------------------------


#pragma hdrstop
#include "puc.h"
#pragma package(smart_init)
//---------------------------------------------------------------------------
PUC::PUC(int aLinie,int aColoana )
{
  Linie=aLinie;
  Coloana=aColoana;
}
PUC::PUC()
{
 Linie=10;
 Coloana=10;
}
//---------------------------------------------------------------------------
void PUC::InsertMatrice1_2(int matrice[5][5],bool player1G){
  if(player1G)
          matrice[Linie][Coloana]=T_P1G;
   else
          matrice[Linie][Coloana]=T_P2A;
}
//---------------------------------------------------------------------------
int PUC::getLinie()
 {
      return Linie;
 }
//---------------------------------------------------------------------------
int PUC::getColoana()
 {
      return Coloana;
 }
