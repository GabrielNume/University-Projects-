//---------------------------------------------------------------------------

#ifndef fereastraH
#define fereastraH
//---------------------------------------------------------------------------
#include <Classes.hpp>
#include <Controls.hpp>
#include <StdCtrls.hpp>
#include <Forms.hpp>
#include <Grids.hpp>
#include <ExtCtrls.hpp>
#include <ScktComp.hpp>
//---------------------------------------------------------------------------
class Tplayer1 : public TForm
{
__published:	// IDE-managed Components
        TButton *btnStart;
        TDrawGrid *casuta;
        TButton *cl1;
        TButton *cl2;
        TButton *cl3;
        TButton *cl4;
        TButton *cl5;
        TLabel *textW;
        TButton *btnContinua;
        TButton *btnExit;
        TTimer *timp;
        TLabel *Label1;
        TLabel *Label2;
        TPanel *nrv1;
        TPanel *nrv2;
        TClientSocket *player1;
        TLabel *LabelContinua;
        TButton *btnAccept;
        void __fastcall btnStartClick(TObject *Sender);
        void __fastcall cl1Click(TObject *Sender);
        void __fastcall cl2Click(TObject *Sender);
        void __fastcall cl3Click(TObject *Sender);
        void __fastcall cl4Click(TObject *Sender);
        void __fastcall cl5Click(TObject *Sender);
        void __fastcall btnContinuaClick(TObject *Sender);
        void __fastcall btnExitClick(TObject *Sender);
        void __fastcall timpTimer(TObject *Sender);
        void __fastcall FormResize(TObject *Sender);
        void __fastcall player1Read(TObject *Sender,
          TCustomWinSocket *Socket);
        void __fastcall btnAcceptClick(TObject *Sender);
        void __fastcall cl1MouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
        void __fastcall cl2MouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
        void __fastcall cl3MouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
        void __fastcall cl4MouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
        void __fastcall cl5MouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
        void __fastcall FormMouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
        void __fastcall casutaMouseMove(TObject *Sender, TShiftState Shift,
          int X, int Y);
private:	// User declarations
         JOC *ojoc;
         PUC *arata;
         int nrvictoriip1,nrvictoriip2;
         bool SchimbaOrdinea, btnStartAFostApasat;
public:		// User declarations
        __fastcall Tplayer1(TComponent* Owner);
        void DacaCinevaCastiga();
        void cadere(int,int);
        void Text_Randul_Cui();
        void ResetTot();
        void DacaSeFaceEgal();
        void AfCuloareLaMouseMove(String);
};
//---------------------------------------------------------------------------
extern PACKAGE Tplayer1 *player1;
//---------------------------------------------------------------------------
#endif
