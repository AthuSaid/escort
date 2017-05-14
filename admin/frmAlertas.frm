VERSION 5.00
Begin VB.Form frmAlertas 
   BorderStyle     =   1  'Fixed Single
   Caption         =   "Gerenciamento de Aprovações"
   ClientHeight    =   4860
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   9690
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
   ScaleHeight     =   4860
   ScaleWidth      =   9690
   StartUpPosition =   2  'CenterScreen
   Begin VB.Timer piscapisca 
      Interval        =   400
      Left            =   1200
      Top             =   1680
   End
   Begin VB.Timer tempo 
      Interval        =   5000
      Left            =   600
      Top             =   1680
   End
   Begin VB.CommandButton cmdAnuncios 
      Caption         =   "Mostrar Anúncios"
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
      Height          =   615
      Left            =   6840
      TabIndex        =   5
      Top             =   1680
      Width           =   2055
   End
   Begin VB.CommandButton cmdPerfis 
      Caption         =   "Mostrar Perfis"
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
      Height          =   615
      Left            =   2280
      TabIndex        =   3
      Top             =   1680
      Width           =   2055
   End
   Begin VB.Label lblAnuncios 
      Alignment       =   2  'Center
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
      Left            =   6840
      TabIndex        =   4
      Top             =   360
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Alignment       =   1  'Right Justify
      Caption         =   "Novos Anúncios para aprovar:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   855
      Index           =   1
      Left            =   4800
      TabIndex        =   2
      Top             =   720
      Width           =   1935
   End
   Begin VB.Label lblLabels 
      Alignment       =   1  'Right Justify
      Caption         =   "Novos Perfis para aprovar: "
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   855
      Index           =   0
      Left            =   360
      TabIndex        =   1
      Top             =   720
      Width           =   1935
   End
   Begin VB.Label lblPerfis 
      Alignment       =   2  'Center
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
      Left            =   2280
      TabIndex        =   0
      Top             =   360
      Width           =   2175
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
Option Explicit
Private Declare Function URLDownloadToFile Lib "urlmon" Alias "URLDownloadToFileA" (ByVal pCaller As Long, ByVal szURL As String, ByVal szFileName As String, ByVal dwReserved As Long, ByVal lpfnCB As Long) As Long

Private Sub cmdAnuncios_Click()
    frmAnuncios.Show
End Sub

Private Sub cmdPerfis_Click()
    frmPerfis.Show
End Sub

Private Sub Form_Load()
Dim db As Connection
  Set db = New Connection
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};server=127.0.0.1;uid=root;pwd=;database=escort;"

  Set adoPrimaryRS = New Recordset
  adoPrimaryRS.Open "SELECT (SELECT COUNT(1) FROM pessoas WHERE aprovado = 0) AS perfis, (SELECT COUNT(1) FROM anuncios_pessoas WHERE aprovado = 0) AS anuncios", db, adOpenStatic, adLockOptimistic

  Set lblPerfis.DataSource = adoPrimaryRS
  Set lblAnuncios.DataSource = adoPrimaryRS
  
  mbDataChanged = False
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
