object player2: Tplayer2
  Left = 567
  Top = 169
  Align = alRight
  AutoScroll = False
  Caption = 'player2'
  ClientHeight = 593
  ClientWidth = 702
  Color = clBtnFace
  TransparentColorValue = clYellow
  UseDockManager = True
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  ShowHint = True
  OnMouseMove = FormMouseMove
  OnResize = FormResize
  PixelsPerInch = 96
  TextHeight = 14
  object textW: TLabel
    Left = 24
    Top = 8
    Width = 294
    Height = 36
    Caption = 'Este randul adversarului'
    Color = clBtnFace
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -27
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentColor = False
    ParentFont = False
    Transparent = True
    Visible = False
  end
  object Label1: TLabel
    Left = 400
    Top = 376
    Width = 197
    Height = 28
    Caption = 'Nr. victorii jucatorul1:'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    Visible = False
  end
  object Label2: TLabel
    Left = 400
    Top = 424
    Width = 197
    Height = 28
    AutoSize = False
    Caption = 'Nr. victorii jucatorul2:'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    Visible = False
  end
  object LabelContinua: TLabel
    Left = 8
    Top = 80
    Width = 335
    Height = 28
    Caption = 'Adversarul doreste o noua partina. '
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    Visible = False
  end
  object btnStart: TButton
    Left = 136
    Top = 224
    Width = 161
    Height = 81
    Caption = 'Start'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    TabOrder = 0
    Visible = False
    OnClick = btnStartClick
  end
  object casuta: TDrawGrid
    Left = 8
    Top = 184
    Width = 329
    Height = 337
    BorderStyle = bsNone
    Color = clMenuHighlight
    DefaultColWidth = 65
    DefaultRowHeight = 65
    DefaultDrawing = False
    FixedColor = clCaptionText
    FixedCols = 0
    FixedRows = 0
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clInfoText
    Font.Height = -11
    Font.Name = 'MS Sans Serif'
    Font.Style = []
    GridLineWidth = 0
    ParentFont = False
    TabOrder = 1
    Visible = False
    OnMouseMove = casutaMouseMove
  end
  object cl2: TButton
    Left = 72
    Top = 128
    Width = 73
    Height = 57
    TabOrder = 2
    Visible = False
    OnClick = cl2Click
    OnMouseMove = cl2MouseMove
  end
  object cl3: TButton
    Left = 144
    Top = 128
    Width = 65
    Height = 57
    TabOrder = 3
    Visible = False
    OnClick = cl3Click
    OnMouseMove = cl3MouseMove
  end
  object cl4: TButton
    Left = 208
    Top = 128
    Width = 65
    Height = 57
    TabOrder = 4
    Visible = False
    OnClick = cl4Click
    OnMouseMove = cl4MouseMove
  end
  object cl5: TButton
    Left = 272
    Top = 128
    Width = 65
    Height = 57
    TabOrder = 5
    Visible = False
    OnClick = cl5Click
    OnMouseMove = cl5MouseMove
  end
  object btnContinua: TButton
    Left = 432
    Top = 208
    Width = 145
    Height = 81
    Caption = 'Continua'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    TabOrder = 6
    Visible = False
    OnClick = btnContinuaClick
  end
  object btnExit: TButton
    Left = 432
    Top = 288
    Width = 145
    Height = 81
    Caption = 'Inchidere Joc'
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    TabOrder = 7
    Visible = False
    OnClick = btnExitClick
  end
  object nrv1: TPanel
    Left = 600
    Top = 368
    Width = 41
    Height = 41
    Caption = '0'
    Color = clBlue
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    TabOrder = 8
    Visible = False
  end
  object nrv2: TPanel
    Left = 600
    Top = 416
    Width = 41
    Height = 41
    Caption = '0'
    Color = clYellow
    Font.Charset = ANSI_CHARSET
    Font.Color = clWindowText
    Font.Height = -21
    Font.Name = '@Arial Unicode MS'
    Font.Style = []
    ParentFont = False
    TabOrder = 9
    Visible = False
  end
  object btnAccept: TButton
    Left = 344
    Top = 80
    Width = 73
    Height = 33
    Caption = 'Accept'
    TabOrder = 10
    Visible = False
    OnClick = btnAcceptClick
  end
  object cl1: TButton
    Left = 8
    Top = 128
    Width = 65
    Height = 57
    TabOrder = 11
    Visible = False
    OnClick = cl1Click
    OnMouseMove = cl1MouseMove
  end
  object timp: TTimer
    Enabled = False
    Interval = 50
    OnTimer = timpTimer
    Left = 520
    Top = 8
  end
  object player2: TClientSocket
    Active = True
    Address = '127.0.0.1'
    ClientType = ctNonBlocking
    Port = 1950
    OnRead = player2Read
    Left = 552
    Top = 8
  end
end
