VERSION 5.00
Begin VB.Form frmMotivo 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Motivo de Reprova��o"
   ClientHeight    =   4680
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   6525
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "frmMotivo.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   4680
   ScaleWidth      =   6525
   ShowInTaskbar   =   0   'False
   StartUpPosition =   2  'CenterScreen
   Begin VB.CommandButton cmdOk 
      Caption         =   "Aplicar"
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
      Height          =   495
      Left            =   2280
      TabIndex        =   7
      Top             =   3960
      Width           =   2055
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Comprova��o Ileg�vel ou fora do padr�o determinado!"
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
      TabIndex        =   6
      Top             =   3120
      Width           =   5775
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "CPF ou RG inconsistentes com a Imagem do Documento"
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
      Left            =   360
      TabIndex        =   5
      Top             =   2640
      Width           =   5775
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Documento de Identidade Inconsistente"
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
      TabIndex        =   4
      Top             =   2160
      Width           =   5775
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Imagem da Comprova��o da Identidade ileg�vel!"
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
      Index           =   2
      Left            =   360
      TabIndex        =   3
      Top             =   1680
      Width           =   5895
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Imagem do Documento de Identidade ileg�vel!"
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
      Index           =   1
      Left            =   360
      TabIndex        =   2
      Top             =   1200
      Width           =   5895
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Comprova��o fora do padr�o determinado!"
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
      Index           =   0
      Left            =   360
      TabIndex        =   1
      Top             =   720
      Width           =   5775
   End
   Begin VB.Label Label1 
      Caption         =   "Informe o motivo da reprova��o deste perfil:"
      Height          =   375
      Left            =   240
      TabIndex        =   0
      Top             =   240
      Width           =   5775
   End
End
Attribute VB_Name = "frmMotivo"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private msg As String

Private Sub cmdOk_Click()
    With frmPerfis
        .txtFields(12).Text = msg
        .txtFields(13).Text = 0
    End With
    Unload Me
End Sub

Private Sub optMotivo_Click(Index As Integer)
    msg = optMotivo(Index).Caption
End Sub
