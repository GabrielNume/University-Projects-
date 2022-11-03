//---------------------------------------------------------------------------


#pragma hdrstop

#include "joc.h"

//---------------------------------------------------------------------------

#pragma package(smart_init)
//---------------------------------------------------------------------------
JOC::JOC()
{    player1G=true;
     linia0=0;
     for(int i=0;i<5;i++)
        for(int j=0;j<5;j++)
             matrice[i][j]=T_GOL;
}
//---------------------------------------------------------------------------
int JOC::getLinie()
{
   return PiesaCurenta->getLinie();

}
//---------------------------------------------------------------------------
int JOC::getColoana()
{
     return PiesaCurenta->getColoana();
}
//---------------------------------------------------------------------------
void JOC::UmplereMatrice(int coloana){
   int j;
   for( j=4;j>=0;j--)
       if(matrice[j][coloana]==T_GOL)
       {
              PiesaCurenta=new PUC(j, coloana);
               break;
       }
   PiesaCurenta->InsertMatrice1_2(matrice,player1G);
   //player1G=!player1G;
}
//---------------------------------------------------------------------------
bool JOC::VerificareCastigator()
{
    int c=PiesaCurenta->getColoana();
    int l=PiesaCurenta->getLinie();
    if(VerificareLinie(l,c)) return true;
    if(VerificareColoana(l,c)) return true;
    if(VerificareDiagonalaSD(l,c)) return true;
    if(VerificareDiagonalaDS(l,c)) return true;
    return false;
}
//---------------------------------------------------------------------------
bool JOC::VerificareLinie(int l,int c)
{
    if(matrice[l][c+1]==matrice[l][c]&&c<=3)
        {
           if(matrice[l][c+2]==matrice[l][c]&&c<=2)
                 {
                       p1=new PUC(l,c+1);
                       p2=new PUC(l,c+2);
                       return true;
                 }
           else if(matrice[l][c-1]==matrice[l][c]&&c>=1)
                 {
                        p1=new PUC(l,c+1);
                        p2=new PUC(l,c-1);
                        return true;
                 }
        }
     if(matrice[l][c-1]==matrice[l][c]&&matrice[l][c-2]==matrice[l][c]&&c>=2)
             {
                 p1=new PUC(l,c-1);
                 p2=new PUC(l,c-2);
                 return true;
             }
     return false;
}
//---------------------------------------------------------------------------
bool JOC::VerificareColoana(int l,int c)
{
      if(matrice[l][c]==matrice[l+1][c]&&matrice[l][c]==matrice[l+2][c]&&l<=2)
            {
               p1=new PUC(l+1,c);
               p2=new PUC(l+2,c);
               return true;
            }
      return false;
}
//---------------------------------------------------------------------------
bool JOC::VerificareDiagonalaSD(int l, int c)
{
     if(matrice[l][c]==matrice[l-1][c-1]&&l>=1&&c>=1)
         {
              if(matrice[l][c]==matrice[l-2][c-2]&&l>=2&&c>=2)
                    {
                         p1=new PUC(l-1,c-1);
                         p2=new PUC(l-2,c-2);
                         return true;
                    }
              else if(matrice[l][c]==matrice[l+1][c+1]&&l<=3&&c<=3)
                    {
                       p1=new PUC(l-1,c-1);
                       p2=new PUC(l+1,c+1);
                       return true;
                    }
         }
  if(matrice[l][c]==matrice[l+1][c+1]&&matrice[l][c]==matrice[l+2][c+2]&&l<=2&&c<=2)
        {
            p1=new PUC(l+1,c+1);
            p2=new PUC(l+2,c+2);
            return true;
        }
  return false;
}
//---------------------------------------------------------------------------
bool JOC::VerificareDiagonalaDS(int l, int c)
{
    if(matrice[l][c]==matrice[l-1][c+1]&&1<=l&&c<=3)
        {
             if(matrice[l][c]==matrice[l-2][c+2]&&l>=2&&c<=2)
                 {
                       p1=new PUC(l-1,c+1);
                       p2=new PUC(l-2,c+2);
                       return true;
                 }
             else if(matrice[l][c]==matrice[l+1][c-1]&&l<=3&&c>=1)
                 {
                       p1=new PUC(l-1,c+1);
                       p2=new PUC(l+1,c-1);
                       return true;
                 }
        }
   if(matrice[l][c]==matrice[l+1][c-1]&&matrice[l][c]==matrice[l+2][c-2]&&l<=2&&2<=c)
        {
             p1=new PUC(l+1,c-1);
             p2=new PUC(l+2,c-2);
             return true;
        }
   return false;

}
//---------------------------------------------------------------------------
void JOC::afisare(TDrawGrid* casuta,int linie,int col)
{
   TRect r;
   r=casuta->CellRect(col,linie);
   if(player1G)
        casuta->Canvas->Brush->Color=clYellow;
   else
        casuta->Canvas->Brush->Color=clBlue;
   casuta->Canvas->Ellipse(r);
}
//---------------------------------------------------------------------------
void JOC::sterge(TDrawGrid * casuta,int linie,int col)
{

   TRect r;
   r=casuta->CellRect(col,linie);
   casuta->Canvas->Brush->Color=clWhite;
   casuta->Canvas->Ellipse(r);
}
//---------------------------------------------------------------------------
void JOC::Evidentiere_Cele3_Pucuri_La_W(TDrawGrid * casuta)
{
  /*if(player1)
        casuta->Canvas->Brush->Color=clOlive;
   else
        casuta->Canvas->Brush->Color=clNavy;

   TRect r;
   r=casuta->CellRect(PiesaCurenta->getColoana(),PiesaCurenta->getLinie());
   casuta->Canvas->Ellipse(r);
   r=casuta->CellRect(p1->getColoana(),p1->getLinie());
   casuta->Canvas->Ellipse(r);
   r=casuta->CellRect(p2->getColoana(),p2->getLinie());
   casuta->Canvas->Ellipse(r);
    */

    TRect r;
    casuta->Canvas->Pen->Width=5;
    casuta->Canvas->Pen->Color=clBlack;
    r=casuta->CellRect(PiesaCurenta->getColoana(),PiesaCurenta->getLinie());
    casuta->Canvas->Ellipse(r);
    r=casuta->CellRect(p1->getColoana(),p1->getLinie());
    casuta->Canvas->Ellipse(r);
    r=casuta->CellRect(p2->getColoana(),p2->getLinie());
    casuta->Canvas->Ellipse(r);
 }
//---------------------------------------------------------------------------
int JOC::getElementMatrice(int l,int c)
 {
     return matrice[l][c];
 }
//---------------------------------------------------------------------------
bool JOC:: VerificareEgalitate()
 {
     for(int i=0;i<5;i++)
        for(int j=0;j<5;j++)
           if(matrice[i][j]==T_GOL)
                       return false;
     return true;

 }

  //---------------------------------------------------------------------------
 void JOC::DisparePuculUndeOSaCadaLaClick(TDrawGrid * casuta,PUC *arata)
{      TRect r;
      r=casuta->CellRect(arata->getColoana(),arata->getLinie());
        casuta->Canvas->Brush->Color=clWhite;
        casuta->Canvas->Ellipse(r);
}





