VERSION 5.00
Begin VB.Form frmAlertas 
   BorderStyle     =   1  'Fixed Single
   Caption         =   "Libidinous - Gerenciamento de Aprovações - Perfis e Anúncios"
   ClientHeight    =   4530
   ClientLeft      =   10605
   ClientTop       =   6135
   ClientWidth     =   9525
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "frmAlertas.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   ScaleHeight     =   4530
   ScaleWidth      =   9525
   Begin VB.PictureBox Picture1 
      BackColor       =   &H00FFFFFF&
      BorderStyle     =   0  'None
      Height          =   1335
      Left            =   0
      ScaleHeight     =   1335
      ScaleWidth      =   9615
      TabIndex        =   6
      Top             =   0
      Width           =   9615
      Begin VB.CommandButton cmdConfig 
         Caption         =   "Config"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   375
         Left            =   8160
         TabIndex        =   8
         Top             =   480
         Width           =   855
      End
      Begin VB.Label Label1 
         BackStyle       =   0  'Transparent
         Caption         =   "App.Title"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   12
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         ForeColor       =   &H00000040&
         Height          =   375
         Index           =   3
         Left            =   2520
         TabIndex        =   21
         Top             =   315
         Width           =   4335
      End
      Begin VB.Label Label1 
         BackStyle       =   0  'Transparent
         Caption         =   "Sistema de Gerenciamento de Aprovações"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   2
         Left            =   2520
         TabIndex        =   20
         Top             =   600
         Width           =   3855
      End
      Begin VB.Label Label1 
         BackStyle       =   0  'Transparent
         Caption         =   "Versão: 1.1"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   6.75
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   255
         Index           =   1
         Left            =   2520
         TabIndex        =   19
         Top             =   840
         Width           =   1935
      End
   End
   Begin VB.Timer piscapisca 
      Interval        =   400
      Left            =   8520
      Top             =   2160
   End
   Begin VB.Timer tempo 
      Interval        =   5000
      Left            =   8040
      Top             =   2160
   End
   Begin VB.CommandButton cmdAnuncios 
      Caption         =   "Ver Anúncios"
      Enabled         =   0   'False
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   7200
      TabIndex        =   5
      Top             =   2880
      Width           =   1755
   End
   Begin VB.CommandButton cmdPerfis 
      Caption         =   "Ver Perfis"
      Enabled         =   0   'False
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Left            =   4920
      TabIndex        =   3
      Top             =   2880
      Width           =   1755
   End
   Begin VB.Label Label1 
      Alignment       =   1  'Right Justify
      Caption         =   "Copyright © 2017 - Libidinous Todos os Direitos Reservados "
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   6.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   495
      Index           =   0
      Left            =   7440
      TabIndex        =   18
      Top             =   4080
      Width           =   1935
   End
   Begin VB.Label lblAguardando 
      AutoSize        =   -1  'True
      Caption         =   "R$ 0,00"
      DataField       =   "aguardando"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   """R$"" #.##0,00"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   2
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   14.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H000000C0&
      Height          =   345
      Left            =   3120
      TabIndex        =   17
      Top             =   3960
      Width           =   1110
   End
   Begin VB.Label lblLabels 
      Caption         =   "Aguardando Pgto.:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   6
      Left            =   360
      TabIndex        =   16
      Top             =   3960
      Width           =   2415
   End
   Begin VB.Label lblNumMidia 
      BackStyle       =   0  'Transparent
      Caption         =   "000000"
      DataField       =   "nummidia"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "000000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   24
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00000040&
      Height          =   495
      Left            =   360
      TabIndex        =   15
      Top             =   2640
      Width           =   1935
   End
   Begin VB.Label lblNumAnuncios 
      BackStyle       =   0  'Transparent
      Caption         =   "00000"
      DataField       =   "numanuncios"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "00000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   24
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00000040&
      Height          =   495
      Left            =   2640
      TabIndex        =   14
      Top             =   1785
      Width           =   1695
   End
   Begin VB.Label lblNumPerfis 
      BackStyle       =   0  'Transparent
      Caption         =   "00000"
      DataField       =   "numperfis"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "00000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   24
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00000040&
      Height          =   495
      Left            =   360
      TabIndex        =   13
      Top             =   1785
      Width           =   1695
   End
   Begin VB.Label lblLabels 
      Caption         =   "Nº Fotos && Vídeos:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   5
      Left            =   360
      TabIndex        =   12
      Top             =   2400
      Width           =   1935
   End
   Begin VB.Label lblLabels 
      Caption         =   "Nº Anúncios:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   4
      Left            =   2640
      TabIndex        =   11
      Top             =   1560
      Width           =   1575
   End
   Begin VB.Label lblLabels 
      Caption         =   "Nº Perfis:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   3
      Left            =   360
      TabIndex        =   10
      Top             =   1560
      Width           =   1575
   End
   Begin VB.Label lblLabels 
      Caption         =   "Receita Mês:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   2
      Left            =   360
      TabIndex        =   9
      Top             =   3480
      Width           =   2655
   End
   Begin VB.Label lblPerfis 
      Alignment       =   2  'Center
      BackStyle       =   0  'Transparent
      Caption         =   "000"
      DataField       =   "perfis"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   48
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H8000000D&
      Height          =   1215
      Left            =   4680
      TabIndex        =   0
      Top             =   1680
      Width           =   2175
   End
   Begin VB.Label lblReceita 
      AutoSize        =   -1  'True
      Caption         =   "R$ 0,00"
      DataField       =   "receita"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   """R$"" #.##0,00"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   2
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   14.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00004000&
      Height          =   345
      Left            =   3120
      TabIndex        =   7
      Top             =   3480
      Width           =   1110
   End
   Begin VB.Label lblAnuncios 
      Alignment       =   2  'Center
      BackStyle       =   0  'Transparent
      Caption         =   "000"
      DataField       =   "anuncios"
      BeginProperty DataFormat 
         Type            =   1
         Format          =   "000"
         HaveTrueFalseNull=   0
         FirstDayOfWeek  =   0
         FirstWeekOfYear =   0
         LCID            =   1046
         SubFormatType   =   0
      EndProperty
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   48
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H8000000D&
      Height          =   1215
      Left            =   6960
      TabIndex        =   4
      Top             =   1680
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Caption         =   "Novos Anúncios:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   1
      Left            =   7200
      TabIndex        =   2
      Top             =   1560
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Caption         =   "Novos Perfis: "
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   0
      Left            =   4920
      TabIndex        =   1
      Top             =   1560
      Width           =   1935
   End
End
Attribute VB_Name = "frmAlertas"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Dim WithEvents adoPrimaryRS As Recordset
Attribute adoPrimaryRS.VB_VarHelpID = -1
Dim mbChangedByCode As Boolean
Dim mvBookMark As Variant
Dim mbEditFlag As Boolean
Dim mbAddNewFlag As Boolean
Dim mbDataChanged As Boolean

Private Declare Function SetWindowPos Lib "user32" (ByVal hwnd As Long, ByVal hWndInsertAfter As Long, ByVal x As Long, y, ByVal cx As Long, ByVal cy As Long, ByVal wFlags As Long) As Long
Private Const HWND_TOPMOST = -1
Private Const HWND_NOTOPMOST = -2
Private Const SWP_NOMOVE = &H2
Private Const SWP_NOSIZE = &H1
Private Const TOPMOST_FLAGS = SWP_NOMOVE Or SWP_NOSIZE

Option Explicit

Private Sub cmdAnuncios_Click()
    frmAnuncios.Show
End Sub

Private Sub cmdConfig_Click()
    frmCOnfig.Show vbModal, Me
End Sub

Private Sub cmdPerfis_Click()
    frmPerfis.Show
End Sub

Private Sub Form_Load()
Dim db As Connection
  Set db = New Connection
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};" & _
          "server=" & GetSetting(App.Title, "CFGSYS", "CFGHOST") & ";" & _
          "uid=" & GetSetting(App.Title, "CFGSYS", "CFGUSER") & ";" & _
          "pwd=" & GetSetting(App.Title, "CFGSYS", "CFGPASS") & ";" & _
          "database=" & GetSetting(App.Title, "CFGSYS", "CFGDATA") & ";"

  Set adoPrimaryRS = New Recordset
  adoPrimaryRS.Open "SELECT " & _
                    "(SELECT COUNT(1) FROM pessoas WHERE aprovado = 0) AS perfis, " & _
                    "(SELECT COUNT(1) FROM pessoas WHERE aprovado = 1) AS numperfis, " & _
                    "(SELECT COUNT(1) FROM pessoas_fotos pf WHERE pf.ativo = 1) AS nummidia, " & _
                    "(SELECT SUM(pp.vloriginal) FROM planos_pagamentos pp WHERE pp.pago = 1 AND pp.psid IS NOT NULL AND DATEDIFF(pp.vencimento, now()) > 0) AS receita," & _
                    "(SELECT SUM(pp.vloriginal) FROM planos_pagamentos pp WHERE pp.pago = 0 AND pp.psid IS NOT NULL) AS aguardando," & _
                    "(SELECT COUNT(1) FROM anuncios_pessoas WHERE aprovado = 1) AS numanuncios, " & _
                    "(SELECT COUNT(1) FROM anuncios_pessoas WHERE aprovado = 0) AS anuncios", db, adOpenStatic, adLockOptimistic

  Set lblPerfis.DataSource = adoPrimaryRS
  Set lblNumPerfis.DataSource = adoPrimaryRS
  Set lblAnuncios.DataSource = adoPrimaryRS
  Set lblNumAnuncios.DataSource = adoPrimaryRS
  Set lblNumMidia.DataSource = adoPrimaryRS
  Set lblReceita.DataSource = adoPrimaryRS
  Set lblAguardando.DataSource = adoPrimaryRS
  mbDataChanged = False
  
  lblLabels(2).Caption = "Receita " & UCase(Format(Now, "mmm")) & "/" & Format(Now, "yyyy") & ":"
  Label1(3).Caption = App.Title
  
  If GetSetting(App.Title, "CFGSYS", "PROFILE") = "operator" Then
    cmdConfig.Visible = False
  End If
  
  SetWindowPos hwnd, HWND_TOPMOST, 0, 0, 0, 0, TOPMOST_FLAGS
  
End Sub

Private Sub Form_Unload(Cancel As Integer)
    If MsgBox("Deseja sair do sistema?", vbYesNo + vbQuestion) = vbYes Then
        End
    Else
        Cancel = 5
    End If
End Sub

Private Sub lblAnuncios_Change()
    If lblAnuncios.Caption <> "000" Then
        lblAnuncios.ForeColor = &HC0&
        cmdAnuncios.Enabled = True
    Else
        lblAnuncios.ForeColor = &H8000000D
        cmdAnuncios.Enabled = False
    End If
End Sub

Private Sub lblPerfis_Change()
    If lblPerfis.Caption <> "000" Then
        lblPerfis.ForeColor = &HC0&
        cmdPerfis.Enabled = True
      
        Beep
    Else
        lblPerfis.ForeColor = &H8000000D
        cmdPerfis.Enabled = False
    End If
End Sub

Private Sub piscapisca_Timer()
    If lblPerfis.Caption <> "000" Then
        If lblPerfis.Visible = True Then
            lblPerfis.Visible = False
        Else
            lblPerfis.Visible = True
        End If
    Else
        lblPerfis.Visible = True
    End If
    If lblAnuncios.Caption <> "000" Then
        If lblAnuncios.Visible = True Then
            lblAnuncios.Visible = False
        Else
            lblAnuncios.Visible = True
        End If
    Else
        lblAnuncios.Visible = True
    End If
End Sub

Private Sub tempo_Timer()
    adoPrimaryRS.Requery
End Sub
