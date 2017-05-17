VERSION 5.00
Begin VB.Form frmMotivo 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Motivo de Reprovação"
   ClientHeight    =   4845
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   6660
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
   ScaleHeight     =   4845
   ScaleWidth      =   6660
   ShowInTaskbar   =   0   'False
   StartUpPosition =   2  'CenterScreen
   Begin VB.OptionButton optMotivo 
      Caption         =   "Anúncio não contem Fotos ou Vídeos"
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
      Index           =   8
      Left            =   360
      TabIndex        =   10
      Top             =   3600
      Width           =   6135
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Fotografias do anúncio infringem regras dos Termos de Uso"
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
      Index           =   7
      Left            =   360
      TabIndex        =   9
      Top             =   3240
      Width           =   6135
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Anúncio fora do padrão determinado"
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
      Index           =   6
      Left            =   360
      TabIndex        =   8
      Top             =   2880
      Width           =   5775
   End
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
      Top             =   4200
      Width           =   2055
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Comprovação Ilegível ou fora do padrão determinado!"
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
      Top             =   2520
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
      Top             =   2160
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
      Top             =   1800
      Width           =   5775
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Imagem da Comprovação da Identidade ilegível!"
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
      Top             =   1440
      Width           =   5895
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Imagem do Documento de Identidade ilegível!"
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
      Top             =   1080
      Width           =   5895
   End
   Begin VB.OptionButton optMotivo 
      Caption         =   "Comprovação fora do padrão determinado!"
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
      Caption         =   "Informe o motivo da reprovação deste perfil:"
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
Public mFlag As Integer

Private Sub cmdOK_Click()
    If mFlag = 0 Then
        With frmPerfis
            .txtFields(12).Text = msg
            .txtFields(13).Text = 0
            .txtFields(12).Enabled = True
            .lblLabels(12).Enabled = True
        End With
    Else
        With frmAnuncios
            .txtFields(12).Text = msg
            .txtFields(6).Text = 0
            .txtFields(12).Enabled = True
            .lblLabels(12).Enabled = True
        End With
    End If
    Unload Me
End Sub

Private Sub Form_Load()
    If mFlag = 1 Then
        optMotivo(1).Enabled = False
        optMotivo(2).Enabled = False
        optMotivo(3).Enabled = False
        optMotivo(4).Enabled = False
        optMotivo(5).Enabled = False
        optMotivo(6).Enabled = True
        optMotivo(7).Enabled = True
        optMotivo(8).Enabled = True
    Else
        optMotivo(1).Enabled = True
        optMotivo(2).Enabled = True
        optMotivo(3).Enabled = True
        optMotivo(4).Enabled = True
        optMotivo(5).Enabled = True
        optMotivo(6).Enabled = False
        optMotivo(7).Enabled = False
        optMotivo(8).Enabled = False
    End If
End Sub

Private Sub optMotivo_Click(Index As Integer)
    msg = optMotivo(Index).Caption
End Sub
