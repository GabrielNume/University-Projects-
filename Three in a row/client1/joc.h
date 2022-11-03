//---------------------------------------------------------------------------
 #include <Grids.hpp>
#ifndef jocH
#define jocH
#include "puc.h"
#define T_GOL 0


//---------------------------------------------------------------------------
class JOC{
  private:
       int matrice[5][5];
       PUC *PiesaCurenta, *p1, *p2;
  public:
    int linia0;
    bool player1G;
    JOC();
    void UmplereMatrice(int);
    bool VerificareCastigator();
    bool VerificareEgalitate();
    bool VerificareLinie(int,int);
    bool VerificareColoana(int, int);
    bool VerificareDiagonalaSD(int, int);
    bool VerificareDiagonalaDS(int, int);
    int getLinie();
    int getColoana();
    int getElementMatrice(int,int);
    void afisare(TDrawGrid *,int,int) ;
    void sterge(TDrawGrid *,int,int);
    void Evidentiere_Cele3_Pucuri_La_W(TDrawGrid * );
    void DisparePuculUndeOSaCadaLaClick(TDrawGrid * ,PUC *);
};

#endif
