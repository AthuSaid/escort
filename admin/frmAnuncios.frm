VERSION 5.00
Begin VB.Form frmAnuncios 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Aprovação de Anúncios"
   ClientHeight    =   8670
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   10230
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   8670
   ScaleWidth      =   10230
   ShowInTaskbar   =   0   'False
   StartUpPosition =   3  'Windows Default
   Begin VB.TextBox txtFields 
      DataField       =   "idiomas"
      Height          =   285
      Index           =   4
      Left            =   3240
      TabIndex        =   8
      Top             =   3720
      Width           =   2895
   End
   Begin VB.TextBox txtFields 
      DataField       =   "pessoasatendimento"
      Height          =   285
      Index           =   3
      Left            =   240
      TabIndex        =   6
      Top             =   3720
      Width           =   2895
   End
   Begin VB.TextBox txtFields 
      DataField       =   "url"
      Height          =   285
      Index           =   2
      Left            =   5280
      TabIndex        =   4
      Top             =   480
      Width           =   4695
   End
   Begin VB.TextBox txtFields 
      DataField       =   "descricao"
      BeginProperty Font 
         Name            =   "Courier New"
         Size            =   9
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   2175
      Index           =   1
      Left            =   240
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   1
      Top             =   1200
      Width           =   9735
   End
   Begin VB.TextBox txtFields 
      DataField       =   "titulo"
      Height          =   285
      Index           =   0
      Left            =   240
      TabIndex        =   0
      Top             =   480
      Width           =   4935
   End
   Begin VB.Label lblLabels 
      Caption         =   "Idiomas:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   4
      Left            =   3240
      TabIndex        =   9
      Top             =   3480
      Width           =   2775
   End
   Begin VB.Label lblLabels 
      Caption         =   "Pessoas que Atende:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   3
      Left            =   240
      TabIndex        =   7
      Top             =   3480
      Width           =   2775
   End
   Begin VB.Label lblLabels 
      Caption         =   "URL Amigável:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   2
      Left            =   5280
      TabIndex        =   5
      Top             =   240
      Width           =   1935
   End
   Begin VB.Label lblLabels 
      Caption         =   "Descrição:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   1
      Left            =   240
      TabIndex        =   3
      Top             =   960
      Width           =   1935
   End
   Begin VB.Label lblLabels 
      Caption         =   "Título:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   0
      Left            =   240
      TabIndex        =   2
      Top             =   240
      Width           =   1935
   End
End
Attribute VB_Name = "frmAnuncios"
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
Option Explicit
Private Declare Function URLDownloadToFile Lib "urlmon" Alias "URLDownloadToFileA" (ByVal pCaller As Long, ByVal szURL As String, ByVal szFileName As String, ByVal dwReserved As Long, ByVal lpfnCB As Long) As Long

Private Sub Form_Load()
Dim db As Connection
  Set db = New Connection
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};server=127.0.0.1;uid=root;pwd=;database=escort;"

  Set adoPrimaryRS = New Recordset
  adoPrimaryRS.Open "select  * from anuncios_pessoas  ORDER BY cadastro ASC ", db, adOpenStatic, adLockOptimistic

  Dim oText As TextBox
  'Bind the text boxes to the data provider
  
  For Each oText In Me.txtFields
    Set oText.DataSource = adoPrimaryRS
  Next
 ' Set lblIdade.DataSource = adoPrimaryRS
 ' Set lblAprovado.DataSource = adoPrimaryRS
  
  'changeImage txtFields(10).Text, txtFields(2).Text, txtFields(11).Text

  mbDataChanged = False
End Sub
