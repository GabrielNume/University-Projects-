//---------------------------------------------------------------------------

#ifndef pucH
#define pucH
#define T_P1G 1
#define T_P2A 2
//---------------------------------------------------------------------------
class PUC{
 private:
        int Linie,Coloana;
 public:
        PUC(int,int);
        PUC();
        void InsertMatrice1_2(int matrice[5][5],bool);
        int getLinie();
        int getColoana();

};

#endif
 