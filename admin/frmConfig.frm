VERSION 5.00
Begin VB.Form frmConfig 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Configurações Banco de Dados MySQL"
   ClientHeight    =   3015
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   5895
   Icon            =   "frmConfig.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   Moveable        =   0   'False
   ScaleHeight     =   3015
   ScaleWidth      =   5895
   ShowInTaskbar   =   0   'False
   StartUpPosition =   2  'CenterScreen
   Begin VB.CommandButton cmdSave 
      Caption         =   "Salvar"
      Default         =   -1  'True
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
      Left            =   4680
      TabIndex        =   10
      Top             =   120
      Width           =   1095
   End
   Begin VB.TextBox txtFields 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   4
      Left            =   1080
      TabIndex        =   8
      Top             =   2040
      Width           =   3375
   End
   Begin VB.TextBox txtFields 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   3
      Left            =   1080
      TabIndex        =   7
      Top             =   1560
      Width           =   3375
   End
   Begin VB.TextBox txtFields 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      IMEMode         =   3  'DISABLE
      Index           =   2
      Left            =   1080
      PasswordChar    =   "*"
      TabIndex        =   4
      Top             =   1080
      Width           =   3375
   End
   Begin VB.TextBox txtFields 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   1
      Left            =   1080
      TabIndex        =   2
      Top             =   600
      Width           =   3375
   End
   Begin VB.TextBox txtFields 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   0
      Left            =   1080
      TabIndex        =   0
      Top             =   120
      Width           =   3375
   End
   Begin VB.Label lblLabels 
      Caption         =   "Atenção: A URL do site deve ser somente o protocolo HTTP"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H000000FF&
      Height          =   495
      Index           =   5
      Left            =   1080
      TabIndex        =   11
      Top             =   2400
      Width           =   3375
   End
   Begin VB.Label lblLabels 
      Caption         =   "URL Site:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   4
      Left            =   120
      TabIndex        =   9
      Top             =   2040
      Width           =   855
   End
   Begin VB.Label lblLabels 
      Caption         =   "Database:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   3
      Left            =   120
      TabIndex        =   6
      Top             =   1560
      Width           =   855
   End
   Begin VB.Label lblLabels 
      Caption         =   "Password:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   2
      Left            =   120
      TabIndex        =   5
      Top             =   1080
      Width           =   975
   End
   Begin VB.Label lblLabels 
      Caption         =   "User:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   1
      Left            =   120
      TabIndex        =   3
      Top             =   600
      Width           =   855
   End
   Begin VB.Label lblLabels 
      Caption         =   "HOST:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   375
      Index           =   0
      Left            =   120
      TabIndex        =   1
      Top             =   120
      Width           =   855
   End
End
Attribute VB_Name = "frmCOnfig"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Declare Function SetWindowPos Lib "user32" (ByVal hwnd As Long, ByVal hWndInsertAfter As Long, ByVal x As Long, y, ByVal cx As Long, ByVal cy As Long, ByVal wFlags As Long) As Long
Private Const HWND_TOPMOST = -1
Private Const HWND_NOTOPMOST = -2
Private Const SWP_NOMOVE = &H2
Private Const SWP_NOSIZE = &H1
Private Const TOPMOST_FLAGS = SWP_NOMOVE Or SWP_NOSIZE

Private Sub cmdSave_Click()
    SaveSetting App.Title, "CFGSYS", "CFGHOST", txtFields(0).Text
    SaveSetting App.Title, "CFGSYS", "CFGUSER", txtFields(1).Text
    SaveSetting App.Title, "CFGSYS", "CFGPASS", txtFields(2).Text
    SaveSetting App.Title, "CFGSYS", "CFGDATA", txtFields(3).Text
    SaveSetting App.Title, "CFGSYS", "CFGSITE", txtFields(4).Text
    MsgBox "Por favor, reinicie o sistema para carregar as novas configurações!"
    End
End Sub

Private Sub Form_Load()
    txtFields(0).Text = GetSetting(App.Title, "CFGSYS", "CFGHOST")
    txtFields(1).Text = GetSetting(App.Title, "CFGSYS", "CFGUSER")
    txtFields(2).Text = GetSetting(App.Title, "CFGSYS", "CFGPASS")
    txtFields(3).Text = GetSetting(App.Title, "CFGSYS", "CFGDATA")
    txtFields(4).Text = GetSetting(App.Title, "CFGSYS", "CFGSITE")
    SetWindowPos hwnd, HWND_TOPMOST, 0, 0, 0, 0, TOPMOST_FLAGS
End Sub
