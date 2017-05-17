VERSION 5.00
Begin VB.Form frmAnuncios 
   BorderStyle     =   3  'Fixed Dialog
   Caption         =   "Aprovação de Anúncios"
   ClientHeight    =   7440
   ClientLeft      =   45
   ClientTop       =   390
   ClientWidth     =   10215
   BeginProperty Font 
      Name            =   "Tahoma"
      Size            =   9.75
      Charset         =   0
      Weight          =   400
      Underline       =   0   'False
      Italic          =   0   'False
      Strikethrough   =   0   'False
   EndProperty
   Icon            =   "frmAnuncios.frx":0000
   LinkTopic       =   "Form1"
   MaxButton       =   0   'False
   MinButton       =   0   'False
   ScaleHeight     =   7440
   ScaleWidth      =   10215
   StartUpPosition =   2  'CenterScreen
   Begin VB.TextBox txtModalidadesCache 
      DataField       =   "pessoasatendimento"
      BeginProperty Font 
         Name            =   "Courier New"
         Size            =   9
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   645
      Left            =   240
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   48
      Top             =   3600
      Width           =   9735
   End
   Begin VB.CommandButton cmdPerfil 
      Caption         =   "..."
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
      Left            =   5760
      TabIndex        =   46
      Top             =   360
      Width           =   375
   End
   Begin VB.TextBox txtFields 
      DataField       =   "titulo"
      Height          =   285
      Index           =   0
      Left            =   240
      TabIndex        =   0
      Top             =   1560
      Width           =   4935
   End
   Begin VB.TextBox txtFields 
      DataField       =   "urlpes"
      Height          =   285
      Index           =   8
      Left            =   1920
      TabIndex        =   44
      Top             =   1560
      Width           =   495
   End
   Begin VB.TextBox txtFields 
      DataField       =   "apid"
      Height          =   285
      Index           =   7
      Left            =   1320
      TabIndex        =   43
      Top             =   1560
      Width           =   495
   End
   Begin VB.ListBox galeria 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H8000000D&
      Height          =   915
      Left            =   240
      TabIndex        =   42
      Top             =   6000
      Width           =   9735
   End
   Begin VB.ComboBox Combo1 
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   360
      ItemData        =   "frmAnuncios.frx":000C
      Left            =   240
      List            =   "frmAnuncios.frx":0019
      Style           =   2  'Dropdown List
      TabIndex        =   35
      Top             =   5280
      Width           =   2775
   End
   Begin VB.TextBox txtFields 
      DataField       =   "mensagem"
      BeginProperty Font 
         Name            =   "Courier New"
         Size            =   6.75
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   360
      Index           =   12
      Left            =   4440
      MultiLine       =   -1  'True
      TabIndex        =   34
      Top             =   5280
      Width           =   3615
   End
   Begin VB.CommandButton cmdReprov 
      Caption         =   "Reprovação"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   8.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   350
      Left            =   3000
      TabIndex        =   33
      Top             =   5280
      Width           =   1335
   End
   Begin VB.PictureBox picButtons 
      Align           =   2  'Align Bottom
      Appearance      =   0  'Flat
      BorderStyle     =   0  'None
      BeginProperty Font 
         Name            =   "MS Sans Serif"
         Size            =   8.25
         Charset         =   0
         Weight          =   400
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H80000008&
      Height          =   420
      Left            =   0
      ScaleHeight     =   420
      ScaleWidth      =   10215
      TabIndex        =   24
      Top             =   7020
      Width           =   10215
      Begin VB.CommandButton cmdEdit 
         Caption         =   "&Atualizar Dados"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   6960
         TabIndex        =   32
         Top             =   0
         Width           =   1815
      End
      Begin VB.CommandButton cmdRefresh 
         Caption         =   "&Atualizar "
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   8880
         TabIndex        =   31
         Top             =   0
         Width           =   1095
      End
      Begin VB.CommandButton cmdUpdate 
         Caption         =   "&Salvar"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   6960
         TabIndex        =   30
         Top             =   0
         Visible         =   0   'False
         Width           =   1815
      End
      Begin VB.CommandButton cmdCancel 
         Caption         =   "&Cancelar"
         BeginProperty Font 
            Name            =   "Tahoma"
            Size            =   9.75
            Charset         =   0
            Weight          =   700
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   8880
         TabIndex        =   29
         Top             =   0
         Visible         =   0   'False
         Width           =   1095
      End
      Begin VB.CommandButton cmdLast 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   1320
         Picture         =   "frmAnuncios.frx":0062
         Style           =   1  'Graphical
         TabIndex        =   28
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdNext 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   960
         Picture         =   "frmAnuncios.frx":03A4
         Style           =   1  'Graphical
         TabIndex        =   27
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdPrevious 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   600
         Picture         =   "frmAnuncios.frx":06E6
         Style           =   1  'Graphical
         TabIndex        =   26
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
      Begin VB.CommandButton cmdFirst 
         BeginProperty Font 
            Name            =   "MS Sans Serif"
            Size            =   8.25
            Charset         =   0
            Weight          =   400
            Underline       =   0   'False
            Italic          =   0   'False
            Strikethrough   =   0   'False
         EndProperty
         Height          =   300
         Left            =   240
         Picture         =   "frmAnuncios.frx":0A28
         Style           =   1  'Graphical
         TabIndex        =   25
         Top             =   0
         UseMaskColor    =   -1  'True
         Width           =   345
      End
   End
   Begin VB.TextBox txtFields 
      DataField       =   "visitascount"
      Height          =   285
      Index           =   5
      Left            =   7080
      TabIndex        =   13
      Top             =   4560
      Width           =   2895
   End
   Begin VB.TextBox txtFields 
      DataField       =   "idiomas"
      Height          =   285
      Index           =   4
      Left            =   4080
      TabIndex        =   8
      Top             =   4560
      Width           =   2895
   End
   Begin VB.TextBox txtFields 
      DataField       =   "pessoasatendimento"
      Height          =   285
      Index           =   3
      Left            =   240
      TabIndex        =   6
      Top             =   4560
      Width           =   3735
   End
   Begin VB.TextBox txtFields 
      DataField       =   "url"
      Height          =   285
      Index           =   2
      Left            =   5280
      TabIndex        =   4
      Top             =   1560
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
      Height          =   1095
      Index           =   1
      Left            =   240
      MultiLine       =   -1  'True
      ScrollBars      =   2  'Vertical
      TabIndex        =   1
      Top             =   2160
      Width           =   9735
   End
   Begin VB.TextBox txtFields 
      DataField       =   "aprovado"
      Height          =   285
      Index           =   6
      Left            =   1680
      TabIndex        =   40
      Top             =   5280
      Width           =   375
   End
   Begin VB.TextBox txtFields 
      DataField       =   "pesid"
      Height          =   285
      Index           =   9
      Left            =   3720
      TabIndex        =   45
      Top             =   1560
      Width           =   495
   End
   Begin VB.Label lblLabels 
      Caption         =   "Modalidades && Cachê:"
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
      Index           =   15
      Left            =   240
      TabIndex        =   47
      Top             =   3360
      Width           =   2775
   End
   Begin VB.Label lblLabels 
      BackStyle       =   0  'Transparent
      Caption         =   "Galeria de Fotos do Anúncio (clique no item para visualizar a imagem):"
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
      Index           =   17
      Left            =   240
      TabIndex        =   41
      Top             =   5760
      Width           =   8895
   End
   Begin VB.Label lblRecords 
      BackStyle       =   0  'Transparent
      Caption         =   "TESTE"
      DataField       =   "apelido"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H8000000D&
      Height          =   255
      Index           =   0
      Left            =   240
      TabIndex        =   10
      Top             =   360
      Width           =   4815
   End
   Begin VB.Label lblLabels 
      Caption         =   "Status do Anúncio:"
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
      Index           =   14
      Left            =   8160
      TabIndex        =   39
      Top             =   5040
      Width           =   1935
   End
   Begin VB.Label lblAprovado 
      Caption         =   "AGUARDANDO"
      DataField       =   "status_aprovado"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   12
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00000080&
      Height          =   255
      Left            =   8160
      TabIndex        =   38
      Top             =   5280
      Width           =   1935
   End
   Begin VB.Label lblLabels 
      Caption         =   "Alterar Status:"
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
      Index           =   13
      Left            =   240
      TabIndex        =   37
      Top             =   5040
      Width           =   1935
   End
   Begin VB.Label lblLabels 
      Caption         =   "Motivo Reprovação:"
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
      Index           =   12
      Left            =   4440
      TabIndex        =   36
      Top             =   5040
      Width           =   2415
   End
   Begin VB.Label lblRecords 
      Caption         =   "TESTE"
      DataField       =   "email"
      ForeColor       =   &H00000000&
      Height          =   255
      Index           =   5
      Left            =   960
      TabIndex        =   23
      Top             =   840
      Width           =   5175
   End
   Begin VB.Label lblLabels 
      Caption         =   "E-mail:"
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
      Index           =   11
      Left            =   240
      TabIndex        =   22
      Top             =   840
      Width           =   735
   End
   Begin VB.Label lblLabels 
      Caption         =   "Telefone 2:"
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
      Index           =   10
      Left            =   6360
      TabIndex        =   21
      Top             =   840
      Width           =   1215
   End
   Begin VB.Label lblLabels 
      Caption         =   "Telefone 1:"
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
      Index           =   9
      Left            =   6360
      TabIndex        =   20
      Top             =   600
      Width           =   1095
   End
   Begin VB.Label lblLabels 
      Caption         =   "WhatsApp:"
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
      Index           =   8
      Left            =   6360
      TabIndex        =   19
      Top             =   360
      Width           =   1095
   End
   Begin VB.Label lblRecords 
      Caption         =   "TESTE"
      DataField       =   "tel2"
      ForeColor       =   &H00000000&
      Height          =   255
      Index           =   4
      Left            =   7800
      TabIndex        =   18
      Top             =   840
      Width           =   2175
   End
   Begin VB.Label lblRecords 
      Caption         =   "TESTE"
      DataField       =   "tel1"
      ForeColor       =   &H00000000&
      Height          =   255
      Index           =   3
      Left            =   7800
      TabIndex        =   17
      Top             =   600
      Width           =   2175
   End
   Begin VB.Label lblRecords 
      Caption         =   "TESTE"
      DataField       =   "whatsapp"
      ForeColor       =   &H00000000&
      Height          =   255
      Index           =   2
      Left            =   7800
      TabIndex        =   16
      Top             =   360
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Caption         =   "Telefones de Contato:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   11.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   7
      Left            =   6360
      TabIndex        =   15
      Top             =   120
      Width           =   2175
   End
   Begin VB.Label lblLabels 
      Caption         =   "Nº Visitas:"
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
      Index           =   6
      Left            =   7080
      TabIndex        =   14
      Top             =   4320
      Width           =   2775
   End
   Begin VB.Label lblRecords 
      BackStyle       =   0  'Transparent
      Caption         =   "TESTE"
      DataField       =   "nome"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   9.75
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      ForeColor       =   &H00000040&
      Height          =   255
      Index           =   1
      Left            =   255
      TabIndex        =   12
      Top             =   600
      Width           =   5895
   End
   Begin VB.Label lblLabels 
      Caption         =   "Anunciante:"
      BeginProperty Font 
         Name            =   "Tahoma"
         Size            =   11.25
         Charset         =   0
         Weight          =   700
         Underline       =   0   'False
         Italic          =   0   'False
         Strikethrough   =   0   'False
      EndProperty
      Height          =   255
      Index           =   5
      Left            =   240
      TabIndex        =   11
      Top             =   120
      Width           =   1455
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
      Left            =   4080
      TabIndex        =   9
      Top             =   4320
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
      Top             =   4320
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
      Top             =   1320
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
      Top             =   1920
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
      Top             =   1320
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
Dim WithEvents adoModalities As Recordset
Attribute adoModalities.VB_VarHelpID = -1
Dim WithEvents adoCaches As Recordset
Attribute adoCaches.VB_VarHelpID = -1
Dim WithEvents adoGallery As Recordset
Attribute adoGallery.VB_VarHelpID = -1
Dim mbChangedByCode As Boolean
Dim mvBookMark As Variant
Dim mbEditFlag As Boolean
Dim mbAddNewFlag As Boolean
Dim mbDataChanged As Boolean
Dim db As Connection
Option Explicit
Private Declare Function URLDownloadToFile Lib "urlmon" Alias "URLDownloadToFileA" (ByVal pCaller As Long, ByVal szURL As String, ByVal szFileName As String, ByVal dwReserved As Long, ByVal lpfnCB As Long) As Long

Private Sub cmdReprov_Click()
    With frmMotivo
        .mFlag = 1
        .Show vbModal, Me
    End With
End Sub

Private Sub Combo1_click()
 txtFields(6).Text = Combo1.ListIndex
 If Combo1.ListIndex = 2 Then
    frmMotivo.Show vbModal, Me
 ElseIf Combo1.ListIndex = 1 Then
    txtFields(12).Text = ""
 End If
End Sub

Private Sub cmdPerfil_Click()
    With frmPerfis
        .pesID = txtFields(9).Text
        .Show
    End With
End Sub

Private Sub Form_Load()
  
  Dim oText As TextBox
  Dim oLabel As Label
  
  Set db = New Connection
  db.CursorLocation = adUseClient
  db.Open "PROVIDER=MSDataShape;Data PROVIDER=MSDASQL;driver={MySQL ODBC 5.3 Unicode Driver};" & _
          "server=" & GetSetting(App.Title, "CFGSYS", "CFGHOST") & ";" & _
          "uid=" & GetSetting(App.Title, "CFGSYS", "CFGUSER") & ";" & _
          "pwd=" & GetSetting(App.Title, "CFGSYS", "CFGPASS") & ";" & _
          "database=" & GetSetting(App.Title, "CFGSYS", "CFGDATA") & ";"

  Set adoPrimaryRS = New Recordset
  adoPrimaryRS.Open "SELECT " & _
                        "ap.*, p.pesid, p.url AS urlpes, p.apelido, p.nome, p.email, p.whatsapp, p.tel1, p.tel2, " & _
                        "CASE WHEN ap.aprovado = 0 THEN 'AGUARDANDO' WHEN ap.aprovado = 1 THEN 'APROVADO' WHEN ap.aprovado = 2 THEN 'REPROVADO' END AS status_aprovado " & _
                     "FROM anuncios_pessoas ap " & _
                     "INNER JOIN pessoas p ON p.pesid = ap.pesid " & _
                     "WHERE ap.aprovado = 0 ORDER BY ap.cadastro ASC ", db, adOpenStatic, adLockOptimistic

  For Each oText In Me.txtFields
    Set oText.DataSource = adoPrimaryRS
  Next
  For Each oLabel In Me.lblRecords
    Set oLabel.DataSource = adoPrimaryRS
  Next
  
  Set lblAprovado.DataSource = adoPrimaryRS
  
  updateGallery
  updateModalitiesCaches
  

  mbDataChanged = False
End Sub

Function updateGallery()
  Set adoGallery = New Recordset
     adoGallery.Open "SELECT " & _
                        "pf.* " & _
                     "FROM pessoas_fotos pf " & _
                     "WHERE pf.apid = " & txtFields(7).Text & " AND pf.tipo = 1", db, adOpenStatic, adLockOptimistic

  With galeria
    .Clear
    Do While Not adoGallery.EOF
      .AddItem adoGallery(3)
      adoGallery.MoveNext
    Loop
  End With
End Function

Function updateModalitiesCaches()
  txtModalidadesCache.Text = ""
  Set adoModalities = New Recordset
    adoModalities.Open "SELECT " & _
                          "mo.* " & _
                       "FROM modalidades_pessoas mp " & _
                       "INNER JOIN modalidades mo ON mo.modid = mp.modid " & _
                       "WHERE mp.apid = " & txtFields(7).Text & " AND mo.ativo = 1", db, adOpenStatic, adLockOptimistic
                     
  Set adoCaches = New Recordset
    adoCaches.Open "SELECT " & _
                          "pc.* " & _
                       "FROM pessoas_cache pc " & _
                       "WHERE pc.apid = " & txtFields(7).Text, db, adOpenStatic, adLockOptimistic
                     
 With txtModalidadesCache
    Do While Not adoModalities.EOF
      .Text = .Text & adoModalities(2) & " - "
      adoModalities.MoveNext
    Loop
  End With
  
  txtModalidadesCache.Text = txtModalidadesCache.Text & vbCrLf & _
  "30min: " & Format(adoCaches(3), "##0.00") & " " & _
  "1H: " & Format(adoCaches(4), "##0.00") & " " & _
  "2H: " & Format(adoCaches(5), "##0.00") & " " & _
  "4H: " & Format(adoCaches(6), "##0.00") & " " & _
  "8H: " & Format(adoCaches(7), "##0.00") & " " & _
  "Pernoite: " & Format(adoCaches(8), "##0.00") & " " & _
  "Viagens: " & Format(adoCaches(9), "##0.00")
End Function

Private Sub adoPrimaryRS_WillChangeRecord(ByVal adReason As ADODB.EventReasonEnum, ByVal cRecords As Long, adStatus As ADODB.EventStatusEnum, ByVal pRecordset As ADODB.Recordset)
  'This is where you put validation code
  'This event gets called when the following actions occur
  Dim bCancel As Boolean

  Select Case adReason
  Case adRsnAddNew
  Case adRsnClose
  Case adRsnDelete
  Case adRsnFirstChange
  Case adRsnMove
  Case adRsnRequery
  Case adRsnResynch
  Case adRsnUndoAddNew
  Case adRsnUndoDelete
  Case adRsnUndoUpdate
  Case adRsnUpdate
  End Select

  If bCancel Then adStatus = adStatusCancel
End Sub



Private Sub cmdRefresh_Click()
  'This is only needed for multi user apps
  On Error GoTo RefreshErr
  adoPrimaryRS.Requery
  adoGallery.Requery
  adoModalities.Requery
  adoCaches.Requery
  Exit Sub
RefreshErr:
  MsgBox Err.Description
End Sub

Private Sub cmdEdit_Click()
  On Error GoTo EditErr
  mbEditFlag = True
  SetButtons False
  Exit Sub
EditErr:
  MsgBox Err.Description
End Sub
Private Sub cmdCancel_Click()
  On Error Resume Next

  SetButtons True
  mbEditFlag = False
  mbAddNewFlag = False
  adoPrimaryRS.CancelUpdate
  If mvBookMark > 0 Then
    adoPrimaryRS.Bookmark = mvBookMark
  Else
    adoPrimaryRS.MoveFirst
  End If
  mbDataChanged = False

End Sub

Private Sub cmdUpdate_Click()
  On Error GoTo UpdateErr

  adoPrimaryRS.UpdateBatch adAffectAll

  If mbAddNewFlag Then
    adoPrimaryRS.MoveLast
  End If

  mbEditFlag = False
  mbAddNewFlag = False
  SetButtons True
  mbDataChanged = False
  cmdFirst_Click
  MsgBox "Anúncio alterado com sucesso!", , App.Title
  Exit Sub
UpdateErr:
  MsgBox Err.Description
End Sub

Private Sub cmdClose_Click()
  Unload Me
End Sub

Private Sub cmdFirst_Click()
  On Error GoTo GoFirstError

  adoPrimaryRS.MoveFirst
  mbDataChanged = False
  updateGallery
  updateModalitiesCaches
  Exit Sub

GoFirstError:
  MsgBox Err.Description
End Sub

Private Sub cmdLast_Click()
  On Error GoTo GoLastError

  adoPrimaryRS.MoveLast
  mbDataChanged = False
  updateGallery
  updateModalitiesCaches
  Exit Sub

GoLastError:
  MsgBox Err.Description
End Sub

Private Sub cmdNext_Click()
  On Error GoTo GoNextError

  If Not adoPrimaryRS.EOF Then
    adoPrimaryRS.MoveNext
    updateGallery
    updateModalitiesCaches
  End If
  If adoPrimaryRS.EOF And adoPrimaryRS.RecordCount > 0 Then
    Beep
    adoPrimaryRS.MoveLast
    updateGallery
    updateModalitiesCaches
  End If
  mbDataChanged = False
  Exit Sub
GoNextError:
  MsgBox Err.Description
End Sub

Private Sub cmdPrevious_Click()
  On Error GoTo GoPrevError

  If Not adoPrimaryRS.BOF Then
    adoPrimaryRS.MovePrevious
    updateGallery
    updateModalitiesCaches
  End If
  If adoPrimaryRS.BOF And adoPrimaryRS.RecordCount > 0 Then
    Beep
    adoPrimaryRS.MoveFirst
    updateGallery
    updateModalitiesCaches
  End If
  mbDataChanged = False
  Exit Sub

GoPrevError:
  MsgBox Err.Description
End Sub

Private Sub SetButtons(bVal As Boolean)
  cmdEdit.Visible = bVal
  cmdUpdate.Visible = Not bVal
  cmdCancel.Visible = Not bVal
  cmdRefresh.Visible = bVal
  cmdNext.Enabled = bVal
  cmdFirst.Enabled = bVal
  cmdLast.Enabled = bVal
  cmdPrevious.Enabled = bVal
End Sub

Function LoadGallery(pes As String, Gallery As String)
 On Local Error Resume Next
    Dim strGalSaveAs As String
    Dim lonReturn1 As Long
    strGalSaveAs = App.Path & "\galeria_atual.jpeg"
    lonReturn1 = URLDownloadToFile(0, GetSetting(App.Title, "CFGSYS", "CFGSITE") & pes & "/" & Gallery, strGalSaveAs, 0, 0)
     With frmImage
        .Image1.Picture = LoadPicture(strGalSaveAs)
        .Show
    End With
End Function

Private Sub galeria_Click()
    Dim img As String
    img = galeria.List(galeria.ListIndex)
    LoadGallery txtFields(8).Text, img
End Sub
